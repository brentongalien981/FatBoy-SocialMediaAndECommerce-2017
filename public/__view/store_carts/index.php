<?php require_once("../../_layouts/header.php"); ?>


<?php if ((!$session->is_logged_in() || (!$session->is_viewing_own_account()))) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>


    <main id="middle_content">

        <nav id="sub_menus_nav">
            <button class="store-cart-steps-btn">1 Cart Selection</button>
            <button class="store-cart-steps-btn">2 Shipping Address</button>
            <button class="store-cart-steps-btn">3 Shipping Options</button>
        </nav>


        <div id="main_content">
            <!--        --><?php //require_once(PUBLIC_PATH . "/__view/store_carts/create.php"); ?>
            <?php require_once(PUBLIC_PATH . "/__view/store_carts/read.php"); ?>


            <!-- Reference for reading more objs. -->
        </div>

        <!--Templates-->
        <!--    Extentional -->

    </main>


    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_carts/index.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_carts/read.css"; ?>">


    <!--Scripts-->
    <!--Late-bind scripts-->
    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
    <script>document.getElementById("title").innerHTML = "My Cart / FatBoy";</script>

    <!--Extentional scripts-->

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


    <!--Scripts for cart items.-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/instance_vars.js"; ?><!--"></script>-->
        <script src="<?php echo LOCAL . "/public/_scripts/cart_items/general_functions.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/general_functions2.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/general_functions3.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/create.js"; ?><!--"></script>-->
        <script src="<?php echo LOCAL . "/public/_scripts/cart_items/read.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/update.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/fetch.js"; ?><!--"></script>-->
        <script src="<?php echo LOCAL . "/public/_scripts/cart_items/CartItem.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_handlers.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners2.js"; ?><!--"></script>-->
        <script src="<?php echo LOCAL . "/public/_scripts/cart_items/tasks.js"; ?>"></script>



    <!--Main scripts-->
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/instance_vars.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_carts/general_functions.js"; ?>"></script>
<!--    <script src="--><?php //echo LOCAL . "/public/_scripts/store_carts/general_functions2.js"; ?><!--"></script>-->
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