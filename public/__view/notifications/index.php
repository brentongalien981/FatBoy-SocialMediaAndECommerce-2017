<?php require_once("../../_layouts/header.php"); ?>




<?php // For app debug messenger initialization. ?>
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php // Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<link href="<?php echo LOCAL . "/public/_styles/notifications/index.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <!--<a id="add_video_link">Add Video</a>-->
    </nav>



    <div id="main_content">
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/update.php");   ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/delete.php");   ?>       
    </div>   

    <?php
// TODO:SECTION:LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>    
</main>

<?php  require_once(PUBLIC_PATH . "/__view/notifications/templates/categorized_notifications_container.php");   ?>
<?php  require_once(PUBLIC_PATH . "/__view/notifications/templates/flash_notification.php");   ?>





<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/read.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/update.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/delete.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/Notification.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/tasks.js"; ?><!--"></script>-->




<?php // TODO:SECTION: Sub-menus ?>
<?php include(PUBLIC_PATH . "/__view/notifications/friendship/index.php"); ?>






<?php // TODO:SECTION: Script for page title and main content late bind ?>
<script>document.getElementById("title").innerHTML = "Notifications / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>






<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
