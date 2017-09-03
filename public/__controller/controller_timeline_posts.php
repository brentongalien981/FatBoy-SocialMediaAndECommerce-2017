<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/timeline_posts.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/my_database.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<?php use App\Publico\Model\MyValidationErrorLogger; ?>


<?php

if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>


<?php
//uki
function DEBUG_get_select() {
    $return_value = "";
    $return_value .= "<select>";

    for ($i=0; $i<50; $i++) {
        $return_value .= "<option>{$i}";
        $return_value .= "</option>";
    }


    $return_value .= "</select>";

    return $return_value;
}
function get_response_bar()
{
    $response_bar = "";
    $response_bar .= "<div class='b-post-response-bar'>";



    $response_bar .= "<div id='' class='response-icon-container rate-pseudo-button rate-bar-hover-trigger'>";
    $response_bar .= "<img title='Your Reaction' class='response-bar-icons rate-bar-hover-trigger' src='" . LOCAL . "/public/_photos/heart.png" . "'>";
    $response_bar .= "<h6 class='response-icon-label rate-bar-hover-trigger'>Your Reaction</h6>";
    $response_bar .= "</div>";

//    $response_bar .= "<div class='response-icon-container'>";
//    $response_bar .= DEBUG_get_select();
//    $response_bar .= "</div>";

    $response_bar .= "<div class='response-icon-container'>";
    $response_bar .= "<img title='Number of Reactions' class='response-bar-icons' src='" . LOCAL . "/public/_photos/sum.png" . "'>";
    $response_bar .= "<h6 class='response-icon-label'>7.6M</h6>";
    $response_bar .= "</div class='response-icon-container'>";

    $response_bar .= "<div class='response-icon-container'>";
    $response_bar .= "<img title='Average Reaction' class='response-bar-icons' src='" . LOCAL . "/public/_photos/average.png" . "'>";
    $response_bar .= "<h6 class='response-icon-label'>+5.3 Lupet</h6>";
    $response_bar .= "</div>";

    $response_bar .= "</div>";

    return $response_bar;
}

function get_completely_presented_timeline_notifications_array($currently_viewed_user_id)
{
//    global $connection;

    $query = "SELECT * ";
    $query .= "FROM TimelinePosts INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
    $query .= "WHERE owner_user_id = {$currently_viewed_user_id} ";
    $query .= "ORDER BY date_posted DESC";

    //
    $timeline_notifications_records_result_set = TimelinePost::read_by_query($query);


    //
    $completely_presented_timeline_notifications_array = array();


    global $database;

    while ($row = $database->fetch_array($timeline_notifications_records_result_set)) {
        // TODO: Complete the HTML parts.
        $completely_presented_timeline_notification = "<div class='post_background'>";
        $completely_presented_timeline_notification .= "<div id='post{$row['id']}' class='message_post'>";


//        Post details
        $completely_presented_timeline_notification .= "<div class='b-post-details-bar'>";

        $completely_presented_timeline_notification .= "<div>";
//        $completely_presented_timeline_notification .= "<img class='b-profile-pic' src='https://farm5.staticflickr.com/4365/36521302700_aeb8485cf2_q.jpg'>";
        $completely_presented_timeline_notification .= b_get_profile_pic_el_string($row['user_id'], "post", "b-profile-pic");
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "<div class='meta-details'>";
        $completely_presented_timeline_notification .= "<h4 class='meta-name'>{$row['user_name']}</h4>";
        $completely_presented_timeline_notification .= "<h5 class='meta-date'>{$row['date_posted']}</h5>";
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "<div class='settings-icon-container'>";
        $completely_presented_timeline_notification .= "<i class='fa fa-sliders settings-icon'></i>";
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "</div>";


        $completely_presented_timeline_notification .= "<div class='b-post-main-content'>";
        $completely_presented_timeline_notification .= "<p class='timeline_post_p'>" . "{$row['message']}" . "</p>";
        $completely_presented_timeline_notification .= "</div>";

        //
        $completely_presented_timeline_notification .= get_response_bar();


        // This div is just to have a reference for appending the reply form.
        $completely_presented_timeline_notification .= "<div class='empty_div_shit'></div>";


        // Attach all the replies on this specific post.
        require_once("controller_timeline_post_replies.php");
        $completely_presented_timeline_post_replies_array = get_completely_presented_timeline_post_replies_array($row["id"]);
        foreach ($completely_presented_timeline_post_replies_array as $reply) {
            $completely_presented_timeline_notification .= $reply;
        }


//        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' onclick='createForm({$row['id']})' class='link_reply form_buttons'>reply</button>";
        $completely_presented_timeline_notification .= "</div>";
//        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' onclick='createForm({$row['id']})' class='link_reply form_buttons'>reply</button>";
//        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' class='link_reply form_buttons'>reply</button>";
        $completely_presented_timeline_notification .= "</div>";

        // Put that one specific post to the array of user's posts.
        array_push($completely_presented_timeline_notifications_array, $completely_presented_timeline_notification);
    }


    return $completely_presented_timeline_notifications_array;
}

