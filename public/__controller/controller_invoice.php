<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_my_store_items.php"); ?>

<?php require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php

// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<?php

// TODO: SECTION: Functions.
function generate_invoice($paypal_invoice_id) {
    //
    create_invoice_record($paypal_invoice_id);

    // Create InvoiceItem record.
    create_invoice_item_record();


    // Loop through all the Invoice Items with the current InvoiceId.
    global $session;
    $query = "SELECT * FROM InvoiceItem ";
    $query .= "WHERE invoice_id = '{$session->invoice_id}'";

    $record_results = InvoiceItem::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_results)) {
//        MyDebugMessenger::add_debug_message("InvoiceItem.id: {$row['id']}");
        //
        $invoice_item_id = $row['id'];
        // Status Code for "payment being processed".
        $invoice_item_status_id = 1;


        // Create InvoiceItemStatusRecord.
        create_invoice_item_status_record($invoice_item_id, $invoice_item_status_id);
    }
}

function on_successful_payment_result($paypal_invoice_id) {
    generate_invoice($paypal_invoice_id);

    // Update the quantities of the store items sold.
    if (update_stock_quantity()) {
        // Set cart to complete.
        finalize_cart();
    }
}

function finalize_cart() {
// Update and set the used cart to complete
    global $session;
    $query_for_cart_completion = "UPDATE StoreCart SET is_complete = 1 ";
    $query_for_cart_completion .= "WHERE cart_id = {$session->cart_id}";

    $result_for_cart_completion = MyStoreItems::update_by_query($query_for_cart_completion);
    
    
    MyDebugMessenger::add_debug_message("Inside METHOD: finalize_cart().");
    MyDebugMessenger::add_debug_message("VAR:\$query: {$query_for_cart_completion}");
    return;    
}

function update_stock_quantity() {
    global $session;
    global $database;
    $selected_cart_id = $session->cart_id;

    $query = "SELECT CartItems.cart_id, item_id, name, price, CartItems.quantity AS 'quantity', MyStoreItems.quantity AS 'in_stock' ";
    $query .= "FROM CartItems ";
    $query .= "INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "WHERE cart_id = {$selected_cart_id} ";
    $query .= "AND CartItems.quantity > 0";

    $results = MyStoreItems::read_by_query($query);

//    MyDebugMessenger::add_debug_message("In METHOD: update_stock_quantity(), ");
//    MyDebugMessenger::add_debug_message("VAR:\$query: {$query}");
//    return true;
    // Loop throught all the items.
    while ($row = $database->fetch_array($results)) {
        $current_item_id = $row["item_id"];

        $updated_quantity = $row["in_stock"] - $row["quantity"];

        // Update query
        $query_for_item_quantity_update = "UPDATE MyStoreItems SET quantity = {$updated_quantity} ";
        $query_for_item_quantity_update .= "WHERE id = $current_item_id";

        $is_update_ok = MyStoreItems::update_by_query($query_for_item_quantity_update);

        // TODO: LOG: If query is successful..
        MyDebugMessenger::add_debug_message("In METHOD: update_stock_quantity(), ");
        MyDebugMessenger::add_debug_message("VAR:\$is_update_ok: {$is_update_ok} for ");
        MyDebugMessenger::add_debug_message("VAR:\$current_item_id: {$current_item_id}.");

        if (!$is_update_ok) {
            return $is_update_ok;
        }
    }

    return true;
}

function show_shopping_history_table_header() {
    echo "<table id='shopping_history_table'>";
    echo "<thead>";
    echo "<td id='td_header'>";
    echo "InvoiceItems";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "InvoiceId";
    echo "</td>";

//    echo "<td id='td_header'>";
//    echo "ItemName";
//    echo "</td>";

    echo "<td id='td_header'>";
    echo "Seller";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "Ship-from Address";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "Ship-to Address";
    echo "</td>";
    echo "</thead>";
}

function show_sales_history_table_header() {
    echo "<table id='sales_history_table'>";
    echo "<thead>";
    echo "<td id='td_header'>";
    echo "InvoiceItems";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "InvoiceId";
    echo "</td>";

//    echo "<td id='td_header'>";
//    echo "ItemName";
//    echo "</td>";

    echo "<td id='td_header'>";
    echo "Buyer";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "Ship-from Address";
    echo "</td>";

    echo "<td id='td_header'>";
    echo "Ship-to Address";
    echo "</td>";
    echo "</thead>";
}

function close_shopping_history_table_element() {
    echo "</table>";
}

function close_sales_history_table_element() {
    echo "</table>";
}

