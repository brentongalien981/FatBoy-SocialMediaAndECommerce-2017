<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php"); ?>

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
function generate_invoice() {
    //
    create_invoice_record();

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
    }
    else {
        MyDebugMessenger::add_debug_message("FAIL creation of InvoiceItemStatusRecord.");
    }
}

function create_invoice_record() {
    // Create Invoice record.
    global $session;
    $new_invoice = new Invoice();
    // TODO: Change this later to a value from the PayPal Invoice number.
    $an_id = md5(uniqid(rand(), true));
    $new_invoice->id = md5(uniqid(rand(), true));
    $new_invoice->seller_user_id = $session->seller_user_id;
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

//            // TODO: DEBUG:
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
?>