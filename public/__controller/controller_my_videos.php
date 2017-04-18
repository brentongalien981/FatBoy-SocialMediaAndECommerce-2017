<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_my_videos.php"); ?>






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
    
}
?>
    

    

<!--Meat-->
<?php
if (isset($_POST["add_video"])) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON add video clicked.");
    
    
    // Validattion.
    validate_video_form();
    
    
    // 
    redirect_to("../__view/view_my_videos.php");
}
?>