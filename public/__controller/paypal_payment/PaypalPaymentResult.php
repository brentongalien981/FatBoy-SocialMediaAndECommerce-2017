<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-20
 * Time: 14:53
 */

namespace App\Publico\Controller\PaypalPayment;

require_once("../MainController.php");

require_once(PUBLIC_PATH . "/__model/Invoice.php");
require_once(PUBLIC_PATH . "/__model/InvoiceItem.php");
require_once(PUBLIC_PATH . "/__model/InvoiceItemStatusRecord.php");
require_once(PUBLIC_PATH . "/__model/StoreCart.php");
require_once(PUBLIC_PATH . "/__model/CartItem.php");
require_once(PUBLIC_PATH . "/__model/StoreItem.php");
require_once(PUBLIC_PATH . "/__model/Address.php");
//require_once(PUBLIC_PATH . "/__model/ShippingOption.php");



use App\Publico\Controller\MainController;
use App\Publico\Model\CartItem;
use App\Publico\Model\Invoice;
use App\Publico\Model\InvoiceItem;
use App\Publico\Model\InvoiceItemStatusRecord;
use App\Publico\Model\StoreCart;
use App\Publico\Model\StoreItem;
use App\Publico\Model\Address;


class PaypalPaymentResult extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    private static function create_invoice_item_records() {
        global $session;

        $cart_items = CartItem::read_items_by_cart_id($session->cart_id);

        foreach ($cart_items as $cart_item) {

            //
            $store_item = StoreItem::read_by_id($cart_item->item_id);

            //
            $new_invoice_item_obj = new InvoiceItem();
            $new_invoice_item_obj->id = null;
            $new_invoice_item_obj->invoice_id = $session->invoice_id;
            $new_invoice_item_obj->store_item_id = $cart_item->item_id;
            $new_invoice_item_obj->price_per_item = $store_item->price;
            $new_invoice_item_obj->quantity = $cart_item->quantity;

            $is_creation_ok = $new_invoice_item_obj->create();

            if (!$is_creation_ok) { return false; }
        }

        return true;
    }

    public static function do_successful_payment_result_finalizations() {

        $is_creation_ok = self::create_invoice_record();

        if ($is_creation_ok) {
            echo "SUCCESS on creating invoice record.";
            $is_creation_ok = self::create_invoice_item_records();
        }


        if ($is_creation_ok) {
            echo "<br>";
            echo "SUCCESS on creating invoice item records.";
            $is_creation_ok = self::create_invoice_item_status_record();
        }

        $is_update_ok = false;
        if ($is_creation_ok) {
            echo "<br>";
            echo "SUCCESS on creating invoice item status records.";
            $is_update_ok = self::update_item_stock_quantities();
        }


        if ($is_update_ok) {
            echo "<br>";
            echo "SUCCESS on updating item stock quantities.";
            $is_update_ok = StoreCart::finalize_cart();
        }


        if ($is_update_ok) {
            echo "<br>";
            echo "SUCCESS on finalizing store cart.";
        }

        // If $is_creation_ok is false, then
    }

    private static function update_item_stock_quantities() {
        $invoice_items = InvoiceItem::read_by_sessions_invoice_id();

        foreach ($invoice_items as $invoice_item) {
            $store_item = StoreItem::read_by_id($invoice_item->store_item_id);
            $new_stock_quantity = $store_item->quantity - $invoice_item->quantity;
            $is_update_ok = StoreItem::update_item_stock_quantity($store_item->id, $new_stock_quantity);

            if (!$is_update_ok) { return false; }
        }

        return true;
    }

    private static function create_invoice_item_status_record() {

        // Status Code for "payment being processed".
        $invoice_item_status_id = 1;

        //
        $invoice_items = InvoiceItem::read_by_sessions_invoice_id();

        foreach ($invoice_items as $invoice_item) {
            $new_invoice_item_status_record = new InvoiceItemStatusRecord();
            $new_invoice_item_status_record->invoice_item_id = $invoice_item->id;
            $new_invoice_item_status_record->invoice_item_status_id = $invoice_item_status_id;
            $is_creation_ok = $new_invoice_item_status_record->create();

            if (!$is_creation_ok) { return false; }
        }

        return true;
    }

    public static function create_invoice_record() {
        global $session;
        $required_invoice_details = self::get_required_invoice_details();

        $new_invoice = new Invoice();
        $new_invoice->id = $session->invoice_id;
        $new_invoice->seller_user_id = $required_invoice_details["seller_user_id"];
        $new_invoice->buyer_user_id = $session->actual_user_id;

        $ship_from_address_details = Address::read_by_user_id($new_invoice->seller_user_id);
        $new_invoice->ship_from_address_id = $ship_from_address_details["address_id"];
        $new_invoice->ship_to_address_id = $session->ship_to_address_id;
        return $new_invoice->create();
    }



    private static function get_required_invoice_details() {

        $required_invoice_details = array();


        $required_invoice_details["seller_user_id"] = StoreCart::get_seller_user_id();

        return $required_invoice_details;
    }
}


if (isset($_GET["paypal_payment_result"]) && ($_GET["paypal_payment_result"]) == "1") {

    PaypalPaymentResult::do_successful_payment_result_finalizations();
//    echo $_GET["paypal_payment_result_msg"];
}