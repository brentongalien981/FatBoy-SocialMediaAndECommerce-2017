<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_my_videos.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>






<?php
// Protected page.
if (!$session->is_logged_in()) {
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
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
    $query .= "ORDER BY id DESC";
    
    
    //
    $user_videos_records_result_set = MyVideo::read_by_query($query);    
    
    
    //
    $completely_presented_user_videos_array = array();    
    

    //
    require_once(PUBLIC_PATH . "/__model/my_database.php");
    global $database;
    
    while ($row = $database->fetch_array($user_videos_records_result_set)) {
        //
        $completely_presented_user_video = "<tr>";
            $completely_presented_user_video .= "<td>";
                $completely_presented_user_video .= "<div class='timeline_iframe_video_div section'>";
                    $completely_presented_user_video .= "<h4>{$row['title']}</h4>";
                    $completely_presented_user_video .= "{$row['embed_code']}";
                    $completely_presented_user_video .= "<a id='lupetness_a' href='#'>lupetness</a>";
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





<?php
//if (isset($_POST["add_video"])) {
//    // TODO: LOG
//    MyDebugMessenger::add_debug_message("BUTTON add video clicked.");
//
//
//    // Validattion.
//    validate_video_form();
//
//
//    // If the code goes here, that means the validation passed.
//    add_new_video_record_to_db();
//
//
//    // 
//    redirect_to(LOCAL . "/public/__view/view_my_videos");
//}
?>