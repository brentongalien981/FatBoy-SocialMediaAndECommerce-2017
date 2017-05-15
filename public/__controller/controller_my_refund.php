<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_sales_notification.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php");      ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php");      ?>

<?php require_once(PUBLIC_PATH . "/__controller/controller_invoice.php"); ?>

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


    // Redirect and show the details of the refund.
    // Here the refunder can choose the quantity, but only limited
    // to a maximum of the quantity of that particular item she bought.
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

function create_refund_record($refund_invoice_item_id, $refund_item_quantity) {
    $query = "INSERT INTO RefundItem ";
    $query .= "VALUES (NULL, {$refund_invoice_item_id}, {$refund_item_quantity})";
//    $query .= "VALUES (NULL, 699)";

    $is_creation_ok = Invoice::create_by_query($query);

    return $is_creation_ok;
}

function show_my_refund_items() {
    echo "<table>";
    echo "<thead>";

    echo "<tr>";

    echo "<td>";
    echo "Invoice<br>Item<br>Id";
    echo "</td>";

    echo "<td>";
    echo "Invoice Id";
    echo "</td>";

    echo "<td>";
    echo "Seller";
    echo "</td>";

    echo "<td>";
    echo "Item Name";
    echo "</td>";

    echo "<td>";
    echo "Refund<br>Quantity";
    echo "</td>";

    echo "<td>";
    echo "Price per Item<br>in USD";
    echo "</td>";

    echo "<td>";
    echo "Seller Address";
    echo "</td>";

    echo "<td>";
    echo "Status";
    echo "</td>";

    echo "</tr>";

    echo "</thead>";



    //
    global $session;

    $query = "SELECT i.id AS invoice_id, ";
    $query .= "ri.quantity AS refund_quantity, ";
    $query .= "msi.name AS item_name, ";
    $query .= "ii.id, ii.price_per_item, ii.quantity AS bought_quantity, ";
    $query .= "u2.user_name AS seller_user_name, ";
    $query .= "a.street1 AS seller_address, ";
    $query .= "iisr.invoice_item_status_id, ";
    $query .= "iis.name AS status_name ";
    $query .= "FROM RefundItem ri ";
    $query .= "INNER JOIN InvoiceItem ii ON ri.invoice_item_id = ii.id ";
    $query .= "INNER JOIN Invoice i ON ii.invoice_id = i.id ";
    $query .= "INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id ";
    $query .= "INNER JOIN Users u ON i.buyer_user_id = u.user_id ";
    $query .= "INNER JOIN Users u2 ON i.seller_user_id = u2.user_id ";
    $query .= "INNER JOIN Address a ON i.ship_from_address_id = a.id ";
    $query .= "INNER JOIN ";
    $query .= "(";
    $query .= "SELECT * FROM InvoiceItemStatusRecord ";
    $query .= "WHERE (invoice_item_id, status_start_date) IN";
    $query .= "(";
    $query .= "SELECT invoice_item_id, MAX(status_start_date) ";
    $query .= "FROM InvoiceItemStatusRecord ";
    $query .= "GROUP BY invoice_item_id ";
    $query .= ")";
    $query .= ") iisr ON ii.id = iisr.invoice_item_id ";
    $query .= "INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id ";
    $query .= "WHERE u.user_id = 10";


    //
    $record_result = Invoice::read_by_query($query);

    global $database;


    while ($row = $database->fetch_array($record_result)) {
        echo "<tr>";

        echo "<td>";
        echo "{$row['id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['invoice_id']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['seller_user_name']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['item_name']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['refund_quantity']} pcs";
        echo "</td>";

        echo "<td>";
        echo "\${$row['price_per_item']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['seller_address']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['status_name']}";
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}

function get_refund_vars_array() {
    //
    global $session;
    if (isset($session->refund_invoice_item_id)) {
        //
//        $query = "SELECT ri.id AS refund_id, ri.invoice_item_id, ri.quantity AS refund_quantity, ";
        $query = "SELECT i.id AS invoice_id, ";
        $query .= "msi.name AS item_name, ";
        $query .= "ii.price_per_item, ii.quantity AS bought_quantity, ";
        $query .= "u.user_name AS seller_user_name, ";
        $query .= "a.street1 AS seller_address, ";
        $query .= "iisr.invoice_item_status_id, ";
        $query .= "iis.name AS status_name ";
//        $query .= "FROM RefundItem ri ";
        $query .= "FROM InvoiceItem ii ";
//        $query .= "INNER JOIN InvoiceItem ii ON ri.invoice_item_id = ii.id ";
        $query .= "INNER JOIN Invoice i ON ii.invoice_id = i.id ";
        $query .= "INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id ";
        $query .= "INNER JOIN Users u ON i.seller_user_id = u.user_id ";
        $query .= "INNER JOIN Address a ON i.ship_from_address_id = a.id ";
        $query .= "INNER JOIN InvoiceItemStatusRecord iisr ON ii.id = iisr.invoice_item_id ";
        $query .= "INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id ";
//        $query .= "WHERE ri.invoice_item_id = {$session->refund_invoice_item_id} ";
        $query .= "WHERE ii.id = {$session->refund_invoice_item_id} ";
        $query .= "AND iisr.status_start_date = (SELECT MAX(iisr_b.status_start_date) FROM InvoiceItemStatusRecord iisr_b WHERE iisr_b.invoice_item_id = {$session->refund_invoice_item_id})";

        //
        $record_result = Invoice::read_by_query($query);


        //
        $refund_vars_array = array();

        global $database;

        while ($row = $database->fetch_array($record_result)) {
            $refund_vars_array["item_name"] = $row["item_name"];
            $refund_vars_array["invoice_id"] = $row["invoice_id"];
            $refund_vars_array["seller_user_name"] = $row["seller_user_name"];
            $refund_vars_array["seller_address"] = $row["seller_address"];
            $refund_vars_array['price_per_item'] = $row["price_per_item"];
            $refund_vars_array['bought_quantity'] = $row["bought_quantity"];

            break;
        }


        //
        return $refund_vars_array;
    } else {
        MyDebugMessenger::add_debug_message("The invoice item id is not set for refund.");
        return;
    }
}
?>











<?php

// TODO: SECTION: Meat.
if (isset($_POST["apply_for_refund"])) {
    //
    $query = "START TRANSACTION";

    $can_start_transaction = Invoice::read_by_query($query);

    //
    if (!$can_start_transaction) {
        MyDebugMessenger::add_debug_message("Error starting the transaction.");
        redirect_to(LOCAL . "/public/__view/view_refund/index.php?transaction_content_page=2");
    }
    
    //
    if ($_POST["refund_item_quantity"] > $_POST["bought_quantity"]) {
        MyDebugMessenger::add_debug_message("refund_item_quantity can't be greater than bought_quantity bruh..");
        redirect_to(LOCAL . "/public/__view/view_refund/index.php?transaction_content_page=2");        
    }    

    
    
    

    // Here, $can_start_transaction is true.
    // Flag vars.
    global $database;
    global $session;

    $is_refund_record_creation_ok = false;
    $is_invoice_item_status_record_creation_ok = false;
    $is_sales_notification_creation_ok = false;





    // TODO: REMINDER: Now check if the refund item quantity from the past of that particular invoice item id plus
    // the refund quantity of this refund item is less than or equal to the bought quantity of
    // that invoice item id.     

    
    
    
    
    // Update the status of the invoice item.
    // invoice_item_status_code for "being applied for refund" is 6.
    $invoice_item_status_id = 6;
    $is_invoice_item_status_record_creation_ok = create_invoice_item_status_record($session->refund_invoice_item_id, $invoice_item_status_id);
    
    
    
    

    // TODO: REMINDER: Create a table for RefundNotification because with what I did here,
    // storing a refund notification record to table SalesNotification produces a wierd notification
    // message for the user. Change this later...
    // TODO: Create a SalesNotification record for the refund to notify the seller.
    // But to do that, query first the necessary attributes.
    $query = "SELECT ii.id AS invoice_item_id, i.buyer_user_id, i.seller_user_id ";
    $query .= "FROM InvoiceItem ii ";
    $query .= "INNER JOIN Invoice i ON ii.invoice_id = i.id ";
    $query .= "WHERE ii.id = {$session->refund_invoice_item_id} LIMIT 1";

    $record_result = Invoice::read_by_query($query);

    $a_sales_notification_obj = new SalesNotification();

    while ($row = $database->fetch_array($record_result)) {
        // Set the attributes for the new obj.
        $a_sales_notification_obj->id = null;
        $a_sales_notification_obj->notified_user_id = $row['seller_user_id'];
        $a_sales_notification_obj->notifier_user_id = $row['buyer_user_id']; // Can also be $session->actual_user_id.
        $a_sales_notification_obj->invoice_item_id = $row['invoice_item_id'];
        // TODO: REMINDER: Maybe put this value to table "NotificationTypes".
        $code_for_sales_status_update = 4;
        $a_sales_notification_obj->notification_type = $code_for_sales_status_update;
        $a_sales_notification_obj->is_active = 1;
    }

    // Now create the obj.
    $is_sales_notification_creation_ok = $a_sales_notification_obj->create_with_bool();
    

    
    
    
    // Create RefundItem record.
    $is_refund_record_creation_ok = create_refund_record($session->refund_invoice_item_id, $_POST["refund_item_quantity"]);    
      
    
    
    
   
    // If everything is ok...
    if ($is_invoice_item_status_record_creation_ok &&
        $is_sales_notification_creation_ok &&
        $is_refund_record_creation_ok) 
    {
        //
        $query = "COMMIT";

        $has_commit = Invoice::read_by_query($query);       
        
        if ($has_commit) {
            // Reset the value.
            $session->set_refund_invoice_item_id(null);
            
            //
            MyDebugMessenger::add_debug_message("SUCCESS Refund is ok.");
        }
        else {
            //
            $query = "ROLLBACK";

            Invoice::read_by_query($query);    
            
            //
            MyDebugMessenger::add_debug_message("FAIL Refund.");            
        }
    }
    else {
        //
        $query = "ROLLBACK";

        Invoice::read_by_query($query);    
        
        //
        MyDebugMessenger::add_debug_message("FAIL Refund.");                    
    }





    //
    redirect_to(LOCAL . "/public/__view/view_refund/index.php?transaction_content_page=2");
}
?>