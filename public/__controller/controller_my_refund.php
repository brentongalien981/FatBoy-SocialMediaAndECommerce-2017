<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

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
function prepare_refund_item($invoice_item_id) { 
    //
    prepare_refund_session_vars($invoice_item_id);
    
    
    //
    redirect_to(LOCAL . "/public/__view/view_refund/index.php?transaction_content_page=2");
    
    
//    //
//    if (create_refund_record($invoice_item_id)) {
//        redirect_to(LOCAL . "/public/__view/view_refund");
//    }
//    else {
//        
//        redirect_to(LOCAL . "/public/__view/view_store_cart/index.php?store_content_page=2");
//    }
}

function prepare_refund_session_vars($invoice_item_id) {
    //
    global $session;
    
    $session->set_refund_invoice_item_id($invoice_item_id);
    
    $default_refund_item_quantity = 1;
    $session->set_refund_item_quantity($default_refund_item_quantity);
}

function create_refund_record($invoice_item_id) {
    $query = "INSERT INTO RefundItem ";
    $query .= "VALUES (NULL, {$invoice_item_id})";
//    $query .= "VALUES (NULL, 699)";
    
    $is_creation_ok = Invoice::create_by_query($query);
    
    return $is_creation_ok;
}

function show_my_refund_items() {
    echo "<br>Method show_my_refund_items() called.<br>";
}

function get_refund_vars_array() {
    //
    if (isset($session->refund_invoice_item_id)) {
        //
        $query = "";
        
        /*
         SELECT ri.id AS refund_id, ri.invoice_item_id, ri.quantity AS refund_quantity,
i.id AS invoice_id,
msi.name,
ii.price_per_item, ii.quantity AS bought_quantity,
u.user_name AS seller_user_name,
a.street1 AS seller_address,
iisr.invoice_item_status_id,
iis.name
	FROM RefundItem ri
    INNER JOIN InvoiceItem ii ON ri.invoice_item_id = ii.id
    INNER JOIN Invoice i ON ii.invoice_id = i.id
    INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id
    INNER JOIN Users u ON i.seller_user_id = u.user_id
    INNER JOIN Address a ON i.ship_from_address_id = a.id
    INNER JOIN InvoiceItemStatusRecord iisr ON ii.id = iisr.invoice_item_id
    INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id
    	WHERE ri.invoice_item_id = 44
        AND iisr.status_start_date = (SELECT MAX(iisrb.status_start_date) FROM InvoiceItemStatusRecord iisrb WHERE iisrb.invoice_item_id = 44)
         */
        
        
        //
        $refund_vars_array = array();
        
        global $database;
        
        while ($row = $database->fetch_array()) {
            
        }
    }
    else {
        MyDebugMessenger::add_debug_message("The invoice item id is not set for refund.");
        return;
    }
}
?>











<?php

// TODO: SECTION: Meat.
if (isset($_POST["apply_for_refund"])) {
    echo "clicked Apply for refund";
}
?>