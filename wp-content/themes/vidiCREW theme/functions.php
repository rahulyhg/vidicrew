<?php
/** 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */			
	
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php'); 

// Adds site styles to the WordPress editor
// require_once(get_template_directory().'/functions/editor-styles.php'); 

// Remove Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/admin.php');

/*

New functions by J.R. - move into plugins or refactor?

*/

// Login redirect - do not redirect subscribers to admin area

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			//return home_url(); // Location to redirect to - should be My Account
			return get_permalink( get_page_by_path( 'my-account' ) );
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

// Add ability to show/hide menu items based on login status - requires "If Menu" plugin

function wpb_new_menu_conditions( $conditions ) {
  $conditions[] = array(
    'name'    =>  'If NOT logged in', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
		if(is_user_logged_in()) {
			return false;
		} else {
			return true;
		}
    }
  );
 
  return $conditions;
}

add_filter( 'if_menu_conditions', 'wpb_new_menu_conditions' );

// Redirect failed frontend login and logout

function front_end_login_fail( $username ) {
   	$referrer = $_SERVER['HTTP_REFERER'];
   	// If there's a valid referrer, and it's not the default log-in screen
   	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
	  
	if(!strpos($referrer, 'login=failed')) {
		$append = (strpos($referrer, '?') == true) ? '&login=failed' : '?login=failed';
	} else {
		$append = '';
	}
	wp_redirect( $referrer . $append );  // let's append some information (login=failed) to the URL for the theme to use
	exit;
   	}
}

add_action( 'wp_login_failed', 'front_end_login_fail' );

function auto_redirect_after_logout(){
	$referrer = $_SERVER['HTTP_REFERER'];
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		wp_redirect( home_url() );
		exit();
	}
}

add_action('wp_logout','auto_redirect_after_logout');

/* filter buddypress group to read CREW on front-end
* @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext


function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Group!' :
			$translated_text = __( 'CREW', 'buddypress' );
			break;
		case 'Groups' :
			$translated_text = __( 'CREWS', 'buddypress' );
			break;
		case 'group' :
			$translated_text = __( 'CREW', 'buddypress' );
			break;
		case 'groups' :
		$translated_text = __( 'CREWS', 'buddypress' );
		break;
	}
	return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );
*/
/** notification start */
add_action("admin_menu", "add_notification_menu_item");

function add_notification_menu_item() {
    add_menu_page("Notifications", "Notifications", "manage_options",
            "notification", "notification");
}

