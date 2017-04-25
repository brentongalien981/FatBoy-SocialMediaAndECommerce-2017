<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_address.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function show_completely_presented_country_options() {
    $query = "SELECT * FROM Country ";
    $query .= "ORDER BY name";

    $results = Address::read_by_query($query);

    global $database;
    global $session;
    while ($row = $database->fetch_array($results)) {
        echo "<option value='{$row['code']}'";

        if ($session->ship_to_address_country_code == $row['code']) {
            echo "selected";
        }

        echo ">{$row['name']}</option>";
    }
}

// @return bool.
function validate_shipping_form() {
//    //
//    $shipping_address_being_validated = new Address();
//
//    // Default values.
//    // user_id of user "UserForOneTimeAddresses123 is 14".
//    $one_time_user_id = 14;
//    $one_time_address_type_code = 3;
//
//    $shipping_address_being_validated->id = null;
//    $shipping_address_being_validated->user_id = $one_time_user_id;
//    $shipping_address_being_validated->address_type_code = $one_time_address_type_code;
//    $shipping_address_being_validated->street1 = $_POST["street1"];
//    $shipping_address_being_validated->street2 = $_POST["street2"];
//    $shipping_address_being_validated->city = $_POST["city"];
//    $shipping_address_being_validated->state = $_POST["state"];
//    $shipping_address_being_validated->zip = $_POST["zip"];
//    $shipping_address_being_validated->country_code = $_POST["country_code"];
//    $shipping_address_being_validated->phone = $_POST["phone"];



    // Fuckin need this everytime you validate.
    MyValidationErrorLogger::initialize();


    // Validations
    $required_fields = array("street1", "city", "state", "zip");
    validate_presences($required_fields);


    $fields_with_max_lengths = array("street1" => 500, "street2" => 500, "city" => 100, "state" => 50, "zip" => 10, "country_code" => 2);
    validate_max_lengths($fields_with_max_lengths);
    
    
    
    
    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS shipping info validation.");

        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL shipping info validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }


        // 
        return false;
    }    
}

// Helper Methods.
?>











<!--Meat-->
<?php
// TODO: DONE: $_POST["set_shipping"].
if (isset($_POST["set_shipping"])) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON set_shipping clicked.");


    //
    $a_ship_to_address_obj = new Address();

    // Default values.
    // user_id of user "UserForOneTimeAddresses123 is 14".
    $one_time_user_id = 14;
    $one_time_address_type_code = 3;


    $a_ship_to_address_obj->id = null;
    $a_ship_to_address_obj->user_id = $one_time_user_id;
    $a_ship_to_address_obj->address_type_code = $one_time_address_type_code;
    $a_ship_to_address_obj->street1 = $_POST["street1"];
    $a_ship_to_address_obj->street2 = $_POST["street2"];
    $a_ship_to_address_obj->city = $_POST["city"];
    $a_ship_to_address_obj->state = $_POST["state"];
    $a_ship_to_address_obj->zip = $_POST["zip"];
    $a_ship_to_address_obj->country_code = $_POST["country_code"];
    $a_ship_to_address_obj->phone = "";
    
    
    //
    $is_validation_ok = validate_shipping_form();
    
    global $session;
    if ($is_validation_ok) {
        $session->set_can_now_checkout(true);
    }
    else {
        $session->set_can_now_checkout(false);
    }
    

    //
    $session->set_ship_to_address_vars($a_ship_to_address_obj);

//    echo "<pre>";
//    print_r($_POST);
//    print_r($a_ship_to_address_obj);
//    echo "</pre>";
    //
    redirect_to(LOCAL . "/public/__view/view_shipping.php");
}




?>