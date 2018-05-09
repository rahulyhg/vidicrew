<?php

/* Template Name: API */
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'login') {
    login();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'register') {
    register();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'upload-photo') {
    uploadPhoto();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'upload-video') {
    uploadVideo();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'notifications') {
    notifications();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'shotlist') {
    shotlist();
} else if (isset($_REQUEST['api']) && $_REQUEST['api'] == 'update-task') {
    updateTask();
}

/**
 * get json array for service response
 * @data: result array
 * */
function getJson($data) {

    if (!isset($_REQUEST['debug'])) {
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    } else {
        echo '<pre>';
        print_r($data['data']);
        exit;
    }
}

function login() {
    if (isset($_REQUEST['crew_code']) && $_REQUEST['crew_code'] != '') {
        $featureArr = array();
        if (isset($_REQUEST['user_email']) && $_REQUEST['user_email'] != '' && isset($_REQUEST['password']) && $_REQUEST['password']
                != '') {
            $user_email = $_REQUEST['user_email'];
            $password = $_REQUEST['password'];
            $crewCode = $_REQUEST['crew_code'];
            $user_id = email_exists($user_email);

            if ($user_id) {
                $userdata = get_user_by('email', $user_email);
                $result = wp_check_password($password, $userdata->user_pass,
                        $userdata->ID);
                if ($result) {

                    $post_id = "user_" . $userdata->ID;

                    $value = get_field('crew_code', $post_id);
                    if ($crewCode == $value) {
                        $userId = $userdata->ID;
                        function my_posts_where($where) {

                            $where = str_replace("meta_key = 'user_task_list_$",
                                    "meta_key LIKE 'user_task_list_%", $where);

                            return $where;
                        }

                        add_filter('posts_where', 'my_posts_where');
                        $args = array(
                            'post_type' => 'shotlist',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                    'key' => 'crew_code',
                                    'value' => $crewCode
                                ),
                                array(
                                    'key' => 'user_task_list_$_user',
                                    'compare' => '=',
                                    'value' => $userdata->ID,
                                )
                            )
                        );
                     
                        $my_query = new WP_Query($args);
                        if ($my_query->have_posts()) { 
                            while ($my_query->have_posts()) : $my_query->the_post();
                                global $post;
                                $taskList = array();
                                if (have_rows('user_task_list')) {
                                    while (have_rows('user_task_list')) : the_row();
                                        $taskUser = get_sub_field('user');
                                        if (isset($taskUser['ID']) && $taskUser['ID']
                                                == $userId) {
                                            if (have_rows('task_list')):
                                                while (have_rows('task_list')) : the_row();
                                                    $taskObj = get_sub_field_object('task_status');
                                                    // display a sub field value
                                                    $task = get_sub_field('task');
                                                    $status = get_sub_field('task_status');
                                                    $taskList[] = array(
                                                        'task' => $task,
                                                        'status_key' => $taskObj['name'],
                                                        'status' => $status
                                                    );
                                                endwhile;
                                            else :
                                            // no rows found
                                            endif;
                                        }
                                    endwhile;
                                }
                                $data[] = array(
                                    'task_list' => $taskList
                                );
                            endwhile;
                            $featureArr = $data;
                        }
                        $userArr = array(
                            'id' => $userdata->ID,
                            'email' => $userdata->user_email,
                            'name' => $userdata->display_name,
                            'features' => $featureArr
                        );
                        getJson(array('status' => '1', 'data' => $userArr, 'message' => 'User logged in successfully.'));
                    } else {
                        getJson(array('status' => '0', 'message' => 'Invalid crew code.'));
                    }
                } else {
                    getJson(array('status' => '0', 'message' => 'Invalid password.'));
                }
            } else {
                getJson(array('status' => '0', 'message' => 'Email does not exist.'));
            }
        } elseif (isset($_REQUEST['social_id']) && $_REQUEST['social_id'] != '' && isset($_REQUEST['social_type']) && $_REQUEST['social_type']
                != '') {
            global $wpdb;
            $name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : '';
            $user_email = isset($_REQUEST['user_email']) ? $_REQUEST['user_email'] : '';
            $device_id = isset($_REQUEST['device_id']) ? $_REQUEST['device_id'] : '';
            $device_type = isset($_REQUEST['device_type']) ? $_REQUEST['device_type'] : '';
            $social_type = isset($_REQUEST['social_type']) ? $_REQUEST['social_type'] : '';
            $socialId = isset($_REQUEST['social_id']) ? $_REQUEST['social_id'] : '';
            $display_name = isset($_REQUEST['display_name']) ? $_REQUEST['display_name'] : '';
            $user = $wpdb->get_row("SELECT * FROM wp_users WHERE social_id = '" . $socialId . "' && social_type='" . $social_type . "'");
            if ($user_email != '' && email_exists($user_email)) {
                getJson(array('status' => '0', 'message' => 'Email already exists.'));
            }
            if (isset($user->ID)) {
                $wpdb->update('wp_users',
                        array('device_id' => $device_id, 'device_type' => $device_type),
                        array('ID' => $user->ID));
                $data = array(
                    'id' => $user->ID,
                    'name' => $user->display_name,
                    'email' => $user->user_email,
                    'features' => $featureArr
                );
            } else {
                $wpdb->insert('wp_users',
                        array(
                    'user_login' => $name,
                    'user_email' => $user_email,
                    'user_nicename' => $name,
                    'user_registered' => date('Y-m-d H:i:s'),
                    'user_status' => '0',
                    'display_name' => $display_name,
                    'social_type' => $social_type,
                    'social_id' => $socialId,
                    'device_id' => $device_id,
                    'device_type' => $device_type
                ));
                $id = $wpdb->insert_id;

                $data = array(
                    'id' => $id,
                    'name' => $display_name,
                    'email' => $user_email,
                    'features' => $featureArr
                );
            }
            getJson(array('status' => '1', 'data' => $data, 'message' => 'User logged in successfully.'));
        } else {
            getJson(array('status' => '0', 'message' => 'Bad Request.'));
        }
    } else {
        getJson(array('status' => '0', 'message' => 'Bad Request.'));
    }
}

