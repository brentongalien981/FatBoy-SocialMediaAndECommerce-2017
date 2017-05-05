<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>
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
    }
    else {
        return false;
    }
}
?>












<?php
// TODO: SECTION: Meat.
//
if (isset($_POST['selected_status_id']) && isset($_POST['invoice_item_id'])) {
    $update_status_id = $_POST['selected_status_id'];
    $invoice_item_id = $_POST['invoice_item_id'];
    
    //
    if (does_status_for_invoice_item_exist($update_status_id, $invoice_item_id)) {
        // Then no need to to anyting.
    }    
    else {
//        echo "OK: Status can be updated.";
        // Then create a new status record.
        // This is a method from file "controller_invoice.php".
        create_invoice_item_status_record($invoice_item_id, $update_status_id);
    }
}
?>