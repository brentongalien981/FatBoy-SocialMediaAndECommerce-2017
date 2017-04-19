<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_my_videos.php"); ?>






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
function show_add_new_video_form() {
    $form = "<h4>Add a New Video<h4>";
    $form .= "<form action='../__controller/controller_my_videos.php' method='post'>";
    $form .= "<h6>Video Title</h6>";
    $form .= "<input type='text' name='video_title'/>";
    $form .= "<h6>Embedded Code</h6>";
    $form .= "<textarea name='embedded_video_code' rows='6' cols='100'></textarea><br>";
    $form .= "<input type='submit' name='add_video' value='add video' />";
    $form .= "</form><br><br>";

    echo $form;
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
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
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