function notification() {
    global $wpdb;
    $successMessage = '';
    $errorMessage = '';
    if (isset($_POST['notification'])) {

        if ($_POST['notification'] != '') {
            $msg = $_POST['notification'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'broadcast';
            if ($type == 'broadcast') {
                $userArr = $wpdb->get_results("SELECT device_id, device_type, display_name,id FROM wp_users where device_id!= '' and device_type != '' ");

                if (isset($userArr) && count($userArr) > 0) {
                    foreach ($userArr as $data) {
                        $wpdb->insert(
                                'wp_notification',
                                array(
                            'user_id' => $data->id,
                            'notification' => $msg,
                            'created_date' => date('Y-m-d H:i:s'),
                            'status' => '1',
                            'type' => $type)
                        );
                        $ipquery = $wpdb->get_results("SELECT notification,type,status,DATE_FORMAT(created_date, %d-%m-%Y) as created_date FROM wp_notification where status='1' and user_id=" . $data->id);
                        $count = $ipquery->num_rows;
                        //$count = '1';
                        $message = array
                            (
                            'message' => $msg,
                            'title' => '',
                            'vibrate' => 1,
                            'sound' => 1,
                            'notification_count' => $count
                        );
                        $msg1 = sendPushNotification(array($data->device_id),
                                $message, $data->device_type);
                    }
                }
            } else if ($type == 'user_specific' && isset($_POST['device_user'])) {

                if (count($_POST['device_user']) > 0) {
                    foreach ($_POST['device_user'] as $key => $val) {
                        $data = $wpdb->get_row("SELECT device_id, device_type, display_name,id FROM wp_users where device_id!= '' and device_type != '' and id=" . $val);

                        if (isset($data->id)) {
                            $wpdb->insert(
                                    'wp_notification',
                                    array(
                                'user_id' => $val,
                                'notification' => $msg,
                                'created_date' => date('Y-m-d H:i:s'),
                                'status' => '1',
                                'type' => $type
                                    )
                            );
                            $ipquery = $wpdb->get_results("SELECT notification,type,status,DATE_FORMAT(created_date, %d-%m-%Y) as created_date FROM wp_notification where status='1' and user_id=" . $val);
                            $count = $ipquery->num_rows;
                            $message = array
                                (
                                'message' => $msg,
                                'title' => '',
                                'vibrate' => 1,
                                'sound' => 1,
                                'notification_count' => $count
                            );
                            $msg1 = sendPushNotification(array($data->device_id),
                                    $message, $data->device_type);
                        }
                    }
                }
            }
            $successMessage = 'Notification sent successfully.';
        } else {
            $errorMessage = 'Please enter notification.';
        }
    }
    include 'form-file.php';
}

//function to send push notification
function sendPushNotification($registrationIds = array(), $message = array(),
        $deviceType) {
    $deviceType = strtolower($deviceType);
    if ($deviceType == 'android') {
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $message,
        );

// Update your Google Cloud Messaging API Key
        if (!defined('GOOGLE_API_KEY')) {
            define("GOOGLE_API_KEY",
                    "AAAAXcVCasQ:APA91bHjxKcFVvNgLDak_A5FuLWpd_WTy4VTozFkDkdyk5bnScL2iPYNpdaCEExFuUTxSClpu-hndvL-a3jgWI4PL1-Y8rDRxVIgNX29MN7HejK_bZlB9x0_uNGisMFQH15_4lCSnDal");
        }
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($result);

        return TRUE;
    } else if (strtolower($deviceType) == 'ios') {

        $deviceToken = $registrationIds[0];
        $passphrase = '';


        $fileName = 'Certificates.pem';
//            $gateway = 'ssl://gateway.push.apple.com:2195';
        $gateway = 'ssl://gateway.sandbox.push.apple.com:2195';


        $ctx = stream_context_create();
        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert',
                get_template_directory() . '/' . $fileName);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client($gateway, $err, $errstr, 60,
                STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        $msg = $message['message'];

        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'title' => $message['title'],
                'body' => $msg,
            ),
            'badge' => (int) $message['notification_count'],
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n',
                        strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);

        if (!$result)
            return 'Message not delivered' . PHP_EOL;
        else
            return 'Message successfully delivered' . PHP_EOL;
    }
}

/** notification end */
/** add custom post type start */
add_action('init', 'fun_custom_post_types');

function fun_custom_post_types() {
    $allPostTypes = array(
        // Events Post Type
        array(
            'post_type' => 'shotlist',
            'singular' => 'Shotlist',
            'plural' => 'Shotlist',
            'genname' => 'shotlist',
            'menuicon' => 'dashicons-flag',
            'supportarr' => array('title')
        ),
        
    );
    foreach ($allPostTypes as $postType) {
        $post_type = $postType['post_type'];
        $singular = $postType['singular'];
        $plural = $postType['plural'];
        $genrlname = $postType['genname'];
        $menuicon = $postType['menuicon'];
        $supportarr = $postType['supportarr'];

        $labels = array(
            'name' => _x($plural . 's', $genrlname . 's', 'vidicrew'),
            'singular_name' => _x($singular, $genrlname, 'vidicrew'),
            'menu_name' => _x($plural . 's', $genrlname . 's', 'vidicrew'),
            'name_admin_bar' => _x($singular, $genrlname, 'vidicrew'),
            'add_new' => _x('Add New', $singular, 'vidicrew'),
            'add_new_item' => __('Add New ' . $singular, 'vidicrew'),
            'new_item' => __('New ' . $singular, 'vidicrew'),
            'edit_item' => __('Edit ' . $singular, 'vidicrew'),
            'view_item' => __('View ' . $singular, 'vidicrew'),
            'all_items' => __('All ' . $plural . 's', 'vidicrew'),
            'search_items' => __('Search ' . $plural, 'vidicrew'),
            'parent_item_colon' => __('Parent ' . $plural . ':', 'vidicrew'),
            'not_found' => __('No ' . $singular . ' found.', 'vidicrew'),
            'not_found_in_trash' => __('No ' . $singular . ' found in Trash.',
                    'vidicrew')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'capabilities' => array(
                'publish_posts' => 'manage_options',
                'edit_posts' => 'manage_options',
                'edit_others_posts' => 'manage_options',
                'delete_posts' => 'manage_options',
                'delete_others_posts' => 'manage_options',
                'read_private_posts' => 'manage_options',
                'edit_post' => 'manage_options',
                'delete_post' => 'manage_options',
                'read_post' => 'manage_options',
            ),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => $menuicon,
            'supports' => $supportarr
        );
        register_post_type($post_type, $args);
    }
}
/** add custom post type end */