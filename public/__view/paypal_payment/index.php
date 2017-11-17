<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "/__view/paypal_payment/read.php"); ?>

<!-- Reference for reading more objs. -->
<!--Templates-->

<!--    Extentional -->
<!-- This loader is already provided in the shipping_options.-->
<!-- Maybe put this to a general folder.-->
<?php //require_once(PUBLIC_PATH . "/__view/paypal_payment/shipping_options_loader.php"); ?>


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/paypal_payment/read.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->

<!--Extentional scripts-->


<!--Main scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/instance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/paypal_payment/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/fetch.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/paypal_payment/PaypalSellerAccountAuthentication.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_handlers.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/tasks.js"; ?><!--"></script>-->

