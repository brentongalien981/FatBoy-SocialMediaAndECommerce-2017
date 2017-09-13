<?php if (!$session->is_logged_in()) { return; } ?>

<!--Styles-->
<link href="<?php echo LOCAL . "/public/_styles/widgets/index.css"; ?>" rel="stylesheet" type="text/css">

<div id="b-widget" class="widget">
    <div id="notifications-menu-bar"><i id="collapse-notifications-icon" class="fa fa-angle-double-down" style="font-size:18px"></i></div>
    <?php require_once(PUBLIC_PATH . "/__view/notifications_widget/index.php"); ?>
</div>

<div id="the-widget"></div>



<!--Scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/main_script.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/instance_vars.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/general_functions.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/Photo.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/widgets/event_listeners.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/widgets/tasks.js"; ?><!--"></script>-->