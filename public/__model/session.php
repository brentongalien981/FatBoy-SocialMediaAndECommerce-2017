<?php

// A class to help work with Sessions
// In our case, primarily to manage logging users in and out
// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sessions
require_once("model_address.php");

class Session
{

//    public $my_static_counter;
    private $logged_in = false;
    public $actual_user_id;
    public $actual_user_name;
    public $actual_user_type_id;
    public $currently_viewed_user_id;
    public $currently_viewed_user_name;
    public $cart_id;
    public $user_id;
    public $seller_user_id;
    public $buyer_user_id;
    private $cart;

//    private $ship_to_address_obj;
// Vars for shipping.
    public $ship_to_address_id;
    public $ship_to_address_user_id;
    public $ship_to_address_address_type_code;
    public $ship_to_address_street1;
    public $ship_to_address_street2;
    public $ship_to_address_city;
    public $ship_to_address_state;
    public $ship_to_address_zip;
    public $ship_to_address_country_code;
    public $ship_to_address_phone;
    // Transaction vars.
    public $transaction_shipping_charge;
    public $transaction_subtotal;
    public $transaction_sales_tax;
    public $transaction_shipping_fee;
    public $transaction_total;
    public $paypal_transaction_id;
    //
    private $can_now_checkout;
    // Invoice.
    public $invoice_id;
    // Notifications.
    public $num_of_notifications;
    // Refund.
    public $refund_invoice_item_id;
    public $refund_item_quantity;
    // Ad
    public $tae;
    public $ad_name;
    public $ad_description;
    public $ad_photo_url_address;
    public $ad_target_num_airings;
    public $ad_budget;
    public $ad_air_time;
    public $ad_status_id;
    // Chat
    public $chat_thread_id;
//    public $chat_with_user_id;

//    public $message;

    function __construct()
    {
// TODO: How do I deal with this session_start()?
//        session_start();
//        $this->check_message();
        $this->check_login();
        if ($this->logged_in) {
// actions to take right away if user is logged in
        } else {
// actions to take right away if user is not logged in
        }
    }


    public function set_can_now_checkout($what)
    {
        $this->can_now_checkout = $_SESSION["can_now_checkout"] = $what;
    }

    public function set_invoice_id($new_invoice_id)
    {
        $this->invoice_id = $_SESSION["invoice_id"] = $new_invoice_id;
    }

    public function set_refund_invoice_item_id($id)
    {
        $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"] = $id;
    }


    public function set_transaction_subtotal($val)
    {
        $this->transaction_subtotal = $_SESSION["transaction_subtotal"] = $val;
    }


    public function set_transaction_sales_tax($val)
    {
        $this->transaction_sales_tax = $_SESSION["transaction_sales_tax"] = $val;
    }

    public function set_transaction_total($val)
    {
        $this->transaction_total = $_SESSION["transaction_total"] = $val;
    }


    public function set_transaction_shipping_fee($val)
    {
        $this->transaction_shipping_fee = $_SESSION["transaction_shipping_fee"] = $val;
    }


    public function set_refund_item_quantity($quantity)
    {
        $this->refund_item_quantity = $_SESSION["refund_item_quantity"] = $quantity;
    }

//    public function set_ad_vars($ad_obj) {
//        $this->ad_name = $_SESSION["ad_name"] = $ad_obj->ad_name;
//        $this->ad_description = $_SESSION["ad_description"] = $ad_obj->description;
//        $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"] = $ad_obj->photo_url_address;
//        $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"] = $ad_obj->target_num_airings;
//        $this->ad_budget = $_SESSION["ad_budget"] = $ad_obj->budget;
//        $this->ad_air_time = $_SESSION["ad_air_time"] = $ad_obj->air_time;
//        $this->ad_status_id = $_SESSION["ad_status_id"] = $ad_obj->status_id;       
//    }

    public function set_chat_thread_id($chat_thread_id)
    {
        $this->chat_thread_id = $_SESSION["chat_thread_id"] = $chat_thread_id;
    }

//    public function set_chat_with_user_id($chat_with_user_id) {
//        $this->chat_with_user_id = $_SESSION["chat_with_user_id"] = chat_with_user_id;
//    }

