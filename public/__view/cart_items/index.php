<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>

<!--Main-->
<?php require_once(PUBLIC_PATH . "/__view/cart_items/read.php"); ?>

<!-- Reference for reading more objs. -->
<!--Templates-->
<!--    Extentional -->


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/cart_items/read.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->

<!--Extentional scripts-->


<!--Main scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/general_functions2.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/general_functions3.js"; ?><!--"></script>-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/create.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/read.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/update.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/fetch.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/CartItem.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/event_handlers.js"; ?>"></script>
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners2.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/cart_items/tasks.js"; ?>"></script>