function show_sales_history() {
//    echo "METHOD: show_sales_history().";
    //
    echo "<div id='container_sales_history'>";
    show_sales_history_table_header();

    //
    show_sales_history_items();

    //
    close_sales_history_table_element();
    echo "</div>";
}

function show_shopping_history() {
    //
    echo "<div id='container_shopping_history'>";
    show_shopping_history_table_header();

    //
    show_shopping_history_items();

    //
    close_shopping_history_table_element();
    echo "</div>";
}

function get_all_user_shopping_invoices() {
    global $session;
    // TODO: REMINDER: Complete the shopping history address details.
    $query = "SELECT Invoice.id, Invoice.seller_user_id, Invoice.buyer_user_id, ";
    $query .= "Invoice.ship_from_address_id, Invoice.ship_to_address_id, Users.user_name, ";
    $query .= "s.street1 AS seller_street1, b.street1 AS buyer_street1 ";
    $query .= "FROM Invoice ";
    $query .= "INNER JOIN Users ON Invoice.seller_user_id = Users.user_id ";
    $query .= "INNER JOIN Address s ON Invoice.ship_from_address_id = s.id ";
    $query .= "INNER JOIN Address b ON Invoice.ship_to_address_id = b.id ";
    $query .= "WHERE buyer_user_id = {$session->actual_user_id}";
    // TODO: REMINDER: Also, order the query by date by joining it with an invoice item for the date OF PURCHASE.

    $record_results = Invoice::read_by_query($query);
    return $record_results;
}

function get_all_user_sales_invoices() {
    global $session;
    // TODO: REMINDER: Complete the sales history address details.
    $query = "SELECT Invoice.id, Invoice.seller_user_id, Invoice.buyer_user_id, ";
    $query .= "Invoice.ship_from_address_id, Invoice.ship_to_address_id, Users.user_name, ";
    $query .= "s.street1 AS seller_street1, b.street1 AS buyer_street1 ";
    $query .= "FROM Invoice ";
    $query .= "INNER JOIN Users ON Invoice.buyer_user_id = Users.user_id ";
    $query .= "INNER JOIN Address s ON Invoice.ship_from_address_id = s.id ";
    $query .= "INNER JOIN Address b ON Invoice.ship_to_address_id = b.id ";
    $query .= "WHERE Invoice.seller_user_id = {$session->actual_user_id}";
    // TODO: REMINDER: Also, order the query by date by joining it with an invoice item for the date OF PURCHASE.

    $record_results = Invoice::read_by_query($query);
    return $record_results;
}

function show_sales_history_items() {
    //
    $record_results = get_all_user_sales_invoices();

    //
    global $database;

    while ($row = $database->fetch_array($record_results)) {
        echo "<tr class='sales_history_details' id='tr_{$row['id']}'>";

        echo "<td>";
        echo "<button id='{$row['id']}' class='button_show_details form_button' onclick='show_details(this)'>show</button>";
        echo "</td>";

        echo "<td>";
        echo "{$row['id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['user_name']}";
        echo "</td>";

//        echo "<td>";
//        echo "{$row['buyer_user_id']}";
//        echo "</td>";

        echo "<td>";
        echo "{$row['seller_street1']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['buyer_street1']}";
        echo "</td>";

        echo "</tr>";
    }
}

function show_shopping_history_items() {
    //
    $record_results = get_all_user_shopping_invoices();

    //
    global $database;

    while ($row = $database->fetch_array($record_results)) {
        echo "<tr class='shopping_history_details' id='tr_{$row['id']}'>";

        echo "<td>";
        echo "<button id='{$row['id']}' class='button_show_details form_button' onclick='show_details(this)'>show</button>";
        echo "</td>";

        echo "<td>";
        echo "{$row['id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['user_name']}";
        echo "</td>";

//        echo "<td>";
//        echo "{$row['buyer_user_id']}";
//        echo "</td>";

        echo "<td>";
        echo "{$row['seller_street1']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['buyer_street1']}";
        echo "</td>";

        echo "</tr>";
    }
//    echo "<tr id='tr_puta'>";
//    echo "<td colspan='5'>";
//    echo "ok ok ok";
//    echo "</td>";
//    echo "</tr>";
}

