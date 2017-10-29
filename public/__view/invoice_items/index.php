<?php if (!$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
} ?>


<!--Main content-->

<!--Templates-->
<!--    Extentional -->


<!--Styles-->
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/invoice_items/read.css"; ?>">


<!--Scripts-->
<!--Late-bind scripts-->


<!--Extentional scripts-->


<!--Main scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/instance_vars.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoice_items/general_functions.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/invoice_items/general_functions2.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/create.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoice_items/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoice_items/InvoiceItem.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/event_handlers.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/event_listeners2.js"; ?><!--"></script>-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/invoice_items/tasks.js"; ?><!--"></script>-->


<!--Footer-->