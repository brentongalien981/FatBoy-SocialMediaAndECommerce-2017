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

//
function populate_shipping_options() {
    //
    $seller_ship_from_address_obj = get_seller_ship_from_address_obj();

    //
    $buyer_ship_to_address_obj = get_buyer_ship_to_address_obj();

    //
    set_external_api_shipping_requirements($seller_ship_from_address_obj, $buyer_ship_to_address_obj);
}

// Helper Methods.
function get_seller_ship_from_address_obj() {
    // Query to get the address of the seller for shipping calculation requirements.
    global $session;
    $seller_user_id = $session->seller_user_id;

    $query = "SELECT * FROM Address ";
    $query .= "WHERE user_id = {$session->seller_user_id} LIMIT 1";


    // TODO: LOG
    MyDebugMessenger::add_debug_message("LOG: inside function get_seller_ship_from_address_obj():");
    MyDebugMessenger::add_debug_message("LOG: inside function QUERY $query: {$query}");



    return Address::read_by_query_and_instantiate($query)[0];
}

// @returns the validated buyer/actual_user to_address obj.
function get_buyer_ship_to_address_obj() {
    global $session;
    $buyer_ship_to_address_obj = new Address();

    $buyer_ship_to_address_obj->street1 = $session->ship_to_address_street1;
    $buyer_ship_to_address_obj->street2 = $session->ship_to_address_street2;
    $buyer_ship_to_address_obj->city = $session->ship_to_address_city;
    $buyer_ship_to_address_obj->state = $session->ship_to_address_state;
    $buyer_ship_to_address_obj->zip = $session->ship_to_address_zip;
    $buyer_ship_to_address_obj->country_code = $session->ship_to_address_country_code;


    // TODO: LOG
    MyDebugMessenger::add_debug_message("LOG: inside function get_buyer_ship_to_address_obj():");

    return $buyer_ship_to_address_obj;
}

function get_ship_from_address_api_obj($seller_ship_from_address_obj) {

    $from_address = \EasyPost\Address::create(
                    array(
                        "company" => "Crazy Allen UkayX2",
                        "street1" => "{$seller_ship_from_address_obj->street1}",
                        "street2" => "{$seller_ship_from_address_obj->street2}",
                        "city" => "{$seller_ship_from_address_obj->city}",
                        "state" => "{$seller_ship_from_address_obj->state}",
                        "zip" => "{$seller_ship_from_address_obj->zip}",
                        "country" => "{$seller_ship_from_address_obj->country_code}"
//                        "phone" => "620-123-4567"
                    )
    );

    // TODO: LOG
//    MyDebugMessenger::add_debug_message("LOG: inside function get_ship_from_address_api_obj():");

    return $from_address;
}

function get_ship_to_address_api_obj($buyer_ship_to_address_obj) {

    $to_address = \EasyPost\Address::create(
                    array(
                        "name" => "Crazy Apes",
                        "street1" => "{$buyer_ship_to_address_obj->street1}",
                        "street2" => "{$buyer_ship_to_address_obj->street2}",
                        "city" => "{$buyer_ship_to_address_obj->city}",
                        "state" => "{$buyer_ship_to_address_obj->state}",
                        "zip" => "{$buyer_ship_to_address_obj->zip}",
                        "country" => "{$buyer_ship_to_address_obj->country_code}"
//                        "phone"   => "415-456-7890"
                    )
    );

    // TODO: LOG
//    MyDebugMessenger::add_debug_message("LOG: inside function get_ship_to_address_api_obj():");

    return $to_address;
}

function set_external_api_shipping_requirements($seller_ship_from_address_obj, $buyer_ship_to_address_obj) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("LOG: inside function set_external_api_shipping_requirements():");


    //
    require_once(PRIVATE_PATH . "/external_api/easypost-php-master/lib/easypost.php");
//    require_once(PUBLIC_PATH . "/easypost-php-master/lib/easypost.php");

    // Key from github.
    \EasyPost\EasyPost::setApiKey('cueqNZUb3ldeWTNX7MU3Mel8UXtaAMUi');



    // Shipping requirement 1: $from_address.
    $from_address = get_ship_from_address_api_obj($seller_ship_from_address_obj);


    // Shipping requirement 2: $to_address.
    // TODO: TODO: Create a table "Basic Info" for names for this...
    // Then INNER JOIN to the Address table query.
    $to_address = get_ship_to_address_api_obj($buyer_ship_to_address_obj);


    // Shipping requirement 3: $parcel.
    $parcel = get_shipping_parcel_api_obj();


    // Shipping requirement 4: shipment.
    $shipment = get_shipment_api_obj($from_address, $to_address, $parcel);

    // Figure out the cheapest and shortest-day shipping options.
    $cheapest_days_and_rate_pair_array = get_cheapest_days_and_rate_pair_array($shipment);



    //
//    echo "<select>";
    show_completely_presented_shipping_options($cheapest_days_and_rate_pair_array);
//    echo "</select>";
////    // TODO: DEBUG
//    // TODO: DEBUG: Delete this please.
//    echo "<pre>";
//    echo "<h1>PUTANG INANG cheapest_days_and_rate_pair_array</h1>";
//    print_r($cheapest_days_and_rate_pair_array);
//    echo "</pre>";
//    // TODO: DEBUG
////    MyDebugMessenger::add_debug_message("DEBUG: inside function set_external_api_shipping_requirements(): So far so good.");
}