    public function set_ad_name($ad_name)
    {
        $this->ad_name = $_SESSION["ad_name"] = $ad_name;
    }

    public function set_ad_description($ad_description)
    {
        $this->ad_description = $_SESSION["ad_description"] = $ad_description;
    }

    public function set_ad_photo_url_address($ad_photo_url_address)
    {
        $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"] = $ad_photo_url_address;
    }

    public function set_ad_target_num_airings($ad_target_num_airings)
    {
        $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"] = $ad_target_num_airings;
    }

    public function set_ad_budget($ad_budget)
    {
        $this->ad_budget = $_SESSION["ad_budget"] = $ad_budget;
    }

    public function set_ad_air_time($ad_air_time)
    {
        $this->ad_air_time = $_SESSION["ad_air_time"] = $ad_air_time;
    }

    public function set_ad_status_id($ad_status_id)
    {
        $this->ad_status_id = $_SESSION["ad_status_id"] = $ad_status_id;
    }

    public function get_can_now_checkout()
    {
        return $this->can_now_checkout;
    }

    public static function get_my_static_counter()
    {
        return ++$_SESSION["my_static_counter"];

    }



//    public function set_cart($new_cart) {
//        if ($this->is_logged_in()) {
//            $this->cart_id = $_SESSION["cart_id"] = $new_cart->cart_id;
//            $this->seller_user_id = $_SESSION["seller_user_id"] = $new_cart->seller_user_id;
//            $this->buyer_user_id = $_SESSION["buyer_user_id"] = $new_cart->buyer_user_id;
//        }
//    }

    public function set_cart_id($cart_id)
    {
        $this->cart_id = $_SESSION["cart_id"] = $cart_id;
    }

    public function set_ship_to_address_id($id)
    {
        if ($this->is_logged_in()) {
            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = $id;
        }
    }

    public function set_ship_to_address_vars($address_obj)
    {
        if ($this->is_logged_in()) {
            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = $address_obj->id;
            $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"] = $address_obj->user_id;
            $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"] = $address_obj->address_type_code;
            $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"] = $address_obj->street1;
            $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"] = $address_obj->street2;
            $this->ship_to_address_city = $_SESSION["ship_to_address_city"] = $address_obj->city;
            $this->ship_to_address_state = $_SESSION["ship_to_address_state"] = $address_obj->state;
            $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"] = $address_obj->zip;
            $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"] = $address_obj->country_code;
            $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"] = $address_obj->phone;
        }
    }

    public function initialize_ship_to_address_vars()
    {
        if ($this->is_logged_in()) {
//            $a_ship_to_address_obj = (Address);
            // Default values.
            // user_id of user "UserForOneTimeAddresses123 is 14".
            $one_time_user_id = 14;
            $one_time_address_type_code = 3;

            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = null;
            $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"] = $one_time_user_id;
            $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"] = $one_time_address_type_code;
            $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"] = "";
            $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"] = "";
            $this->ship_to_address_city = $_SESSION["ship_to_address_city"] = "";
            $this->ship_to_address_state = $_SESSION["ship_to_address_state"] = "";
            $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"] = "";
            $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"] = "";
            $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"] = "";
        }
    }

//    public function get_ship_to_address_obj() {
//        if ($this->is_logged_in()) {
//            return $this->ship_to_address_obj;
//        }
//    }

    public function is_viewing_own_account()
    {
        if ($this->actual_user_id === $this->currently_viewed_user_id) {
            return true;
        } else {
            return false;
        }
    }


    public function is_admin()
    {
        if ($this->actual_user_type_id == 1) {
            return true;
        }
        return false;
    }


    public function is_logged_in()
    {
        return $this->logged_in;
    }

