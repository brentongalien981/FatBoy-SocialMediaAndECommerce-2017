<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "/__view/transaction_summary/read.php"); ?>

<!-- Reference for reading more objs. -->
<!--Templates-->
<!--    Extentional -->


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/transaction_summary/read.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->

<!--Extentional scripts-->


<!--Main scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/instance_vars.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/general_functions.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/create.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/transaction_summary/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/fetch.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/Shipping.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/event_handlers.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/transaction_summary/event_listeners.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/transaction_summary/tasks.js"; ?><!--"></script>-->

