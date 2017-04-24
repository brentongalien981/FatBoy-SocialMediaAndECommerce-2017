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

        if ($session->ship_to_address_address_type_code == $row['code']) {
            echo "selected";
        }

        echo ">{$row['name']}</option>";
    }
}

// Helper Methods.
// Initialized the session var obj.
//function initialize_ship_to_address_obj() {
//    //
//    $one_time_ship_to_address_obj = new Address();
//
//    // Default values.
//    // user_id of user "UserForOneTimeAddresses123".
//    $one_time_user_id = 14;
//    $one_time_address_type_code = 3;
//
//    $one_time_ship_to_address_obj->id = isset($session->ship_to_address_id) ? $session->ship_to_address_id : null;
//    $one_time_ship_to_address_obj->user_id = isset($session->ship_to_address_user_id) ? $session->ship_to_address_user_id : $one_time_user_id;
//    $one_time_ship_to_address_obj->address_type_code = isset($session->ship_to_address_address_type_code) ? $session->ship_to_address_address_type_code : $one_time_address_type_code;
//    $one_time_ship_to_address_obj->street1 = isset($session->ship_to_address_street1) ? $session->ship_to_address_street1 : "";
//    $one_time_ship_to_address_obj->street2 = isset($session->ship_to_address_street2) ? $session->ship_to_address_street2 : "";
//    $one_time_ship_to_address_obj->city = isset($session->ship_to_address_city) ? $session->ship_to_address_city : "";
//    $one_time_ship_to_address_obj->state = isset($session->ship_to_address_state) ? $session->ship_to_address_state : "";
//    $one_time_ship_to_address_obj->zip = isset($session->ship_to_address_zip) ? $session->ship_to_address_zip : "";
//    $one_time_ship_to_address_obj->country_code = isset($session->ship_to_address_country_code) ? $session->ship_to_address_country_code : "";
//    $one_time_ship_to_address_obj->phone = isset($session->ship_to_address_phone) ? $session->ship_to_address_phone : "";
//
//    // 
//    global $session;
//    $session->set_ship_to_address_obj($one_time_ship_to_address_obj);
//
//
////    // TODO: DEBUG
////    echo "<pre>";
////    print_r($session->ship_to_address_obj);
////    echo "</pre>";
//}

/*
  public $id;
  public $user_id;
  public $address_type_code;
  public $street1;
  public $street2;
  public $city;
  public $state;
  public $zip;
  public $country_code;
  public $phone;
 */
?>




<!--Meat-->
<?php
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
    
    global $session;
    $session->set_ship_to_address_vars($a_ship_to_address_obj);
    
//    echo "<pre>";
//    print_r($_POST);
//    print_r($a_ship_to_address_obj);
//    echo "</pre>";


    //
    redirect_to(LOCAL . "/public/__view/view_shipping.php");
}
?>