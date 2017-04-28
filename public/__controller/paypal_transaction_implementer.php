<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php confirm_logged_in(); ?>

<?php
// Make sure that the actual user is viewing her own account,
// so she won't see someone's cart.
if (!($_SESSION["actual_username"] == $_SESSION["username"])) {
    redirect_to("my_cart.php");
}
?>



<?php
$_SESSION["message"] = "";
?>


<?php

echo "can_now_pay.php bruh...";




// #Execute Payment Sample
// This is the second step required to complete
// PayPal checkout. Once user completes the payment, paypal
// redirects the browser to "redirectUrl" provided in the request.
// This sample will show you how to execute the payment
// that has been approved by
// the buyer by logging into paypal site.
// You can optionally update transaction
// information by passing in one or more transactions.
// API used: POST '/v1/payments/payment/<payment-id>/execute'.
require __DIR__ . '/seller_paypal_authentication.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET['success']) && $_GET['success'] == 'true') {
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
    
//    // ### Optional Changes to Amount
//    // If you wish to update the amount that you wish to charge the customer,
//    // based on the shipping address or any other reason, you could
//    // do that by passing the transaction object with just `amount` field in it.
//    // Here is the example on how we changed the shipping to $1 more than before.
//    $transaction = new Transaction();
//    $amount = new Amount();
//    $details = new Details();
//    $details->setShipping(2.2)
//        ->setTax(1.3)
//        ->setSubtotal(17.50);
//    $amount->setCurrency('USD');
//    $amount->setTotal(21);
//    $amount->setDetails($details);
//    $transaction->setAmount($amount);
    
//    // Add the above transaction object inside our Execution object.
//    $execution->addTransaction($transaction);
    
    
    
    
    
    
    
    
    try {
        // Execute the payment
        // (See bootstrap.php for more on `ApiContext`)
        $result = $payment->execute($execution, $api);
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//        ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
//        var_dump($result);
        try {
            $payment = Payment::get($paymentId, $api);
        } catch (Exception $ex) {
            header('Location: final_payment_failed.php');
        }
    } catch (Exception $ex) {
        header('Location: final_payment_failed.php');
    }
//    return $payment;
    echo "Super FINAL PAYMENT SUCCESS BRUH!!!";
    $_SESSION["message"] .= "Final payment succeeded bruh..";
    redirect_to("final_payment_success.php");
} else {
    exit;
}
?>


