<?php //require_once("../../_layouts/header.php"); ?>


<?php // Authorization. ?>
<?php //if (!$session->is_logged_in()) { redirect_to(LOCAL . "/public/index.php"); } ?>


<!--Main content-->


<!--Templates-->
<?php // require_once(PUBLIC_PATH . "/__view/admin_tools/user_management/templates/users_container.php");   ?>


<!--Styles-->
<link href="<?php echo LOCAL . "/public/_styles/timeline_post_replies/read.css"; ?>" rel="stylesheet" type="text/css">



<!--Scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/instance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/general_functions2.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/general_functions3.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/create.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/fetch.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_replies/TimelinePostReply.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/event_handlers.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_replies/tasks.js"; ?><!--"></script>-->


<!--Extentional scripts for creating timeline-post-reply-notifications-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/timeline_post_replies/create.js"; ?>"></script>