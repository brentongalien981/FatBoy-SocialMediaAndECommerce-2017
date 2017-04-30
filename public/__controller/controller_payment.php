<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_paypal_account.php"); ?>


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
?>











<?php

// TODO: SECTION: For app debug messenger initialization.
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<?php

// TODO: SECTION: Meat.
//
// # Create Payment using PayPal as payment method
// This sample code demonstrates how you can process a 
// PayPal Account based Payment.
// API used: /v1/payments/payment
require __DIR__ . '/paypal_seller_authentication.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

// Vars.
$can_now_be_authenticated = false;
$can_now_pay = false;


// This is if the paypal transaction is validated by having
// the seller's paypal authenticated and the buyer's paypal account authenticated.
// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET["payment_validation_success"])) {
    if ($_GET["payment_validation_success"] == 1) {
        $can_now_pay = true;
        
        //
        global $session;
        $session->paypal_transaction_id = $_SESSION["paypal_transaction_id"] = $_GET["token"];
    } else {
        // The payment validation failed.
        redirect_to(LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3&payment_validation_success=0");
    }
}




//
if ($can_now_pay) {
    // TODO: DEBUG
//    die("THIS IS JUST FOR DEBUG: can_now_pay is true.");


    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $api);
    // ### Payment Execute
    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);



    try {
        // Execute the payment
        // (See bootstrap.php for more on `ApiContext`)
        $result = $payment->execute($execution, $api);

        
        
        // TODO: REMINDER: This method "getTransactions()" will return an array in AJAX form
        // that contains the transaction invoice number. You will need that as a PK for creating 
        // a record in table Transaction (or maybe Invoice).
//        $paypal_transactions = $result->getTransactions();



        try {
            $payment = Payment::get($paymentId, $api);
        } catch (Exception $ex) {
            MyDebugMessenger::add_debug_message("Error on page: controller_payment.php, line: 141");
            MyDebugMessenger::add_debug_message("exception is: {$ex}");
//            redirect_to(LOCAL . "");

            redirect_to(LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3&payment_result=0");
//            header('Location: final_payment_failed.php');
        }
    } catch (Exception $ex) {
//        header('Location: final_payment_failed.php');
        MyDebugMessenger::add_debug_message("Error on page: controller_payment.php, line: 150");
        MyDebugMessenger::add_debug_message("exception is: {$ex}");
//            redirect_to(LOCAL . "");

        redirect_to(LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3&payment_result=0");
    }
    
    
    // Successful payment result.
    // Create an Invoice/Transaction record to db.
    require_once(PUBLIC_PATH . "/__controller/controller_my_shopping_history.php");
    
    create_invoice_record();
    
    
    redirect_to(LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3&payment_result=1");
}









// This part is to enable the site to reach paypal
// and let paypal validate the seller's and the buyer's paypal accounts.
// NOTE: that the code won't reach this part if a user just accessed this page
//       through the url or if it's a call back from paypal after both the seller's
//       and the buyer's paypal accounts have been validated.
if (isset($_POST["pay"])) {
    $can_now_be_authenticated = true;
} else {
    // If the user just accessed this page through the url.
    redirect_to(LOCAL . "public/__view/view_transaction");
}





if ($can_now_be_authenticated) {
// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");



    $items_array = array();

// Query to display all the items in the cart selected from that store.
    $query = "SELECT buyer_user_id, CartItems.cart_id, item_id, name, price, CartItems.quantity AS 'quantity', MyStoreItems.quantity AS 'in_stock' ";
    $query .= "FROM CartItems INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "INNER JOIN StoreCart ON CartItems.cart_id = StoreCart.cart_id ";
    $query .= "WHERE CartItems.cart_id = {$session->cart_id} ";
    $query .= "AND is_complete = 0 ";
    $query .= "AND CartItems.quantity > 0 ";
    $query .= "AND buyer_user_id = {$session->actual_user_id}";


    $results = Address::read_by_query($query);



// ### Itemized information
// (Optional) Lets you specify item wise
// information
    while ($row = mysqli_fetch_assoc($results)) {
        $current_item = new Item();
        $current_item->setName($row["name"])
                ->setCurrency('USD')
                ->setQuantity($row["quantity"])
                ->setSku($row["item_id"]) // Similar to `item_number` in Classic API
                ->setPrice($row["price"]);

        // 
        array_push($items_array, $current_item);
    }

//
    $itemList = new ItemList();
    $itemList->setItems($items_array);





// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
    $details = new Details();
    $details->setShipping($session->transaction_shipping_fee)
            ->setTax($session->transaction_sales_tax)
            ->setSubtotal($session->transaction_subtotal);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
    $amount = new Amount();
    $amount->setCurrency("USD")
            ->setTotal($session->transaction_total)
            ->setDetails($details);





// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
    $transaction = new Transaction();
    $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());





// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
//$baseUrl = getBaseUrl();
//$base_url = LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3";
    $base_url = LOCAL . "/public/__controller/controller_payment.php";
    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl("{$base_url}?payment_validation_success=1")
            ->setCancelUrl("{$base_url}?payment_validation_success=0");





// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));





    try {
        $payment->create($api);
    } catch (Exception $ex) {
//    header('Location: error_payment.php');
        redirect_to(LOCAL . "/public/__view/view_transaction/index.php?transaction_content_page=3&payment_preparation=0");
    }

    $approval_url = $payment->getApprovalLink();
    redirect_to($approval_url);
//header('Location: ' . $approvalUrl);
//payment_error    
}
?>