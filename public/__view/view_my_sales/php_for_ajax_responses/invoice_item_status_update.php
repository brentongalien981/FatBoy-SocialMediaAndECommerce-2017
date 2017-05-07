<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_sales_notification.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_invoice.php"); ?>












<?php

// TODO: SECTION: Functions.
function does_status_for_invoice_item_exist($update_status_id, $invoice_item_id) {
    $query = "SELECT * FROM InvoiceItemStatusRecord ";
    $query .= "WHERE invoice_item_id = {$invoice_item_id} ";
    $query .= "AND invoice_item_status_id = {$update_status_id}";

    $record_result = Invoice::read_by_query($query);

    global $database;
    $num_of_record_result = $database->get_num_rows_of_result_set($record_result);

    if ($num_of_record_result > 0) {
        return true;
    } else {
        return false;
    }
}

// Find the invoice id where this invoice item that is being status-updated is in.
function get_invoice_id_for_invoice_item($invoice_item_id) {
    $query = "SELECT invoice_id FROM InvoiceItem ";
    $query .= "WHERE id = {$invoice_item_id} LIMIT 1";

    $record_result = Invoice::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        return $row['invoice_id'];
    }
}
?>












<?php

// TODO: SECTION: Meat.
//
if (isset($_POST['selected_status_id']) &&
        isset($_POST['invoice_item_id'])) {

    $update_status_id = $_POST['selected_status_id'];
    $invoice_item_id = $_POST['invoice_item_id'];

    // TODO: NOTE: For some reason, js doesn't work for this code snippet:
    // ...onchange='update({$row['invoice_id']}, {$row['id']})'..
    // The js code reads all the arguments, but the $row[invoice_id],
    // for some fuckin stupid reason, it doesn't read it.
//    $invoice_id = $_POST['invoice_id'];
    //
    if (does_status_for_invoice_item_exist($update_status_id, $invoice_item_id)) {
        // Then no need to to anyting.
    } else {
//        echo "OK: Status can be updated.";
        // Then create a new status record.
        // This is a method from file "controller_invoice.php".
        $is_creation_ok = create_invoice_item_status_record($invoice_item_id, $update_status_id);


        if ($is_creation_ok) {
            // Create a record in table SalesNotification.
            // But first, figure out the values for the the attributes
            // of the new obj of type SalesNotification.


            //
            $invoice_id = get_invoice_id_for_invoice_item($invoice_item_id);


            // Set the $a_sales_notification_obj's attributes by
            // querying the table Invoice with the invoice_id.
            // Remember that these values are equivalent:
            // notified_user_id/buyer,
            // notifier_user_id/seller/actual_user, and
            // invoice_id.
            $query = "SELECT * FROM Invoice ";
            $query .= "WHERE id = '{$invoice_id}' LIMIT 1";

            $record_result = Invoice::read_by_query($query);

            global $database;
            $a_sales_notification_obj = new SalesNotification();

            while ($row = $database->fetch_array($record_result)) {
                // Set the attributes for the new obj.
                $a_sales_notification_obj->id = null;
                $a_sales_notification_obj->notified_user_id = $row['buyer_user_id'];
                $a_sales_notification_obj->notifier_user_id = $row['seller_user_id']; // Can also be $session->actual_user_id.
                $a_sales_notification_obj->invoice_item_id = $invoice_item_id;
                // TODO: REMINDER: Maybe put this value to table "NotificationTypes".
                $code_for_sales_status_update = 4;
                $a_sales_notification_obj->notification_type = $code_for_sales_status_update;
                $a_sales_notification_obj->is_active = 1;
            }
            
            
            // Now create the obj.
            $is_creation_ok = $a_sales_notification_obj->create_with_bool();
            
            






//            // TODO: DEBUG
//            global $session;
            echo "Fucker=> VAR is_creation_ok = {$is_creation_ok}";
        }
    }
}
?>