    public function login($user)
    {
// database should find user based on username/password

        session_regenerate_id();


        if ($user) {
            $_SESSION["my_static_counter"] = 0;

            $this->actual_user_id = $_SESSION["actual_user_id"] = $user->user_id;
            $this->actual_user_name = $_SESSION["actual_user_name"] = $user->user_name;
            $this->actual_user_type_id = $_SESSION["actual_user_type_id"] = $user->user_type_id;

            $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $user->user_id;
            $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $user->user_name;

            $this->logged_in = true;


//// Initialize cart.
//            require_once("model_store_cart.php");
//// This could be an initialized cart object without values in it.
//            $initial_cart_obj = StoreCart::get_initialized_cart($this->actual_user_id);
////             $this->cart_id = $_SESSION["cart_id"]
//            if ($initial_cart_obj != null) {
//                $this->set_cart($initial_cart_obj);
//            }


//            //
//            $this->initialize_ship_to_address_vars();

            //
            $this->can_now_checkout = $_SESSION["can_now_checkout"] = false;


            //
            $this->set_invoice_id(null);


            //
            $this->set_num_of_notifications(0);


            // Refund.
            $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"] = null;
            $this->refund_item_quantity = $_SESSION["refund_item_quantity"] = null;


            // Ad.
            $this->tae = $_SESSION["tae"] = null;
            $this->ad_name = $_SESSION["ad_name"] = null;
            $this->ad_description = $_SESSION["ad_description"] = null;
            $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"] = null;
            $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"] = null;
            $this->ad_budget = $_SESSION["ad_budget"] = null;
            $this->ad_air_time = $_SESSION["ad_air_time"] = null;
            $this->ad_status_id = $_SESSION["ad_status_id"] = null;

            // Chat
            $this->chat_thread_id = $_SESSION["chat_thread_id"] = null;
//            $this->chat_with_user_id = $_SESSION["chat_with_user_id"] = null;
        }
    }

    public function set_num_of_notifications($num_of_new_notifications)
    {
        $this->num_of_notifications = $_SESSION["num_of_notifications"] = $num_of_new_notifications;
    }

    public function logout()
    {
        unset($_SESSION["actual_user_id"]);
        unset($_SESSION["actual_user_name"]);
        unset($_SESSION["actual_user_type_id"]);

        unset($_SESSION["currently_viewed_user_id"]);
        unset($_SESSION["currently_viewed_user_name"]);

        unset($_SESSION["cart_id"]);
        unset($_SESSION["seller_user_id"]);
        unset($_SESSION["buyer_user_id"]);

        unset($_SESSION["can_now_checkout"]);

        // Shipping vars.
        unset($_SESSION["ship_to_address_id"]);
        unset($_SESSION["ship_to_address_user_id"]);
        unset($_SESSION["ship_to_address_address_type_code"]);
        unset($_SESSION["ship_to_address_street1"]);
        unset($_SESSION["ship_to_address_street2"]);
        unset($_SESSION["ship_to_address_city"]);
        unset($_SESSION["ship_to_address_state"]);
        unset($_SESSION["ship_to_address_zip"]);
        unset($_SESSION["ship_to_address_country_code"]);
        unset($_SESSION["ship_to_address_phone"]);

        // Transaction vars.
        unset($_SESSION["transaction_shipping_charge"]);
        unset($_SESSION["transaction_subtotal"]);
        unset($_SESSION["transaction_sales_tax"]);
        unset($_SESSION["transaction_shipping_fee"]);
        unset($_SESSION["transaction_total"]);

        unset($_SESSION["paypal_transaction_id"]);

        unset($_SESSION["invoice_id"]);

        // Refund.
        unset($_SESSION["refund_invoice_item_id"]);
        unset($_SESSION["refund_item_quantity"]);


        // Ad.
        unset($_SESSION["tae"]);
        unset($_SESSION["ad_name"]);
        unset($_SESSION["ad_description"]);
        unset($_SESSION["ad_photo_url_address"]);
        unset($_SESSION["ad_target_num_airings"]);
        unset($_SESSION["ad_budget"]);
        unset($_SESSION["ad_air_time"]);
        unset($_SESSION["ad_status_id"]);


        // Chat.           
        unset($_SESSION["chat_thread_id"]);
//        unset($_SESSION["chat_with_user_id"]);


        unset($this->actual_user_id);
        unset($this->actual_user_name);
        unset($this->actual_user_type_id);

        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);

