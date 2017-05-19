<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/timeline_posts.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/my_database.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>
    






<?php

if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

function get_completely_presented_timeline_notifications_array($currently_viewed_user_id) {
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
        $completely_presented_timeline_notification .= "<div id='{$row['id']}' class='message_post'>";
        $completely_presented_timeline_notification .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_timeline_notification .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_timeline_notification .= "<p class='timeline_post_p'>" . "{$row['message']}" . "</p>";
        
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
        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' onclick='createForm({$row['id']})' class='link_reply form_buttons'>reply</button>";
        $completely_presented_timeline_notification .= "</div>";

        // Put that one specific post to the array of user's posts.
        array_push($completely_presented_timeline_notifications_array, $completely_presented_timeline_notification);
    }



    return $completely_presented_timeline_notifications_array;
}

function create_timeline_post_record() {
    $is_validation_ok = validate_new_timeline_post();
    
    //
    $is_creation_ok = false;
    
    
    if ($is_validation_ok) {
        $is_creation_ok = create_timeline_post_record_bruh();
    }
    
    
    if ($is_creation_ok) {
         return_completely_presented_post();
    }
    
}

function return_completely_presented_post() {
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
    
    while ($row = $database->fetch_array($record_result)) {
        // TODO: Complete the HTML parts.
//        $completely_presented_timeline_notification .= "<div class='post_background'>";
        $completely_presented_timeline_notification .= "<div id='{$row['id']}' class='message_post'>";
        $completely_presented_timeline_notification .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_timeline_notification .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_timeline_notification .= "<p>" . "{$row['message']}" . "</p><br>";
        $completely_presented_timeline_notification .= "</div>";
        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' onclick='createForm({$row['id']})' class='link_reply form_buttons'>reply</button>";
//        $completely_presented_timeline_notification .= "</div>";    
    }
    
    echo $completely_presented_timeline_notification;
}

function create_timeline_post_record_bruh() {
    global $session;
    $new_timeline_post_obj = new TimelinePost();
    
//    $new_timeline_post_obj->id = null;
    $new_timeline_post_obj->owner_user_id = $session->currently_viewed_user_id;
    $new_timeline_post_obj->poster_user_id = $session->actual_user_id;
    $new_timeline_post_obj->message = $_POST["message_post"];
    
    $is_creation_ok = $new_timeline_post_obj->create_with_bool();
    
    if ($is_creation_ok) {
        return true;
    }
    else {
        return false;
    }
}

function validate_new_timeline_post() {

    // Fuckin need this everytime you validate.
    MyValidationErrorLogger::initialize();


    // Validations
    // Check if the specific POST global var is not empty.
    $required_fields = array("message_post");
    validate_presences($required_fields);


    $fields_with_max_lengths = array("message_post" => 1000);
    validate_max_lengths($fields_with_max_lengths);
    


    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS create post validation.");
        
        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL create post validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);      
        }


        // 
        return false;
    }
}
?>










<?php

// TODO: SECTION: Meat.
if (isset($_POST["create_post"]) && $_POST["create_post"] == "yes") {
    //
    create_timeline_post_record();
    
    
//    echo "\nmessage post: {$_POST["message_post"]}";
}
?>
