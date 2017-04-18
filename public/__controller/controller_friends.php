<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/my_user.php"); ?>






<?php
// Protected page.
if ((!$session->is_logged_in()) || (!$session->is_viewing_own_account())) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function show_non_friends() {
    //
    global $database;
    global $session;

    $query = "SELECT user_id, user_name ";
    $query .= "FROM Users ";
    $query .= "WHERE user_id NOT IN ";
    $query .= "(";
    $query .= "SELECT friend_id ";
    $query .= "FROM Friendship ";
    $query .= "WHERE user_id = {$session->actual_user_id}";
    $query .= ") ";
    $query .= "AND user_id != {$session->actual_user_id} ";

    // Also, don't suggest users that are currently in pending friendship status with you.
    $query .= "AND user_id NOT IN (";
    $query .= "SELECT notified_user_id ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "WHERE notifier_user_id = {$session->actual_user_id}) ";

    $query .= "AND user_id NOT IN (";
    $query .= "SELECT notifier_user_id ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "WHERE notified_user_id = {$session->actual_user_id})";


    //
    $non_friends_records_result_set = User::read_by_query($query);

    
    // If the code goes here, the query is ok.
    echo "<br><br><br>";
    echo "<h4>Suggested Friends</h4>";
    echo "<table>";
    while ($row = $database->fetch_array($non_friends_records_result_set)) {
        echo "<tr>";
            echo "<td>" . "{$row['user_name']}" . "</td>";
            // TODO: It is supposed to be like this:
            // TODO: "<td>" . "<a href='friendship_notification_creation.php?friend_id={$row['UserId']}'>add</a>" . "</td>";
            echo "<td><a>add</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function validate_video_form() {
    //
    MyValidationErrorLogger::initialize();


    //
    $video_title = $_POST["video_title"];
    $embedded_video_code = $_POST["embedded_video_code"];

    // validations
    $required_fields = array("video_title", "embedded_video_code");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("video_title" => 100, "embedded_video_code" => 1000);
    validate_max_lengths($fields_with_max_lengths);


    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS video validation.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL video validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        redirect_to("../__view/view_my_videos.php");
    }
}

function add_new_video_record_to_db() {
    //
    $video_title = $_POST["video_title"];
    $embedded_video_code = $_POST["embedded_video_code"];

    //
    $new_video = new MyVideo();
    $new_video->id = null;
    global $session;
    $new_video->user_id = $session->actual_user_id;
    $new_video->title = $video_title;
    $new_video->embed_code = $embedded_video_code;
    $default_rating = 7;
    $new_video->rating = $default_rating;


    //
    $video_creation_result_flag = $new_video->create_with_bool();


    if ($video_creation_result_flag) {
        MyDebugMessenger::add_debug_message("SUCCESS creation and insertion of video record.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL creation and insertion of video record.");
    }
}

function get_completely_presented_user_videos_array() {
    global $session;

    //
    $query = "SELECT * FROM MyVideos ";
    $query .= "WHERE user_id = {$session->actual_user_id} ";
    $query .= "ORDER BY id DESC";


    //
    $user_videos_records_result_set = MyVideo::read_by_query($query);


    //
    $completely_presented_user_videos_array = array();


    //
    require_once("../__model/my_database.php");
    global $database;

    while ($row = $database->fetch_array($user_videos_records_result_set)) {
        //
        $completely_presented_user_video = "<tr>";
        $completely_presented_user_video .= "<td>";
        $completely_presented_user_video .= "<div>";
        $completely_presented_user_video .= "<h4>{$row['title']}</h4>";
        $completely_presented_user_video .= "{$row['embed_code']}<br>";
        $completely_presented_user_video .= "<a>lupetness</a>";
        $completely_presented_user_video .= "</div>";
        $completely_presented_user_video .= "</td>";
        $completely_presented_user_video .= "</tr>";

        //
        array_push($completely_presented_user_videos_array, $completely_presented_user_video);
    }


    // 
    return $completely_presented_user_videos_array;
}
?>




<!--Meat-->
<?php
if (isset($_POST["add_video"])) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON add video clicked.");


    // Validattion.
    validate_video_form();


    // If the code goes here, that means the validation passed.
    add_new_video_record_to_db();


    // 
    redirect_to("../__view/view_my_videos.php");
}
?>