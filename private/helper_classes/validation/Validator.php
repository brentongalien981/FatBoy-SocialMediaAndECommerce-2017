<?php

namespace App\Privado\HelperClasses\Validation;

class Validator {

    private $allowed_post_vars_array = null;
    private $json_errors_array = null;

//    function __construct() {
//        
//    }

    public function set_allowed_post_vars($allowed_post_vars_array) {
        $this->allowed_post_vars_array = $allowed_post_vars_array;

        $this->set_json_errors_array();
//        return "RETURN: From class:Validator, method:set_allowed_post_vars().";
    }
    
    private function set_json_errors_array() {
        $this->json_errors_array = array();
        
        foreach ($this->allowed_post_vars_array as $allowed_post_var) {
            $this->json_errors_array["error_" . $allowed_post_var] = "";
        }
    }
    
    public function get_json_errors_array() {
        return $this->json_errors_array;
    }

}
?>
