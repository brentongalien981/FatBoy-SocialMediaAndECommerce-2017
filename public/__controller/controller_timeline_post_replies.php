<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/timeline_post_replies.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/timeline_posts.php");    ?>
<?php require_once(PUBLIC_PATH . "/__model/my_database.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php

global $session;
if (!$session->is_logged_in()) {

    redirect_to(LOCAL . "/public/index.php");
}
?>






<?php

function get_completely_presented_timeline_post_replies_array($row_id) {
    $query = "SELECT * ";
    $query .= "FROM TimelinePostReplies INNER JOIN Users ON TimelinePostReplies.poster_user_id = Users.user_id ";
    $query .= "WHERE parent_post_id = {$row_id} ";
    $query .= "ORDER BY date_posted ASC";

    //
    $timeline_post_replies_records_result_set = TimelinePostReply::read_by_query($query);


    // This will be the return.
    $completely_presented_timeline_post_replies_array = array();


    //
    require_once(PUBLIC_PATH . "/__model/my_database.php");
    global $database;

    while ($row = $database->fetch_array($timeline_post_replies_records_result_set)) {
        // TODO: Complete the HTML parts.
//        $completely_presented_timeline_reply = "<br>";
        $completely_presented_timeline_reply = "<div id='{$row['id']}' class='replies'>";
        $completely_presented_timeline_reply .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_timeline_reply .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_timeline_reply .= "<p>" . "{$row['message']}" . "</p>";
        $completely_presented_timeline_reply .= "</div>";

        // Put that one specific post to the array of user's posts.
        array_push($completely_presented_timeline_post_replies_array, $completely_presented_timeline_reply);
    }



    return $completely_presented_timeline_post_replies_array;
}

function return_completely_presented_reply_post($new_reply_post_id) {
    global $session;
    $query = "SELECT * ";
    $query .= "FROM TimelinePostReplies ";
    $query .= "INNER JOIN Users ON TimelinePostReplies.poster_user_id = Users.user_id ";
    $query .= "WHERE id = {$new_reply_post_id}";


    $record_result = TimelinePostReply::read_by_query($query);


    global $database;
    $completely_presented_reply_post = "";

    while ($row = $database->fetch_array($record_result)) {

//        $completely_presented_reply_post .= "<div id='{$row['id']}' class='replies'>";
        $completely_presented_reply_post .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_reply_post .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_reply_post .= "<p>" . "{$row['message']}" . "</p><br>";
//        $completely_presented_reply_post .= "</div>";
    }

    echo $completely_presented_reply_post;
}

function validate_reply_post() {

    // Fuckin need this everytime you validate.
    MyValidationErrorLogger::initialize();


    // Validations
    // Check if the specific POST global var is not empty.
    $required_fields = array("reply_message", "parent_post_id");
    validate_presences($required_fields);


    $fields_with_max_lengths = array("reply_message" => 1000);
    validate_max_lengths($fields_with_max_lengths);



    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS create reply post validation.");

        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL create reply post validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }


        // 
        return false;
    }
}

function create_reply_post_record() {
    // TODO: REMINDER
    $is_validation_ok = validate_reply_post();


    //
    $new_reply_post_id = false;

    //
    if ($is_validation_ok) {
        $new_reply_post_id = create_reply_post_record_bruh();
    }

    //
    if ($new_reply_post_id) {
        return_completely_presented_reply_post($new_reply_post_id);
    }


//    
//    //
//    if (true) {
//        $reply_post_id = return_completely_presented_reply_post();
//    }
//    
//    echo "reply_post_id: {$reply_post_id}";
}

function create_reply_post_record_bruh() {
    global $session;
    $new_reply_post_obj = new TimelinePostReply();

//    $new_reply_post_obj->id = null;
    $new_reply_post_obj->parent_post_id = $_POST["parent_post_id"];
    $new_reply_post_obj->owner_user_id = $session->currently_viewed_user_id;
    $new_reply_post_obj->poster_user_id = $session->actual_user_id;
    $new_reply_post_obj->message = $_POST["reply_message"];

    $is_creation_ok = $new_reply_post_obj->create_with_bool();

    if ($is_creation_ok) {
        return $new_reply_post_obj->id;
    } else {
        return false;
    }
}
?>











<?php

// TODO: SECTION: Meat.
if (isset($_POST["create_reply_post"]) && $_POST["create_reply_post"] == "yes") {
    //
    create_reply_post_record();

//    echo "FUCKIN reply_message: {$_POST['reply_message']}";
//    echo "AYOS AJAX is ok..";
}
?>