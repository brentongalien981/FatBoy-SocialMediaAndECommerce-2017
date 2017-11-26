<?php require_once("../../_layouts/header.php"); ?>


<?php if (!$session->is_logged_in()) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>


    <main id="middle_content">

        <nav id="sub_menus_nav">
            <?php if ($session->is_viewing_own_account()) { ?>
                <button class="cancel-add-product-btn">&lt; back to products</button>
                <button id="add-product-btn">+ Add Item</button>
                <button id="edit-products-btn">* Edit Item</button>
            <?php } ?>
        </nav>


        <div id="main_content">
            <?php require_once(PUBLIC_PATH . "/__view/store_items/read.php"); ?>

            <?php if ($session->is_viewing_own_account()) { ?>
                <?php require_once(PUBLIC_PATH . "/__view/store_items/create.php"); ?>
                <?php require_once(PUBLIC_PATH . "/__view/store_items/update.php"); ?>
<!--                --><?php //require_once(PUBLIC_PATH . "/__view/store_items/delete.php"); ?>
            <?php } ?>

            <!-- Reference-->
            <div id="read-more-store-items-initiator-reference" class="load-more-objs-reference"></div>
        </div>

        <!--Templates-->
        <!--    Extentional -->

    </main>


    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_items/index.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_items/read.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/store_items/update.css"; ?>">


    <!--Scripts-->
    <!--Late-bind scripts-->
    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
    <script>document.getElementById("title").innerHTML = "My Store / FatBoy";</script>


    <!--Extentional scripts-->
    <!--Extentional Scripts for adding items to cart.-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/instance_vars.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/cart_items/general_functions.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/general_functions2.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/general_functions3.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/cart_items/create.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/read.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/update.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/cart_items/CartItem.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_handlers.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/event_listeners2.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/cart_items/tasks.js"; ?><!--"></script>-->



    <!--Main scripts-->
        <script src="<?php echo LOCAL . "/public/_scripts/store_items/instance_vars.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/general_functions.js"; ?>"></script>
        <script src="<?php echo LOCAL . "/public/_scripts/store_items/general_functions2.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_items/general_functions3.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/create.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/read.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/update.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_items/delete.js"; ?><!--"></script>-->
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_items/fetch.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/StoreItem.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/event_handlers.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/event_listeners.js"; ?>"></script>
    <!--<script src="--><?php //echo LOCAL . "/public/_scripts/store_items/event_listeners2.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/store_items/tasks.js"; ?>"></script>


    <!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>