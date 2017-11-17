<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "/__view/shipping_options/read.php"); ?>

<!-- Reference for reading more objs. -->
<!--Templates-->
<!--    Extentional -->
<?php require_once(PUBLIC_PATH . "/__view/shipping_options/shipping_options_loader.php"); ?>


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/shipping_options/read.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->

<!--Extentional scripts-->


<!--Main scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/create.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/fetch.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/ShippingOption.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/event_handlers.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/event_listeners.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/shipping_options/event_listeners2.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/shipping_options/tasks.js"; ?>"></script>