        unset($this->cart_id);
        unset($this->seller_user_id);
        unset($this->buyer_user_id);
//
        unset($this->ship_to_address_obj);

        unset($this->can_now_checkout);

        // Shipping vars.
        unset($this->ship_to_address_id);
        unset($this->ship_to_address_user_id);
        unset($this->ship_to_address_address_type_code);
        unset($this->ship_to_address_street1);
        unset($this->ship_to_address_street2);
        unset($this->ship_to_address_city);
        unset($this->ship_to_address_state);
        unset($this->ship_to_address_zip);
        unset($this->ship_to_address_country_code);
        unset($this->ship_to_address_phone);


        unset($this->transaction_shipping_charge);
        unset($this->transaction_subtotal);
        unset($this->transaction_sales_tax);
        unset($this->transaction_shipping_fee);
        unset($this->transaction_total);

        unset($this->paypal_transaction_id);


        unset($this->invoice_id);


        // Refund.
        unset($this->refund_invoice_item_id);
        unset($this->refund_item_quantity);


        // Ad.
        unset($this->tae);
        unset($this->ad_name);
        unset($this->ad_description);
        unset($this->ad_photo_url_address);
        unset($this->ad_target_num_airings);
        unset($this->ad_budget);
        unset($this->ad_air_time);
        unset($this->ad_status_id);

        // Chat.           
        unset($this->chat_thread_id);
//        unset($this->chat_with_user_id);


        $this->logged_in = false;
        session_unset();
        session_destroy();
    }

