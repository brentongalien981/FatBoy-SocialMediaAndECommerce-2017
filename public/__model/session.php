<?php

// A class to help work with Sessions
// In our case, primarily to manage logging users in and out
// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions
require_once("model_address.php");

class Session {

    private $logged_in = false;
    public $actual_user_id;
    public $actual_user_name;
    public $currently_viewed_user_id;
    public $currently_viewed_user_name;
    public $cart_id;
    public $user_id;
    public $buyer_user_id;
    private $cart;
//    public $ship_to_address_id;
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
    
    //
    private $can_now_checkout;

//    public $message;

    function __construct() {
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

//    public function get_cart() {
//        if ($this->is_logged_in()) {
//            if (isset($this->cart)) {
//                require_once("model_store_cart.php");
//                $session_cart = new StoreCart();
//                
//                $session_cart->cart_id = $this->
//                
//                return $this->cart;
//            } else {
//                die("No current cart is available.");
//            }
//        }
//    }
    
    public function set_can_now_checkout($what) {
        $this->can_now_checkout = $_SESSION["can_now_checkout"] = $what;
    }
    
    public function get_can_now_checkout() {
        return $this->can_now_checkout;
    }    

    public function set_cart($new_cart) {
        if ($this->is_logged_in()) {
            $this->cart_id = $_SESSION["cart_id"] = $new_cart->cart_id;
            $this->seller_user_id = $_SESSION["seller_user_id"] = $new_cart->seller_user_id;
            $this->buyer_user_id = $_SESSION["buyer_user_id"] = $new_cart->buyer_user_id;
        }
    }

    public function set_ship_to_address_vars($address_obj) {
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

    public function initialize_ship_to_address_vars() {
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


//            //
////            require_once("model_address.php");
//            $this->ship_to_address_obj = new Address();
//
//
////            $this->ship_to_address_obj->id = $_SESSION["ship_to_address_id"] = isset($a_ship_to_address_obj->id) ? $a_ship_to_address_obj->id : $_SESSION["ship_to_address_id"];
////            $this->ship_to_address_obj->user_id = $_SESSION["ship_to_address_user_id"] = isset($a_ship_to_address_obj->user_id) ? $a_ship_to_address_obj->user_id : $_SESSION["ship_to_address_user_id"];
////            $this->ship_to_address_obj->address_type_code = $_SESSION["ship_to_address_address_type_code"] = isset($a_ship_to_address_obj->address_type_code) ? $a_ship_to_address_obj->address_type_code : $_SESSION["ship_to_address_address_type_code"];
////            $this->ship_to_address_obj->street1 = $_SESSION["ship_to_address_street1"] = isset($a_ship_to_address_obj->street1) ? $a_ship_to_address_obj->street1 : $_SESSION["ship_to_address_street1"];
////            $this->ship_to_address_obj->street2 = $_SESSION["ship_to_address_street2"] = isset($a_ship_to_address_obj->street2) ? $a_ship_to_address_obj->street2 : $_SESSION["ship_to_address_street2"];
////            $this->ship_to_address_obj->city = $_SESSION["ship_to_address_city"] = isset($a_ship_to_address_obj->city) ? $a_ship_to_address_obj->city : $_SESSION["ship_to_address_city"];
////            $this->ship_to_address_obj->state = $_SESSION["ship_to_address_state"] = isset($a_ship_to_address_obj->state) ? $a_ship_to_address_obj->state : $_SESSION["ship_to_address_state"];
////            $this->ship_to_address_obj->zip = $_SESSION["ship_to_address_zip"] = isset($a_ship_to_address_obj->zip) ? $a_ship_to_address_obj->zip : $_SESSION["ship_to_address_zip"];
////            $this->ship_to_address_obj->country_code = $_SESSION["ship_to_address_country_code"] = isset($a_ship_to_address_obj->country_code) ? $a_ship_to_address_obj->country_code : $_SESSION["ship_to_address_country_code"];
////            $this->ship_to_address_obj->phone = $_SESSION["ship_to_address_phone"] = isset($a_ship_to_address_obj->phone) ? $a_ship_to_address_obj->phone : $_SESSION["ship_to_address_phone"];
//            
//            $this->ship_to_address_obj->id = $_SESSION["ship_to_address_id"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->id : $_SESSION["ship_to_address_id"];
//            $this->ship_to_address_obj->user_id = $_SESSION["ship_to_address_user_id"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->user_id : $_SESSION["ship_to_address_user_id"];
//            $this->ship_to_address_obj->address_type_code = $_SESSION["ship_to_address_address_type_code"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->address_type_code : $_SESSION["ship_to_address_address_type_code"];
//            $this->ship_to_address_obj->street1 = $_SESSION["ship_to_address_street1"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->street1 : $_SESSION["ship_to_address_street1"];
//            $this->ship_to_address_obj->street2 = $_SESSION["ship_to_address_street2"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->street2 : $_SESSION["ship_to_address_street2"];
//            $this->ship_to_address_obj->city = $_SESSION["ship_to_address_city"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->city : $_SESSION["ship_to_address_city"];
//            $this->ship_to_address_obj->state = $_SESSION["ship_to_address_state"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->state : $_SESSION["ship_to_address_state"];
//            $this->ship_to_address_obj->zip = $_SESSION["ship_to_address_zip"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->zip : $_SESSION["ship_to_address_zip"];
//            $this->ship_to_address_obj->country_code = $_SESSION["ship_to_address_country_code"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->country_code : $_SESSION["ship_to_address_country_code"];
//            $this->ship_to_address_obj->phone = $_SESSION["ship_to_address_phone"] = isset($a_ship_to_address_obj) ? $a_ship_to_address_obj->phone : $_SESSION["ship_to_address_phone"];            
//            
//            
//            // TODO: DEBUG
//            MyDebugMessenger::add_debug_message("INSIDE METHOD set_ship_to_address_obj.");
//            MyDebugMessenger::add_debug_message("{");
////            MyDebugMessenger::add_debug_message("a_ship_to_address_obj: {$a_ship_to_address_obj->to_string()}");
//            MyDebugMessenger::add_debug_message("this->ship_to_address_obj: {$this->ship_to_address_obj->to_string()}");
//            MyDebugMessenger::add_debug_message("}");
//            
//            echo "<pre>";
//            print_r($_SESSION);
//            echo "</pre>";
        }
    }

//    public function get_ship_to_address_obj() {
//        if ($this->is_logged_in()) {
//            return $this->ship_to_address_obj;
//        }
//    }

    public function is_viewing_own_account() {
        if ($this->actual_user_id === $this->currently_viewed_user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($user) {
// database should find user based on username/password

        session_regenerate_id();


        if ($user) {
            $this->actual_user_id = $_SESSION["actual_user_id"] = $user->user_id;
            $this->actual_user_name = $_SESSION["actual_user_name"] = $user->user_name;

            $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $user->user_id;
            $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $user->user_name;

            $this->logged_in = true;

            $this->initialize_ship_to_address_vars();


// Initialize cart.
            require_once("model_store_cart.php");
// This could be an initialized cart object without values in it.
            $initial_cart_obj = StoreCart::get_initialized_cart($this->actual_user_id);
//             $this->cart_id = $_SESSION["cart_id"]
            $this->set_cart($initial_cart_obj);

            //
            $this->can_now_checkout = $_SESSION["can_now_checkout"] = false;
        }
    }

    public function logout() {
        unset($_SESSION["actual_user_id"]);
        unset($_SESSION["actual_user_name"]);

        unset($_SESSION["currently_viewed_user_id"]);
        unset($_SESSION["currently_viewed_user_name"]);

        unset($_SESSION["cart_id"]);
        unset($_SESSION["seller_user_id"]);
        unset($_SESSION["buyer_user_id"]);
        
        unset($_SESSION["can_now_checkout"]);



        unset($this->actual_user_id);
        unset($this->actual_user_name);

        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);

        unset($this->cart_id);
        unset($this->seller_user_id);
        unset($this->buyer_user_id);
//
        unset($this->ship_to_address_obj);
        
        unset($this->can_now_checkout);

        // TODO: Don't forget to unset the shipping vars and shipping SESSION vars.


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
    private function check_login() {
        if (isset($_SESSION["actual_user_id"])) {
            $this->actual_user_id = $_SESSION["actual_user_id"];
            $this->actual_user_name = $_SESSION["actual_user_name"];

            $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"];
            $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"];

//        $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = null;

            $this->logged_in = true;

            $this->cart_id = $_SESSION["cart_id"];
            $this->seller_user_id = $_SESSION["seller_user_id"];
            $this->buyer_user_id = $_SESSION["buyer_user_id"];
//            
//            $this->cart = $_SESSION["cart"];
//            $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
//
            // For shipping vars.
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
            

        } else {
            unset($this->actual_user_id);
            unset($this->actual_user_name);

            unset($this->currently_viewed_user_id);
            unset($this->currently_viewed_user_name);

            unset($this->cart_id);
            unset($this->seller_user_id);
            unset($this->buyer_user_id);
            
            // TODO: Don't forget to unset the shipping vars.
            
            
            //
            unset($this->can_now_checkout);
            

            $this->logged_in = false;
        }
    }

    public function set_currently_viewed_user($now_currently_viewed_user_id, $now_currently_viewed_user_name) {
        $this->currently_viewed_user_id = $_SESSION["currently_viewed_user_id"] = $now_currently_viewed_user_id;
        $this->currently_viewed_user_name = $_SESSION["currently_viewed_user_name"] = $now_currently_viewed_user_name;
    }

    public function reset_currently_viewed_user() {
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