// @return bool.
function create_invoice_item_status_record($invoice_item_id, $invoice_item_status_id) {
//    $new_invoice_item_status_record_obj = new InvoiceItemStatusRecord();
//    $new_invoice_item_status_record_obj->id = null;
//    $new_invoice_item_status_record_obj->invoice_item_id = $invoice_item_id;
//    $new_invoice_item_status_record_obj->invoice_item_status_id = $invoice_item_status_id;
//    $now = date("Y-m-d H:i:s");
//    $new_invoice_item_status_record_obj->status_start_date = $now;
//    $is_creation_ok = $new_invoice_item_status_record_obj->create_with_bool();

    $query = "INSERT INTO InvoiceItemStatusRecord (invoice_item_id, invoice_item_status_id) ";
    $query .= "VALUES ({$invoice_item_id}, {$invoice_item_status_id})";

    $is_creation_ok = InvoiceItemStatusRecord::create_by_query($query);

    MyDebugMessenger::add_debug_message("DEBUG: QUERY: {$query}.");


    if ($is_creation_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS creation of InvoiceItemStatusRecord.");
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL creation of InvoiceItemStatusRecord.");
        return false;
    }
}

function create_invoice_record($paypal_invoice_id) {
    // Create Invoice record.
    global $session;
    $new_invoice = new Invoice();
    // TODO:DONE: Change this later to a value from the PayPal Invoice number.
//    $an_id = md5(uniqid(rand(), true));
    $new_invoice->id = $paypal_invoice_id;
    $new_invoice->seller_user_id = $session->seller_user_id;

    // Set the invoice ship-from address.
    $new_invoice->ship_from_address_id = get_seller_ship_from_address_obj()->id;

    $new_invoice->buyer_user_id = $session->actual_user_id;

    // For the ship-to-address.
    $ship_to_address_obj = get_buyer_ship_to_address_obj();

    // Some more details for the ship-to-address.
    $one_time_user_id = 14;
    $one_time_address_type_code = 3;

    $ship_to_address_obj->user_id = $one_time_user_id;
    $ship_to_address_obj->address_type_code = $one_time_address_type_code;

    $is_creation_ok = $ship_to_address_obj->create_with_bool();

    if ($is_creation_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS Address-to-record creation.");

        // After obj creation, model class gives an id to it.
        $new_invoice->ship_to_address_id = $ship_to_address_obj->id;

        // Invoice db creation is here.
        $is_creation_ok = $new_invoice->create_with_bool();

        if ($is_creation_ok) {
            MyDebugMessenger::add_debug_message("SUCCESS Invoice record creation.");
        } else {
            MyDebugMessenger::add_debug_message("FAILURE Invoice record creation.");
        }
    } else {
        MyDebugMessenger::add_debug_message("FAILURE Address-to-record creation.");
    }


    // Set session invoice id.
    $session->set_invoice_id($new_invoice->id);
}

function create_invoice_item_record() {
    global $session;

    // Loop through all the cart items.
// Query to display all the items in the cart selected from that store.
    global $session;

    $query = "SELECT item_id, price, CartItems.quantity ";
    $query .= "FROM CartItems INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "WHERE CartItems.cart_id = {$session->cart_id} ";
    $query .= "AND CartItems.quantity > 0";

    //
    $record_results = Invoice::read_by_query($query);

    //
    global $database;
    while ($row = $database->fetch_array($record_results)) {
        // Create a new item record.
        $new_invoice_item_obj = new InvoiceItem();
        $new_invoice_item_obj->id = null;
        $new_invoice_item_obj->invoice_id = $session->invoice_id;
        $new_invoice_item_obj->store_item_id = $row['item_id'];
        $new_invoice_item_obj->price_per_item = $row['price'];
        $new_invoice_item_obj->quantity = $row['quantity'];

        $is_creation_ok = $new_invoice_item_obj->create_with_bool();

        if ($is_creation_ok) {
            MyDebugMessenger::add_debug_message("SUCCESS creation of 1 InvoiceItem:");

//            // TODO: LOG:
//            MyDebugMessenger::add_debug_message("id: {$new_invoice_item_obj->id}");
//            MyDebugMessenger::add_debug_message("invoice_id: {$new_invoice_item_obj->invoice_id}");
//            MyDebugMessenger::add_debug_message("store_item_id: {$new_invoice_item_obj->store_item_id}");
//            MyDebugMessenger::add_debug_message("price_per_item: {$new_invoice_item_obj->price_per_item}");
//            MyDebugMessenger::add_debug_message("quantity: {$new_invoice_item_obj->quantity}");
        } else {
            MyDebugMessenger::add_debug_message("FAIL creation of 1 InvoiceItem.");
        }
    }
}
?>











<?php

// TODO: SECTION: Meat.
if (isset($_POST["do_refund"])) {
    require_once(PUBLIC_PATH . "/__controller/controller_my_refund.php");

    prepare_refund_item($_POST["invoice_item_id"]);
}
?>