//    public function message($msg = "") {
//        if (!empty($msg)) {
//            // then this is "set message"
//            // make sure you understand why $this->message=$msg wouldn't work
//            $_SESSION['message'] = $msg;
//        } else {
//            // then this is "get message"
//            return $this->message;
//        }
//    }
// This is basically called in the constructor
// to check everytime if there's been a logged in actual user.
// I do this because we use the method require("my_user.php")
// and everytime that happens, an instantiation happens at the end
// of this file. And with that, we create a new user object everytime.
// So we check.
    private function check_login()
    {
        if (isset($_SESSION["actual_user_id"])) {
            $this->actual_user_id = $_SESSION["actual_user_id"];
            $this->actual_user_name = $_SESSION["actual_user_name"];
            $this->actual_user_type_id = $_SESSION["actual_user_type_id"];

            $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"];
            $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"];


            if (isset($_SESSION["ship_to_address_id"])) {
                $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
            }

            $this->logged_in = true;

            if (isset($_SESSION["cart_id"])) {
                $this->cart_id = $_SESSION["cart_id"];
            }

            if (isset($_SESSION["seller_user_id"])) {
                $this->seller_user_id = $_SESSION["seller_user_id"];
            }

            if (isset($_SESSION["buyer_user_id"])) {
                $this->buyer_user_id = $_SESSION["buyer_user_id"];
            }

            // For shipping vars.
            if (isset($_SESSION["ship_to_address_idzZzZz"])) {
                $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
                $this->ship_to_address_user_id = $_SESSION["ship_to_address_user_id"];
                $this->ship_to_address_address_type_code = $_SESSION["ship_to_address_address_type_code"];
                $this->ship_to_address_street1 = $_SESSION["ship_to_address_street1"];
                $this->ship_to_address_street2 = $_SESSION["ship_to_address_street2"];
                $this->ship_to_address_city = $_SESSION["ship_to_address_city"];
                $this->ship_to_address_state = $_SESSION["ship_to_address_state"];
                $this->ship_to_address_zip = $_SESSION["ship_to_address_zip"];
                $this->ship_to_address_country_code = $_SESSION["ship_to_address_country_code"];
                $this->ship_to_address_phone = $_SESSION["ship_to_address_phone"];

                //
                $this->can_now_checkout = $_SESSION["can_now_checkout"];
            }


            // For transcation vars.
            if (isset($_SESSION["transaction_total"])) {
//                $this->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"];

                $this->set_transaction_subtotal($_SESSION["transaction_subtotal"]);
                $this->set_transaction_sales_tax($_SESSION["transaction_sales_tax"]);
                $this->set_transaction_shipping_fee($_SESSION["transaction_shipping_fee"]);
                $this->set_transaction_total($_SESSION["transaction_total"]);
            }





            if (isset($_SESSION["paypal_transaction_id"])) {
                $this->set_paypal_transaction_id($_SESSION["paypal_transaction_id"]);
            }


            // For invoice.
            if (isset($_SESSION["invoice_id"])) {
                $this->set_invoice_id($_SESSION["invoice_id"]);
            }


            // For notifications.
            if (isset($_SESSION["num_of_notifications"])) {
                $this->num_of_notifications = $_SESSION["num_of_notifications"];
            }


            // For refunds.
            if (isset($_SESSION["refund_invoice_item_id"])) {
                $this->refund_invoice_item_id = $_SESSION["refund_invoice_item_id"];
                $this->refund_item_quantity = $_SESSION["refund_item_quantity"];
            }


            // Ad.
            if (isset($_SESSION["ad_name"])) {
                $this->tae = $_SESSION["tae"];
                $this->ad_name = $_SESSION["ad_name"];
                $this->ad_description = $_SESSION["ad_description"];
                $this->ad_photo_url_address = $_SESSION["ad_photo_url_address"];
                $this->ad_target_num_airings = $_SESSION["ad_target_num_airings"];
                $this->ad_budget = $_SESSION["ad_budget"];
                $this->ad_air_time = $_SESSION["ad_air_time"];
                $this->ad_status_id = $_SESSION["ad_status_id"];
            }

            // Chat.
            if (isset($_SESSION["chat_thread_id"])) {
                $this->chat_thread_id = $_SESSION["chat_thread_id"];
//                $this->chat_with_user_id = $_SESSION["chat_with_user_id"];
            }
        } else {
            unset($this->actual_user_id);
            unset($this->actual_user_name);
            unset($this->actual_user_type_id);

            unset($this->currently_viewed_user_id);
            unset($this->currently_viewed_user_name);

            unset($this->cart_id);
            unset($this->seller_user_id);
            unset($this->buyer_user_id);

            // TODO: REMINDER: Don't forget to unset the shipping vars.
            // TODO: REMINDER: Don't forget to unset the transaction vars.
            // TODO: REMINDER: Don't forget to unset the $_SESSION["paypal_transaction_id"].
            unset($this->can_now_checkout);


            unset($this->num_of_notifications);

            // Ad
            unset($this->tae);

            unset($this->ad_name);
            unset($this->ad_description);
            unset($this->ad_photo_url_address);
            unset($this->ad_target_num_airings);
            unset($this->ad_budget);
            unset($this->ad_air_time);
            unset($this->ad_status_id);


            // Chat.           
            unset($this->chat_thread_id);
//            unset($this->chat_with_user_id);


            $this->logged_in = false;
        }
    }

    public function set_paypal_transaction_id($paypal_transaction_id) {
        $this->paypal_transaction_id = $_SESSION["paypal_transaction_id"] = $paypal_transaction_id;
    }


    public function set_currently_viewed_user($now_currently_viewed_user_id, $now_currently_viewed_user_name)
    {
        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $now_currently_viewed_user_id;
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $now_currently_viewed_user_name;
    }

    public function reset_currently_viewed_user()
    {
        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $_SESSION["actual_user_id"];
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $_SESSION["actual_user_name"];
    }

//    private function check_message() {
//        // Is there a message stored in the session?
//        if (isset($_SESSION['message'])) {
//            // Add it as an attribute and erase the stored version
//            $this->message = $_SESSION['message'];
//            unset($_SESSION['message']);
//        } else {
//            $this->message = "";
//        }
//    }
}

$session = new Session();
//$message = $session->message();
?>