<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-18
 * Time: 23:43
 */

namespace App\Publico\Controller\PaypalPayment;

require_once("../MainController.php");
require(PRIVATE_PATH . "/external_api/PayPal-PHP-SDK/autoload.php");

require_once(PUBLIC_PATH . "/__model/UserPayPalAccount.php");
//require_once(PUBLIC_PATH . "/__model/ShippingOption.php");
//require_once(PUBLIC_PATH . "/__model/Address.php");
require_once(PUBLIC_PATH . "/__model/StoreCart.php");
require_once(PUBLIC_PATH . "/__model/CartItem.php");


use App\Publico\Controller\MainController;

use App\Publico\Model\UserPayPalAccount;
//use App\Publico\Model\ShippingOption;
use App\Publico\Model\StoreCart;
//use App\Publico\Model\Address;
use App\Publico\Model\CartItem;


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;


class PaypalPaymentController extends MainController
{
    private $paypal_api;

    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        $this->set_paypal_api();

        // TODO
        $this->prepare_payment_details($data);

    }

    private function set_paypal_api() {
        /**/
        global $session;
        $cart_id = $session->cart_id;

        /* Get the seller_user_id in StoreCart model. */
        $cart = StoreCart::read_by_id($cart_id);
        $data["seller_user_id"] = $cart["seller_user_id"];


        $pp = new UserPayPalAccount();
        $paypal_accounts = $pp->read($data);
        $paypal_account = $paypal_accounts[0];


        // API
        $this->paypal_api = new ApiContext(
            new OAuthTokenCredential($paypal_account["paypal_client_id"], $paypal_account["paypal_secret_id"])
        );


        // TODO: REMINDER: Change the mode on production.
        $this->paypal_api->setConfig([
            'mode' => 'sandbox',
            'http.ConnectionTimeout' => 30,
            'log.LogEnabled' => false,
            'log.FileName' => '',
            'log.LogLevel' => 'FINE',
            'validation.level' => 'log'
        ]);
    }

    private function prepare_payment_details($data)
    {

        //
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");


        $cart_items = CartItem::read(null);
        $items_array = array();
        $transaction_subtotal = 0;
        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        foreach ($cart_items as $ci) {
            $current_item = new Item();
            $current_item->setName($ci["product_name"])
                ->setCurrency('USD')
                ->setQuantity($ci["quantity"])
                ->setSku($ci["store_item_id"])// Similar to `item_number` in Classic API
                ->setPrice($ci["product_price"]);

            //
            array_push($items_array, $current_item);


            //
            $transaction_subtotal += $ci["quantity"] * $ci["product_price"];
        }


        //
        $itemList = new ItemList();
        $itemList->setItems($items_array);


        // Calculate the payment transaction detials.
        global $session;
        $session->set_transaction_subtotal($transaction_subtotal);
        $session->set_transaction_sales_tax($transaction_subtotal * 0.13);
        $session->set_transaction_shipping_fee((float) $data["shipping_fee"]);

        $transaction_total = $session->transaction_subtotal + $session->transaction_sales_tax + $session->transaction_shipping_fee;
        $session->set_transaction_total($transaction_total);


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
        $base_url = LOCAL . "/public/__controller/paypal_payment/PayPalPaymentController.php";
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl("{$base_url}?payment_preparation_result=1")
            ->setCancelUrl("{$base_url}?payment_preparation_result=0");




        // ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));





        try {
            $payment->create($this->paypal_api);
        } catch (Exception $ex) {
            return null;
        }

        $approval_url = $payment->getApprovalLink();
        redirect_to($approval_url);
    }

    public function receive_payment_preparation_result() {
        if ($_GET["payment_preparation_result"] == 1) {
//                $json_errors_array["is_result_ok"] = true;
//                $json_errors_array["paypal_payment_preparation_result_msg"] = "SUCCESS preparing your payment.";
            $this->set_paypal_api();
            $this->pay_now();
        }
        else {
//                $json_errors_array["is_result_ok"] = false;
//                $json_errors_array["paypal_payment_preparation_result_msg"] = "FAILURE: You cancelled preparing your payment.";
            $paypal_payment_preparation_result_msg = "FAILURE: You cancelled preparing your payment.";
            redirect_to(LOCAL . "/public/__view/paypal_payment/payment_preparation_result.php?paypal_payment_preparation_result_msg={$paypal_payment_preparation_result_msg}");
        }
    }

    private function pay_now() {

        //
        // Get the payment Object by passing paymentId
        // payment id was previously stored in session in
        // CreatePaymentUsingPayPal.php
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $this->paypal_api);
        // ### Payment Execute
        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);



        //
        $paypal_invoice_id = null;



        try {
            // Execute the payment
            // (See bootstrap.php for more on `ApiContext`)
            $result = $payment->execute($execution, $this->paypal_api);



            // TODO: REMINDER: This method "getTransactions()" will return an array in AJAX form
            // that contains the transaction invoice number. You will need that as a PK for creating
            // a record in table Transaction (or maybe Invoice).
            $paypal_transactions = $result->getTransactions();

            $decoded_paypal_transactions = json_decode($paypal_transactions[0]);
            $paypal_invoice_id = $decoded_paypal_transactions->{'invoice_number'};



            try {
                $payment = Payment::get($paymentId, $this->paypal_api);
            } catch (Exception $ex) {
                $paypal_payment_preparation_result_msg = "Error on getting your payment result details.";
                redirect_to(LOCAL . "/public/__view/paypal_payment/payment_preparation_result.php?paypal_payment_preparation_result_msg={$paypal_payment_preparation_result_msg}");

            }
        } catch (Exception $ex) {
            $paypal_payment_preparation_result_msg = "Error on executing you payment.";
            redirect_to(LOCAL . "/public/__view/paypal_payment/payment_preparation_result.php?paypal_payment_preparation_result_msg={$paypal_payment_preparation_result_msg}");
        }


//    // Move this part to the controller.
//    // Successful payment result.
//    // Create an Invoice/Transaction record to db.
//    require_once(PUBLIC_PATH . "/__controller/controller_my_shopping_history.php");
//
//    generate_invoice();


        global $session;
        $session->set_invoice_id($paypal_invoice_id);

        $paypal_payment_result_msg = "SUCCESS on your payment.";
        $successful_payment_result_url = "/public/__controller/paypal_payment/PaypalPaymentResult.php?paypal_payment_result_msg={$paypal_payment_result_msg}";
        $successful_payment_result_url .= "&paypal_payment_result=1";
        redirect_to(LOCAL . $successful_payment_result_url);
    }

}



if (isset($_GET["payment_preparation_result"])) {
    $pp_controller = new PaypalPaymentController();
    $pp_controller->receive_payment_preparation_result();
}
?>