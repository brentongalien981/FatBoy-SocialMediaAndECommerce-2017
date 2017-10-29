<?php require_once("../../_layouts/header.php"); ?>


<?php if (!$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
} ?>


    <main id="middle_content">

        <nav id="sub_menus_nav">
            <div id="read-more-invoices-static-reference" class="load-more-objs-reference"></div>
        </nav>


        <div id="main_content">
            <?php require_once(PUBLIC_PATH . "/__view/invoices/read.php"); ?>
        </div>

        <!--Templates-->
        <!--    Extentional -->

    </main>


    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/invoices/index.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/invoices/read.css"; ?>">


    <!--Scripts-->
    <!--Late-bind scripts-->
    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
    <script>document.getElementsByClassName("ad")[0].style.display = "none";</script>
    <script>document.getElementById("title").innerHTML = "My Sales / FatBoy";</script>


    <!--Extentional scripts-->

    <!--    Invoice items-->
    <?php require_once(PUBLIC_PATH . "/__view/invoice_items/index.php"); ?>


    <!--Main scripts-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/instance_vars.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/general_functions.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/general_functions2.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/general_functions3.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/create.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/read.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/update.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/Invoice.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/event_handlers.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/event_listeners.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/invoices/event_listeners2.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/invoices/tasks.js"; ?>"></script>


    <!--Extentional Scripts-->


    <!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>