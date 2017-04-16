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
    
    public function is_viewing_own_account() {
        if ($actual_user_id == $currently_viewed_user_id) {
            return true;
        }
        else {
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
        }
    }

    public function logout() {
        unset($_SESSION["actual_user_id"]);
        unset($_SESSION["actual_user_name"]);
        
        unset($_SESSION["currently_viewed_user_id"]);
        unset($_SESSION["currently_viewed_user_name"]);        
        
        unset($this->actual_user_id);
        unset($this->actual_user_name);
        
        unset($this->currently_viewed_user_id);
        unset($this->currently_viewed_user_name);        
        
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
        
            $this->actual_user_id = $_SESSION["currently_viewed_user_id"];
            $this->actual_user_name = $_SESSION["currently_viewed_user_name"];
            
            $this->logged_in = true;
        } else {
            unset($this->actual_user_id);
            unset($this->actual_user_name);
            
            unset($this->currently_viewed_user_id);
            unset($this->currently_viewed_user_name);             
            
            $this->logged_in = false;
        }
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