// TODO:SECTION:Function is_csrf_token_legit(). Delete this later.
//function is_csrf_token_legit() {
//    if (is_csrf_token_valid()) {
////        MyValidationErrorLogger::log("csrf_token::: valid.");
//
//        if (is_csrf_token_recent()) {
////            MyValidationErrorLogger::log("csrf_token::: recent.");
//            return true;
//        } else {
//            MyValidationErrorLogger::log("csrf_token::: not recent.");
//            return false;
//        }
//    } else {
//        MyValidationErrorLogger::log("csrf_token::: invalid.");
//        return false;
//    }
//}

function create_timeline_post_record()
{
    //
    $is_creation_ok = create_timeline_post_record_bruh();


    if ($is_creation_ok) {
        return_completely_presented_post();
    }
}

function return_completely_presented_post()
{
    global $session;
    $query = "SELECT * ";
    $query .= "FROM TimelinePosts ";
    $query .= "INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
    $query .= "WHERE owner_user_id = {$session->currently_viewed_user_id} ";
    $query .= "AND date_posted = ";
    $query .= "(SELECT MAX(date_posted) FROM TimelinePosts WHERE owner_user_id = {$session->currently_viewed_user_id})";


    $record_result = TimelinePost::read_by_query($query);


    global $database;
    $completely_presented_timeline_notification = "";

//    uki4

    while ($row = $database->fetch_array($record_result)) {

        $completely_presented_timeline_notification .= "<div id='post{$row['id']}' class='message_post'>";


//        Post details
        $completely_presented_timeline_notification .= "<div class='b-post-details-bar'>";

        $completely_presented_timeline_notification .= "<div>";
//        $completely_presented_timeline_notification .= "<img class='b-profile-pic' src='https://farm5.staticflickr.com/4365/36521302700_aeb8485cf2_q.jpg'>";
        $completely_presented_timeline_notification .= b_get_profile_pic_el_string($row['user_id'], "post", "b-profile-pic");
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "<div class='meta-details'>";
        $completely_presented_timeline_notification .= "<h4 class='meta-name'>{$row['user_name']}</h4>";
        $completely_presented_timeline_notification .= "<h5 class='meta-date'>{$row['date_posted']}</h5>";
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "<div class='settings-icon-container'>";
        $completely_presented_timeline_notification .= "<i class='fa fa-sliders settings-icon'></i>";
        $completely_presented_timeline_notification .= "</div>";

        $completely_presented_timeline_notification .= "</div>";


        $completely_presented_timeline_notification .= "<div class='b-post-main-content'>";
        $completely_presented_timeline_notification .= "<p class='timeline_post_p'>" . "{$row['message']}" . "</p>";
        $completely_presented_timeline_notification .= "</div>";

        //
        $completely_presented_timeline_notification .= get_response_bar();


        // This div is just to have a reference for appending the reply form.
        $completely_presented_timeline_notification .= "<div class='empty_div_shit'></div>";


    }

    echo $completely_presented_timeline_notification;
}