function register() {
    if (isset($_REQUEST['crew_code']) && $_REQUEST['crew_code'] != '' && isset($_REQUEST['user_name']) && $_REQUEST['user_name']
            != '' && isset($_REQUEST['user_email']) && $_REQUEST['user_email'] != '' && isset($_REQUEST['password']) && $_REQUEST['password']
            != '') {
        $user_name = $_REQUEST['user_name'];
        $user_email = $_REQUEST['user_email'];
        $password = $_REQUEST['password'];
        $crew_code = $_REQUEST['crew_code'];
        $user_id = username_exists($user_name);
        if (!$user_id and email_exists($user_email) == false) {

            $user_id = wp_create_user($user_name, $password, $user_email);
            print_r($user_id);
            exit;
        } else {
            getJson(array('status' => '0', 'message' => 'User already exists.'));
        }
    } else {
        getJson(array('status' => '0', 'message' => 'Bad Request.'));
    }
}

function uploadPhoto() {
    if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_FILES['upload_file']) && isset($_REQUEST['crew_code']) && $_REQUEST['crew_code']
            != '') {
        $userId = $_REQUEST['user_id'];
        $crewCode = $_REQUEST['crew_code'];
        if (!function_exists('wp_handle_upload')) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        echo '<pre>';
        global $wpdb;
        $uploadedfile = $_FILES['upload_file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        $postArr = $wpdb->get_row("SELECT ID FROM wp_posts order by ID desc limit 1");

        $postId = $postArr->ID;
        $arg = array(
            'ID' => $postId,
            'post_author' => $userId,
        );
        wp_update_post($arg);
        update_field('field_5ac5b114e7d6a', $crewCode, $postId);
        getJson(array('status' => '1', 'message' => 'Photo uploaded successfully.'));
    } else {
        getJson(array('status' => '0', 'message' => 'Bad Request.'));
    }
}

