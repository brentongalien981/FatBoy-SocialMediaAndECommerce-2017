<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_store_cart.php"); ?>

<?php require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// Protected page.
if (!$session->is_logged_in()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function add_item_to_cart($item_id) {
    // Make sure the actual user is not buying from her own store.
    global $session;
    if ($session->is_viewing_own_account()) {
        redirect_to(LOCAL . "/public/__view/view_store_cart.php");
    }


    //
    $seller_user_id = $session->currently_viewed_user_id;
    $buyer_user_id = $session->actual_user_id;

    //
    $does_cart_exist = does_cart_exist($seller_user_id, $buyer_user_id);





    if ($does_cart_exist) {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("<br>DEBUG: CART EXISTS<br>");
    } else {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("<br>DEBUG: CART DOES NOT EXIST<br>");


        // Create a new cart.
        create_new_cart($seller_user_id, $buyer_user_id);
    }



    // Select a current cart based on the seller's user id of that item you're adding.
    set_current_session_cart("", $seller_user_id);



    // Now there's a working session cart.    
    // Check if the to-be-inserted item to cart already exists in that cart.
    $is_item_already_on_cart = is_item_already_on_cart($session->cart_id, $item_id);

    // TODO: DEBUG
    // This might not work because of the var "$is_item_al.....".
    MyDebugMessenger::add_debug_message("<br>is_item_already_on_cart: {$is_item_already_on_cart}<br>");



    //
    if ($is_item_already_on_cart) {
        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("<br>Item was already in cart.<br>");
    } else {
        //
        MyDebugMessenger::add_debug_message("<br>Adding item to cart.<br>");


        //
        $is_creation_ok = add_item_to_cart_bruh($session->cart_id, $item_id);

        //
        MyDebugMessenger::add_debug_message("<br>Adding item to cart message: {$is_creation_ok}.<br>");
    }


    //
    redirect_to(LOCAL . "/public/__view/view_my_store");
}

function show_store_cart_options_form() {
// A list of your incomplete carts from the respective seller stores.
// Query to select all the incomplete carts that
// that have item/s in them.
    global $session;
    $actual_user_id = $session->actual_user_id;

    $query = "SELECT * FROM StoreCart ";
    $query .= "INNER JOIN Users ON StoreCart.seller_user_id = Users.user_id ";
    $query .= "WHERE (buyer_user_id = {$actual_user_id} ";
    $query .= "AND is_complete = 0) ";
    $query .= "ORDER BY user_name";

    // TODO: DEBUG
//    MyDebugMessenger::add_debug_message("QUERY: {$query}.");

    $result_sets = StoreCart::read_by_query($query);


// Form to display and select the cart id
// from that particular user's store.
    echo "<form id='form_selected_cart' method='post' action='" . LOCAL . "/public/__controller/controller_store_cart.php'>";
    echo "<h4>From WHO'S Store?</h4>";
    echo "<select name='selected_cart_id' onchange='this.form.submit()'>";

    global $database;
    while ($row = $database->fetch_array($result_sets)) {
        echo "<option ";

        // Retain the selected seler's store.
        if ($row['cart_id'] == $session->cart_id) {
            echo "selected ";
        }

        echo "value='{$row['cart_id']}'>" . "{$row['user_name']}'s Store" . "</option>";
    }

    echo "</select>";
    echo "<br><br><br>";
    echo "</form>";
}

function show_cart_items_form() {
// Display the items on selected cart.
    // The attribute "action" for this form will be set by the <script>...
    echo "<form action='" . LOCAL . "/public/__view/view_store_cart.php' id='form' method='post'>";
    echo "<table>";

    show_table_header();

// Query to display all the items in the cart selected from that store.
    global $session;
    $query = "SELECT buyer_user_id, CartItems.cart_id, item_id, name, price, CartItems.quantity AS 'quantity', MyStoreItems.quantity AS 'in_stock' ";
    $query .= "FROM CartItems INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "INNER JOIN StoreCart ON CartItems.cart_id = StoreCart.cart_id ";
    $query .= "WHERE CartItems.cart_id = {$session->cart_id} ";
    $query .= "AND is_complete = 0 ";
    $query .= "AND buyer_user_id = {$session->actual_user_id}";

    //
    $result_sets = StoreCart::read_by_query($query);

    //
    show_table_data($result_sets);


    echo "</table><br>";

    echo "<input id='update_cart_items' type='submit' name='update_cart_items' value='update items' disabled='true'>";

    echo "</form>";
}

// Helper
function show_set_shipping_button() {
    echo "<form id='form_continue_to_shipping' action='" . LOCAL . "/public/__view/view_transaction' method='post'>";
    echo "<input id='continue_to_shipping' type='submit' name='continue_to_shipping' value='continue to shipping >>'>";

    echo "</form>";
}

function show_table_header() {
    echo "<thead>";
    echo "<td>";
    echo "ItemId";
    echo "</td>";

    echo "<td>";
    echo "ItemName";
    echo "</td>";

    echo "<td>";
    echo "Price";
    echo "</td>";

    echo "<td>";
    echo "Quantity";
    echo "</td>";

    echo "<td>";
    echo "Stock";
    echo "</td>";
    echo "</thead>";
}

function show_table_data($result_sets) {
    global $database;
    while ($row = $database->fetch_array($result_sets)) {
        echo "<tr>";
        // ItemId
        echo "<td>";
        echo "<h5>{$row['item_id']}</h5>";
        echo "</td>";


        // ItemName
        echo "<td>";
        echo "<h5>{$row['name']}</h5>";
        echo "</td>";


        // ItemPrice
        echo "<td>";
        echo "<h5>\${$row['price']}</h5>";
        echo "</td>";

        // Quantity
//        $default_action_url = LOCAL . 
//        update_quantity_of_items({$default_action_url})
        echo "<td>";
        echo "<input id='{$row['item_id']}' class='quantities' type='number' value='{$row['quantity']}' min='0' max='{$row['in_stock']}' onchange='update_quantity_of_items()'>";
        echo "</td>";


        // In stock
        echo "<td>";
        echo "<h5>{$row['in_stock']}</h5>";
        echo "</td>";
        echo "</tr>";
    }
}

function is_item_already_on_cart($cart_id, $item_id) {
    // Call to controller_cart_item.php.
    return is_item_already_on_cart_bruh($cart_id, $item_id);
}

function set_current_session_cart($cart_id = "", $seller_user_id = "") {
    global $session;
    $buyer_user_id = $session->actual_user_id;
    $code_incomplete_cart = 0;

    if (empty($cart_id)) {
        $query = "SELECT * FROM StoreCart WHERE seller_user_id = {$seller_user_id} AND buyer_user_id = {$buyer_user_id} AND is_complete = {$code_incomplete_cart} LIMIT 1";
    } else if (empty($seller_user_id)) {
        $query = "SELECT * FROM StoreCart WHERE cart_id = {$cart_id} AND buyer_user_id = {$buyer_user_id} AND is_complete = {$code_incomplete_cart} LIMIT 1";
    } else {
        die("FAIL inside function set_current_session_cart().");
    }


    $new_cart_obj = StoreCart::read_by_query_and_instantiate($query)[0];

    global $session;
    $session->set_cart($new_cart_obj);
}

function create_new_cart($seller_user_id, $buyer_user_id) {
    $code_incomplete_cart = 0;

    $current_cart = new StoreCart();
    $current_cart->cart_id = null;
    $current_cart->seller_user_id = $seller_user_id;
    $current_cart->buyer_user_id = $buyer_user_id;
    $current_cart->is_complete = $code_incomplete_cart;

    $is_creation_ok = $current_cart->create_with_bool();

    if ($is_creation_ok) {
        // TODO: DEBUG
        echo "<br>SUCCESS Cart creation.<br>";
    } else {
        // TODO: DEBUG
        echo "<br>FAIL Cart creation.<br>";
    }
}

function does_cart_exist($seller_user_id, $buyer_user_id) {
    //
    $code_incomplete_cart = 0;

    //
    $query = "SELECT * FROM StoreCart WHERE seller_user_id = {$seller_user_id} AND buyer_user_id = {$buyer_user_id} AND is_complete = {$code_incomplete_cart}";

    //
    $result_set = StoreCart::read_by_query($query);

    //
    global $database;
    $num_of_rows = $database->get_num_rows_of_result_set($result_set);

    if ($num_of_rows > 0) {
        return true;
    } else {
        return false;
    }
}
?>




<!--Meat-->
<?php
if (isset($_POST["selected_cart_id"])) {
    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("Selected cart it changed.");

    //
    set_current_session_cart($_POST["selected_cart_id"], "");


    //
    redirect_to(LOCAL . "/public/__view/view_store_cart.php");
}


if (isset($_POST["update_cart_items"])) {
    // Call to controller_cart_item.php.
    update_cart_items();


    //
    redirect_to(LOCAL . "/public/__view/view_store_cart.php");
}
?>