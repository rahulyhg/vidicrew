<?php
global $wpdb;
$userArr = $wpdb->get_results("SELECT notification,type,status,DATE_FORMAT(created_date, %d-%m-%Y) as created_date FROM wp_notification where status='1'");
/*$args = array('meta_query' => array(
        array('key' => 'device_id', 'value' => '', 'compare' => '!='),
        array('key' => 'device_type', 'value' => '', 'compare' => '!='),
        ));
$userArr = get_users($args);*/
$userArr = $wpdb->get_results("SELECT * FROM wp_users where device_id != '' and device_type != ''");
//echo '<pre>';
//print_r($userArr);
?>
<style>
    /*.row{ display: table;
    
    content: " "; }
    .clearfix{ clear: both;}*/
    .form-horizontal .form-group {

        margin-right: -15px;
        margin-left: -15px;

    }
    .form-group {

        margin-bottom: 15px;

    }
    label {

        font-weight: 600;

    }
    label {

        display: inline-block;
        max-width: 100%;

    }
    .form-control {

        height: 36px;
        padding: 3px 10px;
        border: 1px solid #dddddd;
        border-radius: 3px;
        color: #555;

    }

    .form-control {

        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

    }

</style>
<h1>Broadcast Notification</h1>
<div>

    <?php if ($successMessage != '') { ?> <div><span style="color:green;font-weight: bold;"><?php echo $successMessage; ?></span></div> <?php
    }
    if ($errorMessage != '') {
        ?> <div><span style="color:red;font-weight: bold;"><?php echo $errorMessage; ?></span></div>  <?php
        }
        ?>


    <form method="POST">
        <div class="row cleafix">
            <?php
            if (isset($userArr) && count($userArr) > 0) {
                ?>
                <div class="form-group">
                    <label class="control-label">Notification</label>
                    <div class="">
                        <textarea class="" name="notification" rows="4" cols="80"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class=" control-label">Notification Type</label>
                    <div class="">
                        <input class="form-control" name="type" value="user_specific" type="radio">User Specific
                        <input class="form-control" name="type" value="broadcast" type="radio" checked="checked">Broadcast
                    </div>
                </div>
                <div class="form-group">
                    <label class=" control-label">Select User</label>
                    <div class="">
                        <select name="device_user[]" id="device_user" multiple="">
                            <?php
                            if (isset($userArr) && count($userArr) > 0) {
                                foreach ($userArr as $data) {
//                                    $wpdb->insert(
//                                            'wp_notification',
//                                            array(
//                                        'user_id' => $data->ID,
//                                        'notification' => $msg,
//                                        'created_date' => date('Y-m-d H:i:s'),
//                                        'status' => '1',
//                                        'type' => $type
//                                            )
//                                    );
                                    ?><option value="<?php echo $data->ID; ?>"><?php echo $data->display_name; ?></option><?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label"></label>
                    <div class="">
                        <input class="btn btn-primary" name="btnSubmit" value="Send notification" type="Submit">

                    </div>
                </div>
                <?php
            }else{
                
                echo '<b>No record found.</b>';
            }
            ?>

        </div>
    </form>
</div>
