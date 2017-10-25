<?php // Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in()) {
    return;
}
?>


<link href="<?php echo LOCAL . "/public/_styles/notifications/index.css"; ?>" rel="stylesheet" type="text/css">


<div id="notifications-widget" class="widget">
    <div id="notifications-menu-bar">
        <?php require_once(PUBLIC_PATH . "/__view/notifications/read2.php"); ?>
<!--        --><?php //require_once(PUBLIC_PATH . "/__view/notifications/templates/categorized_notifications_container.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/templates/flash_notification.php");   ?>
        <i id="collapse-notifications-icon" class="notifications-menu-icons fa fa-angle-double-down"
           style="font-size:18px"></i>
        <i id="expand-notifications-icon" class="notifications-menu-icons fa fa-angle-double-up"
           style="font-size:18px"></i>
    </div>


    <div id="notifications-widget-main-container">
    </div>
</div>


<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/main_script2.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/read.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/update.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/delete.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/Notification.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/event_listeners.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/event_handlers.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/tasks.js"; ?><!--"></script>-->


<?php // Sub-menus. ?>
<?php include(PUBLIC_PATH . "/__view/notifications/friendship/index.php"); ?>
<?php include(PUBLIC_PATH . "/__view/notifications/my_shopping/index.php"); ?>
<?php include(PUBLIC_PATH . "/__view/notifications/rateable_item/index.php"); ?>
<?php include(PUBLIC_PATH . "/__view/notifications/timeline_post_replies/index.php"); ?>



<?php // TODO:SECTION: Supporting scripts for friends notifications when the link "accept" is clicked. ?>
<script src="<?php echo LOCAL . "/public/_scripts/friends/Friendship.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/friends/general_functions.js"; ?>"></script>