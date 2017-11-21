<?php require_once("../../_layouts/header.php"); ?>


<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>




<main id="middle_content">

    <nav id="sub_menus_nav">
    </nav>


    <div id="main_content">
        <?php if (isset($_GET["paypal_payment_preparation_result_msg"])) { ?>
            <h4><?= $_GET["paypal_payment_preparation_result_msg"]; ?></h4>
        <?php } ?>

<!--        paypal_invoice_id-->


    </div>



</main>


<!--Styles-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //echo LOCAL . "/public/_styles/paypal_payment/index.css"; ?><!--">-->



<!--Scripts-->
<!--Late-bind scripts-->
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
<script>document.getElementById("title").innerHTML = "Payment Result / FatBoy";</script>

<!--Extentional scripts-->

<!--Main scripts-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/instance_vars.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/general_functions.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/general_functions3.js"; ?><!--"></script>-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/read.js"; ?><!--"></script>-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/delete.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/fetch.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/StoreCart.js"; ?><!--"></script>-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_handlers.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/event_listeners2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/paypal_payment/tasks.js"; ?><!--"></script>-->


<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