function create_timeline_post_record_bruh()
{
    global $session;
    $new_timeline_post_obj = new TimelinePost();

//    $new_timeline_post_obj->id = null;
    $new_timeline_post_obj->owner_user_id = $session->currently_viewed_user_id;
    $new_timeline_post_obj->poster_user_id = $session->actual_user_id;
    $new_timeline_post_obj->message = $_POST["message_post"];

    $is_creation_ok = $new_timeline_post_obj->create_with_bool();

    if ($is_creation_ok) {
        return true;
    } else {
        return false;
    }
}

// TODO:REMINDER: Delete this  later.
//// Use only allowable GET and POST variables. 
//// Maybe put an array like: $allowed_gets = array();
//// @return:
////      - valid POST arrays, or
////      - 0 if there's any tampered/invalid var.
//function are_post_vars_valid($allowed_assoc_indexes_for_post) {
//    $dirty_array = array();
//
//    foreach ($allowed_assoc_indexes_for_post as $assoc_index) {
//
//        if (isset($_POST[$assoc_index])) {
//            $dirty_array[$assoc_index] = $_POST[$assoc_index];
////            MyValidationErrorLogger::log("post_vars::: {$assoc_index} ok.");
//        } else {
//            MyValidationErrorLogger::log("post_vars::: tampered.");
//            return 0;
//        }
//    }
//
//    return $dirty_array;
//
////// TODO: DEBUG
////    foreach ($dirty_array as $value) {
////        MyDebugMessenger::add_debug_message("VAR ARRAY dirty_array: {$value}.");
////    }
//}

// @param $var_lengts_arr: Post vars that need their length validated.
function validate_new_timeline_post($var_lengts_arr)
{

//    //  
//    $var_lengts_arr = array("message_post" => ["min" => 1, "max" => 1000]);


    //
    foreach ($var_lengts_arr as $key => $value) {
        // Validate presence.
        if (!has_presence($_POST[$key])) {
            MyValidationErrorLogger::log("{$key}::: can not be blank");

            return false;
        }

        // Validate the length.   
        if (!has_length($_POST[$key], $value)) {
            MyValidationErrorLogger::log("{$key}::: should be between {$value['min']} to {$value['max']} characters.");

            // 1 mistake alone, return false right away.
            return false;
        }
    }

    // If all tests passed.
    return true;

}

?>


<?php

// TODO: SECTION: Meat.
if (is_request_post() &&
    isset($_POST["create_post"]) &&
    $_POST["create_post"] == "yes") {

    // Fuckin need this everytime you validate.
    MyValidationErrorLogger::initialize();

    // Validation vars.
    $can_proceed = false;
    $allowed_assoc_indexes_for_post = array('message_post');
    $dirty_array = [];
    $sanitized_array = [];

    // Check csrf_token.
    if (is_csrf_token_legit()) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
        echo "0";
    }


    // White listing POST vars.
//    $dirty_array = are_post_vars_valid($allowed_assoc_indexes_for_post);
//    if ($can_proceed && $dirty_array != 0) {
    if ($can_proceed && are_post_vars_valid($allowed_assoc_indexes_for_post)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
        echo "0";
    }


    // Validate inputs.
    $var_lengts_arr = array("message_post" => ["min" => 1, "max" => 1000]);
    if ($can_proceed && validate_new_timeline_post($var_lengts_arr)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
        echo "0";
    }


    // Copy the error messages to the app status messenger.
    foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
        echo "\n" . $log_error_msg;
    }


    MyValidationErrorLogger::reset();


    //
    if ($can_proceed) {
        create_timeline_post_record();
    }


//   // TODO: DEBUG
//    echo "POST CSRF: {$_POST['csrf_token']}\n";
//    echo "SESSION CSRF: {$_SESSION['csrf_token']}\n";
//    return;     

}
?>
