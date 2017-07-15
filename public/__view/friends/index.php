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






<link href="<?php echo LOCAL . "/public/_styles/friends/index.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <!--<a id="add_video_link">Add Video</a>-->
    </nav>



    <div id="main_content">
        <?php // require_once(PUBLIC_PATH . "/__view/friends/create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/friends/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/friends/update.php");   ?>
        <?php // require_once(PUBLIC_PATH . "/__view/friends/delete.php");   ?>       
    </div>   

    <?php
// TODO:SECTION:LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>    
</main>



<?php // TODO:SECTION: Templates. ?>
<?php  require_once(PUBLIC_PATH . "/__view/friends/templates/friendship_container.php");   ?>
<?php // require_once(PUBLIC_PATH . "/__view/notifications/templates/flash_notification.php");   ?>






<?php // TODO:SECTION: Scripts. ?>
<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/friends/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/friends/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/friends/create.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/friends/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/friends/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/friends/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/friends/Friendship.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/friends/tasks.js"; ?><!--"></script>-->




<?php // TODO:SECTION: Sub-menus ?>
<?php // TODO:REMINDER: Late-bind these sub-menus later (* down there to the next chunk). ?>
<?php //require_once(PUBLIC_PATH . "/__view/friends/muses/index.php"); ?>
<?php //require_once(PUBLIC_PATH . "/__view/friends/followers/index.php"); ?>
<?php if ($session->is_viewing_own_account()) { ?>
    <?php require_once(PUBLIC_PATH . "/__view/friends/suggestions/index.php"); ?>
<?php } ?>






<?php // TODO:SECTION: Supporting scripts for notifications. ?>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/instance_vars.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/general_functions.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/Notification.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/tasks.js"; ?><!--"></script>-->






<?php // TODO:SECTION: Script for page title and main content late bind ?>
<script>document.getElementById("title").innerHTML = "Friends / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>




<?php // TODO:SECTION:Script: Ad Displayer.  ?>
<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>





<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
