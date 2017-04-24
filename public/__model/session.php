<?php

// A class to help work with Sessions
// In our case, primarily to manage logging users in and out
// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

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
    public $ship_to_address_id;
    public $ship_to_address_obj;

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

    public function set_cart($new_cart) {
        if ($this->is_logged_in()) {
            $this->cart_id = $_SESSION["cart_id"] = $new_cart->cart_id;
            $this->seller_user_id = $_SESSION["seller_user_id"] = $new_cart->seller_user_id;
            $this->buyer_user_id = $_SESSION["buyer_user_id"] = $new_cart->buyer_user_id;
        }
    }

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


            // Initialize cart.
            require_once("model_store_cart.php");
            // This could be an initialized cart object without values in it.
            $initial_cart_obj = StoreCart::get_initialized_cart($this->actual_user_id);
//             $this->cart_id = $_SESSION["cart_id"]
            $this->set_cart($initial_cart_obj);

            //
            $this->ship_to_address_id = $_SESSION["ship_to_address_id"] = null;
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

        unset($_SESSION["ship_to_address_id"]);



        unset($this->actual_user_id);
        unset($this->actual_user_name);

        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);

        unset($this->cart_id);
        unset($this->seller_user_id);
        unset($this->buyer_user_id);

        unset($this->ship_to_address_id);

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

            $this->ship_to_address_id = $_SESSION["ship_to_address_id"];
        } else {
            unset($this->actual_user_id);
            unset($this->actual_user_name);

            unset($this->currently_viewed_user_id);
            unset($this->currently_viewed_user_name);

            unset($this->cart_id);
            unset($this->seller_user_id);
            unset($this->buyer_user_id);

            unset($this->ship_to_address_id);

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