function show_completely_presented_shipping_options($cheapest_days_and_rate_pair_array) {
    foreach ($cheapest_days_and_rate_pair_array as $a_verified_delivery_option) {
        if ($a_verified_delivery_option[0] == "zZz") {
            continue;
        }

        echo "<option value='{$a_verified_delivery_option[3]}'>{$a_verified_delivery_option[0]} - {$a_verified_delivery_option[1]} - Ships in {$a_verified_delivery_option[2]} days - USD \${$a_verified_delivery_option[3]}</option>";
    }



    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("DEBUG: inside function show_completely_presented_shipping_options()");
}

function get_cheapest_days_and_rate_pair_array($shipment) {

    $cheapest_days_and_rate_pair_array = array();

    $current_delivery_carrier;
    $current_delivery_service;
    $current_delivery_days;
    $current_delivery_rate;
    $new_delivery_option;
    $count = -1;

    foreach ($shipment["rates"] as $rates) {
        if (empty($rates['delivery_days'])) {
            continue;
        }


        $current_delivery_carrier = $rates["carrier"];
        $current_delivery_service = $rates["service"];
        $current_delivery_days = $rates["delivery_days"];
        $current_delivery_rate = $rates["rate"];

        $new_delivery_option = array($current_delivery_carrier, $current_delivery_service, $current_delivery_days, $current_delivery_rate);

        // This only happens once in this loop.
        if ($count == -1) {
            array_push($cheapest_days_and_rate_pair_array, $new_delivery_option);
            ++$count;
            continue;
        }



        for ($i = 0; $i < count($cheapest_days_and_rate_pair_array); $i++) {
            if (($cheapest_days_and_rate_pair_array[$i][0] == $current_delivery_carrier) &&
                    ($cheapest_days_and_rate_pair_array[$i][2] == $current_delivery_days)) {


                if (($cheapest_days_and_rate_pair_array[$i][3] > $current_delivery_rate)) {
                    // This means there's a cheaper option with the same delivery days.
                    // So set the name of the old option to "zZz" which will be a flag
                    // next to this chunk of code to be disregarded.
                    $cheapest_days_and_rate_pair_array[$i][0] = "zZz";

                    // Add the new and better delivery option.
                    array_push($cheapest_days_and_rate_pair_array, $new_delivery_option);
                }

                break;
            }

            if ($i == (count($cheapest_days_and_rate_pair_array)) - 1) {
                array_push($cheapest_days_and_rate_pair_array, $new_delivery_option);
            }
        }
    }


    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("DEBUG: inside function get_cheapest_days_and_rate_pair_array()");

    //
    return $cheapest_days_and_rate_pair_array;
}

function get_shipment_api_obj($from_address, $to_address, $parcel) {

    $shipment = \EasyPost\Shipment::create(
                    array(
                        "to_address" => $to_address,
                        "from_address" => $from_address,
                        "parcel" => $parcel
                    )
    );

    // TODO: DEBUG
//    MyDebugMessenger::add_debug_message("DEBUG: inside function get_shipment_api_obj()");

    return $shipment;
}

function get_shipping_parcel_api_obj() {
// TODO: Don't forget to add the object "Customs"
// for international shipping.
    // Setting the item mass & dimension (parcel).
    global $session;

    // Query for selecting all the items on the current cart.
    $query = "SELECT CartItems.cart_id, CartItems.quantity AS 'quantity', length, width, height, mass ";
    $query .= "FROM CartItems ";
    $query .= "INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
    $query .= "WHERE cart_id = {$session->cart_id}";

    $results = Address::read_by_query($query);



// Make a l x w x h calculator for the parcel data requirments for the shipping.
// Remember that you can figure out l & w by looping through all the items in the
// cart and figuring out which item has the biggest l & w.
// Then just add up all the heights of the items to get the h.
// Then add up all the mass of the items. (Note that it’s in oz and in.)

    $max_length = 0.0;
    $max_width = 0.0;
    $total_height = 0.0;
    $total_mass = 0.0;

    $final_shipment_dimensions = array("length" => 0.0, "width" => 0.0, "height" => 0.0, "mass" => 0.0);

    global $database;
    while ($row = $database->fetch_array($results)) {
        $total_mass += ($row["mass"] * $row["quantity"]);
        $total_height += ($row["height"] * $row["quantity"]);

        if ($row["length"] >= $max_length) {
            $max_length = $row["length"];
        }

        if ($row["width"] >= $max_width) {
            $max_width = $row["width"];
        }
    }

    //
    $final_shipment_dimensions["length"] = $max_length;
    $final_shipment_dimensions["width"] = $max_width;
    $final_shipment_dimensions["height"] = $total_height;
    $final_shipment_dimensions["mass"] = $total_mass;

    $parcel = \EasyPost\Parcel::create(array(
                "length" => $final_shipment_dimensions["length"], //10.2,
                "width" => $final_shipment_dimensions["width"], //7.9,
                "height" => $final_shipment_dimensions["height"], //3, // inches
                "weight" => $final_shipment_dimensions["mass"]//55 // ounce
    ));


    // TODO: DEBUG
//    MyDebugMessenger::add_debug_message("DEBUG: inside function get_shipping_parcel_api_obj().");

    return $parcel;
}
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
    } else {
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