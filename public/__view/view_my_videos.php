<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once("../__controller/controller_my_videos.php"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>






<!--Main content.-->

<!--Add a new video.-->
<?php
if ($session->is_viewing_own_account()) {
    //
    show_add_new_video_form();
}
?>








<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="../_styles/view_my_videos.css" rel="stylesheet" type="text/css" />
<style>   
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_videos.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MyVideos";
</script>





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