function uploadVideo() {
    if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_FILES['upload_file']) && isset($_REQUEST['crew_code']) && $_REQUEST['crew_code']
            != '') {
        $userId = $_REQUEST['user_id'];
        $crewCode = $_REQUEST['crew_code'];
        if (!function_exists('wp_handle_upload')) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }
        global $wpdb;
        $uploadedfile = $_FILES['upload_file'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
        $postArr = $wpdb->get_row("SELECT ID FROM wp_posts order by ID desc limit 1");

        $postId = $postArr->ID;
        $arg = array(
            'ID' => $postId,
            'post_author' => $userId,
        );
        wp_update_post($arg);
        update_field('field_5ac5b114e7d6a', $crewCode, $postId);
        getJson(array('status' => '1', 'message' => 'Video uploaded successfully.'));
    } else {
        getJson(array('status' => '0', 'message' => 'Bad Request.'));
    }
}

function notifications() {
    if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {
        global $wpdb;
        $user_id = $_REQUEST['user_id'];
        $userArr = $wpdb->get_results("SELECT notification, type, status, DATE_FORMAT(created_date, '%d-%m-%Y') as created_date FROM wp_notification where user_id=" . $user_id . ' order by id desc',
                'ARRAY_A');
        $wpdb->update('wp_notification', ['status' => '0'],
                ['user_id' => $user_id]);
        getJson(array('status' => '1', 'data' => $userArr, 'message' => 'Success.'));
    } else {
        getJson(array('status' => '0', 'message' => 'Bad Request.'));
    }
}

function shotlist() {
    if (isset($_REQUEST['crew_code']) && $_REQUEST['crew_code'] != '' && isset($_REQUEST['user_id']) && $_REQUEST['user_id']
            != '') {
        $data = array();
        $code = $_REQUEST['crew_code'];
        $userId = $_REQUEST['user_id'];

        // filter
        function my_posts_where($where) {

            $where = str_replace("meta_key = 'user_task_list_$",
                    "meta_key LIKE 'user_task_list_%", $where);

            return $where;
        }

        add_filter('posts_where', 'my_posts_where');
        $args = array(
            'post_type' => 'shotlist',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'crew_code',
                    'value' => $code
                ),
                array(
                    'key' => 'user_task_list_$_user',
                    'compare' => '=',
                    'value' => $userId,
                )
            )
        );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
            while ($my_query->have_posts()) : $my_query->the_post();
                global $post;
                $taskList = array();
                if (have_rows('user_task_list')) {
                    while (have_rows('user_task_list')) : the_row();
                        $taskUser = get_sub_field('user');
                        if (isset($taskUser['ID']) && $taskUser['ID'] == $userId) {
                            if (have_rows('task_list')):
                                while (have_rows('task_list')) : the_row();
                                    $taskObj = get_sub_field_object('task_status');
                                    // display a sub field value
                                    $task = get_sub_field('task');
                                    $status = get_sub_field('task_status');
                                    $taskList[] = array(
                                        'task' => $task,
                                        'status_key' => $taskObj['name'],
                                        'status' => $status
                                    );
                                endwhile;
                            else :
                            // no rows found
                            endif;
                        }
                    endwhile;
                }
                $data[] = array(
                    'postid' => $post->ID,
                    'name' => $post->post_title,
                    'task_list' => $taskList
                );
            endwhile;
            getJson(array('status' => '1', 'data' => $data, 'message' => 'Success.'));
        } else {
            getJson(array('status' => '0', 'message' => 'No record found.'));
        }
    } else {
        getJson(array('status' => '0', 'message' => 'Bed Request.'));
    }
}

function updateTask() {
    if (isset($_REQUEST['crew_code']) && $_REQUEST['crew_code'] != '' && isset($_REQUEST['user_id']) && $_REQUEST['user_id']
            != '' && isset($_REQUEST['postid']) && $_REQUEST['postid'] != '' && isset($_REQUEST['status_key']) && $_REQUEST['status_key']
            != '' && isset($_REQUEST['status']) && $_REQUEST['status'] != '') {
        $code = $_REQUEST['crew_code'];
        $userId = $_REQUEST['user_id'];
        $status_key = $_REQUEST['status_key'];
        $status = $_REQUEST['status'];
        $postid = $_REQUEST['postid'];

        update_field($status_key, $status, $postid);
        getJson(array('status' => '1', 'message' => 'Task status updated successfully.'));
    } else {
        getJson(array('status' => '0', 'message' => 'Bed Request.'));
    }
}

?>