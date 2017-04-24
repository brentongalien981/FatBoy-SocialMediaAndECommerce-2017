<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_cart_item.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

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
function update_cart_items() {
    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("Button update_cart_items clicked.");


    //
    global $session;
    $query = "SELECT CartItems.cart_id, item_id, name, price, CartItems.quantity AS 'quantity', MyStoreItems.quantity AS 'in_stock' ";
    $query .= "FROM CartItems ";
    $query .= "INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "WHERE cart_id = {$session->cart_id}";

    //
    $result_sets = CartItem::read_by_query($query);

    //
    global $database;
    while ($row = $database->fetch_array($result_sets)) {
        // Update the quantity of the current item.
        // Vars
        $current_item_id = $row["item_id"];


        // Check if there has been any update at all.
        if (isset($_GET[$current_item_id])) {
            $updated_quantity = $_GET[$current_item_id];

            // Check if the updated quantity is <= to the stock quantity.
            // I check here cause buyer can just manipulate the url for the GET request.
            // If the buyer actually manipulated the url, just set the quantity equal to the stock number.
            if ($updated_quantity > $row["in_stock"]) {
                $updated_quantity = $row["in_stock"];
            } else if ($updated_quantity < 0) {
                $updated_quantity = 0;
            }

            // Update query
            $query_for_item_quantity_update = "UPDATE CartItems SET quantity= {$updated_quantity} ";
            $query_for_item_quantity_update .= "WHERE item_id = {$current_item_id}";

            $is_update_ok = CartItem::update_by_query($query_for_item_quantity_update);

            // TODO: LOG: If query is successful..
            if ($is_update_ok) {
                MyDebugMessenger::add_debug_message("SUCCESS VAR is_update_ok {$is_update_ok} for item: {$row['name']}.");
            } else {
                MyDebugMessenger::add_debug_message("FAIL VAR is_update_ok {$is_update_ok} for item: {$row['name']}.");
            }
        } else {
            // Meaning there's no update on that particular item's quantity,
            // so just move on to the next item that has an updated quantity.
            break;
        }
    }
}

// Helper
function add_item_to_cart_bruh($cart_id, $item_id) {
    $new_cart_item = new CartItem();
    $new_cart_item->id = null;
    $new_cart_item->cart_id = $cart_id;
    $new_cart_item->item_id = $item_id;
    $new_cart_item->quantity = 1;

    $is_creation_ok = $new_cart_item->create_with_bool();

    return $is_creation_ok;
}

function is_item_already_on_cart_bruh($cart_id, $item_id) {
    //
    $query = "SELECT * FROM CartItems WHERE (cart_id = {$cart_id} AND item_id = {$item_id})";

    //
    $result_set = CartItem::read_by_query($query);

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
<?php ?>