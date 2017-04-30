<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice.php"); ?>

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



    // Create InvoiceItem record.
    // Create InvoiceItemStatusRecord.
}
?>











<?php

// TODO: SECTION: Meat.
?>