<?php require_once("../../_layouts/header.php"); ?>


<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>


    <main id="middle_content">

        <nav id="sub_menus_nav">
            <button
                    id="go-to-cart-selection-nav-btn"
                    class="store-cart-steps-btn
                        go-to-cart-selection-btn
                        my-cart-current-step-navigation-btn">1 Cart
                Selection
            </button>
            <button
                    id="continue-to-shipping-address-nav-btn"
                    class="store-cart-steps-btn
                    continue-to-shipping-address-btn">
                2 Shipping Address
            </button>

            <button
                    id="go-to-shipping-options-nav-btn"
                    class="store-cart-steps-btn
                    go-to-shipping-options-btn">
                3 Shipping Options
            </button>


            <button
                    id="go-to-transaction-summary-nav-btn"
                    class="store-cart-steps-btn
                        go-to-transaction-summary-btn">
                4 Transaction Summary
            </button>
        </nav>


        <div id="main_content">
            <!--        --><?php //require_once(PUBLIC_PATH . "/__view/store_carts/create.php"); ?>
            <?php require_once(PUBLIC_PATH . "/__view/store_carts/read.php"); ?>


            <!--    Extentional: Cart Items -->
            <?php require_once(PUBLIC_PATH . "/__view/cart_items/index.php"); ?>

            <!--    Extentional: Shipping -->
            <?php require_once(PUBLIC_PATH . "/__view/shipping/index.php"); ?>

            <!--    Extentional: Shipping Options -->
            <?php require_once(PUBLIC_PATH . "/__view/shipping_options/index.php"); ?>

            <!--    Extentional: Paypal Payment -->
            <?php require_once(PUBLIC_PATH . "/__view/paypal_payment/index.php"); ?>


            <div id="my-cart-step-incremental-btn-container">


                <button
                        id="continue-to-shipping-address-incremental-btn"
                        class="my-cart-step-incremental-btn
                        my-cart-current-step-incremental-btn
                        continue-to-shipping-address-btn">
                    Fill in shipping address
                </button>

                <button id="go-to-cart-selection-incremental-btn"
                        class="my-cart-step-incremental-btn go-to-cart-selection-btn">
                    Go back to cart selection
                </button>

                <button id="go-to-shipping-options-incremental-btn"
                        class="my-cart-step-incremental-btn go-to-shipping-options-btn">
                    Go to shipping option
                </button>


                <button
                        id="go-back-to-shipping-address-incremental-btn"
                        class="my-cart-step-incremental-btn
                        continue-to-shipping-address-btn">
                    Go back to shipping address
                </button>


                <button
                        id="go-to-transaction-summary-incremental-btn"
                        class="my-cart-step-incremental-btn
                        go-to-transaction-summary-btn">
                    Go to transaction summary
                </button>


                <button id="go-back-to-shipping-options-incremental-btn"
                        class="my-cart-step-incremental-btn go-to-shipping-options-btn">
                    Go back to shipping option
                </button>


<!--                <button id="pay-transaction-incremental-btn"-->
<!--                        class="my-cart-step-incremental-btn pay-transaction-incremental-btn">-->
<!--                    Pay-->
<!--                </button>-->


                <form id="pay-form" method="post" action="<?= LOCAL . "/public/__controller/paypal_payment/PaypalPaymentAjaxHandler.php"; ?>">
                    <input type="hidden" name="shit" value="shit">
                    <input type="hidden" id="input_csrf_token" name="csrf_token" value="<?=sessionize_csrf_token();?>">
                    <input type="hidden" id="shipping-fee-in-pay-form" name="shipping_fee">
                    <input type="hidden" name="authenticate_paypal_seller_acount" value="yes">
                    <input type="hidden" name="prepare_paypal_payment_details" value="yes">
                    <input type="submit" name="pay" value="pay" id="pay-transaction-incremental-btn" class="my-cart-step-incremental-btn pay-transaction-incremental-btn">
                </form>




                <button id="go-back-to-transaction-summary-incremental-btn"
                        class="my-cart-step-incremental-btn go-to-transaction-summary-btn">
                    Go back to transaction summary
                </button>


                <button id="cancel-payment-temp-btn"
                        class="my-cart-step-incremental-btn">
                    cancel-payment-temp-btn
                </button>
            </div>

            <!-- Reference for reading more objs. -->
        </div>

        <!--Templates-->


    </main>


    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_carts/index.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_carts/read.css"; ?>">


    <!--Scripts-->
    <!--Late-bind scripts-->
    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
    <script>document.getElementById("title").innerHTML = "My Cart / FatBoy";</script>

    <!--Extentional scripts-->

    <!--    Extentional: Transaction Summary -->
<?php require_once(PUBLIC_PATH . "/__view/transaction_summary/index.php"); ?>

    <!--    Scripts for session-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/instance_vars.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/session/general_functions.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/general_functions2.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/session/general_functions3.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/create.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/read.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/session/update.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/session/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/session/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/session/Session.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/event_handlers.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/event_listeners.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/session/event_listeners2.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/session/tasks.js"; ?><!--"></script>-->


    <!--Main scripts-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/instance_vars.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/general_functions.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/general_functions2.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/general_functions3.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/create.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/read.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/update.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/StoreCart.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/event_handlers.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/event_listeners.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/event_listeners2.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/tasks.js"; ?>"></script>


    <!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>