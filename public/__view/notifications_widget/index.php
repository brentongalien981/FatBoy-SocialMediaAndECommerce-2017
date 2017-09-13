<?php // Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<!--<link href="--><?php //echo LOCAL . "/public/_styles/notifications/index.css"; ?><!--" rel="stylesheet" type="text/css">-->




<?php  require_once(PUBLIC_PATH . "/__view/notifications/templates/categorized_notifications_container.php");   ?>
<?php  require_once(PUBLIC_PATH . "/__view/notifications/templates/flash_notification.php");   ?>





<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/main_script2.js"; ?>"></script>
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
<?php include(PUBLIC_PATH . "/__view/notifications/my_shopping/index.php"); ?>
<?php include(PUBLIC_PATH . "/__view/notifications/rateable_item/index.php"); ?>







<?php // TODO:SECTION: Supporting scripts for friends notifications when the link "accept" is clicked. ?>
<script src="<?php echo LOCAL . "/public/_scripts/friends/Friendship.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/friends/general_functions.js"; ?>"></script>