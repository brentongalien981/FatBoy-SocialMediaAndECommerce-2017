<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "/__view/shipping/create.php"); ?>

<!-- Reference for reading more objs. -->
<!--Templates-->
<!--    Extentional -->


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/shipping/create.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->

<!--Extentional scripts-->


<!--Main scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/shipping/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/general_functions3.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/shipping/create.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/fetch.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping/Shipping.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/event_handlers.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/shipping/event_listeners.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping/tasks.js"; ?><!--"></script>-->

