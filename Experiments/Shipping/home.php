<?php

//require_once("../vendor/autoload.php");
require_once("easypost-php-master/lib/easypost.php");

// Key from github.
\EasyPost\EasyPost::setApiKey('cueqNZUb3ldeWTNX7MU3Mel8UXtaAMUi');

// Test Key from odox700@gmail.com account.
//\EasyPost\EasyPost::setApiKey('1SEVj2JbQefTe0JxShMtiw');
//
// Production Key from odox700@gmail.com account.
//\EasyPost\EasyPost::setApiKey('BCZMVeLiKaUJbW9jlZhNyw');
//
//
//
// TODO: TODO: Create a table "Basic Info" for names for this...
// Then INNER JOIN to the Address table query.
$to_address = \EasyPost\Address::create(
                array(
                    "name" => "Ted Byukatsu",
                    "street1" => "78 Monkhouse Rd",
                    "street2" => "",
                    "city" => "Markhma",
                    "state" => "ON",
                    "zip" => "L6E 1V5",
                    "country" => "CA"
//        "phone"   => "415-456-7890"
                )
);



$from_address = \EasyPost\Address::create(
                array(
                    "company" => "Ted UkayX2",
                    "street1" => "105-50 Thorncliffe Park Dr",
                    "street2" => "",
                    "city" => "East York",
                    "state" => "ON",
                    "zip" => "M4H 1K4",
                    "country" => "CA"
//                            "phone" => "620-123-4567"
                )
);





// TODO: Don't forget to add the object "Customs"
// for international shipping.
// Setting the item mass & dimension (parcel).
global $connection;

// Query for selecting all the items on the current cart.
$query = "SELECT CartItems.CartId, CartItems.Quantity AS 'Quantity', Length, Width, Height, Mass ";
$query .= "FROM CartItems ";
$query .= "INNER JOIN MyStoreItems ON CartItems.ItemId = MyStoreItems.Id ";
$query .= "WHERE CartId = {$selected_cart_id}";

$results = mysqli_query($connection, $query);

confirm_query($results);


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
while ($row = mysqli_fetch_assoc($results)) {
    $total_mass += ($row["Mass"] * $row["Quantity"]);
    $total_height += ($row["Height"] * $row["Quantity"]);

    if ($row["Length"] >= $max_length) {
        $max_length = $row["Length"];
    }

    if ($row["Width"] >= $max_width) {
        $max_width = $row["Width"];
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




// TODO: DEBUG: LOG
echo "<pre>";
print_r($final_shipment_dimensions);
echo "</pre>";


$shipment = \EasyPost\Shipment::create(
                array(
                    "to_address" => $to_address,
                    "from_address" => $from_address,
                    "parcel" => $parcel
                )
);








// 
$cheapest_days_and_rate_pair_array = array();

// 
$current_delivery_carrier;
$current_delivery_service;
$current_delivery_days;
$current_delivery_rate;
$new_delivery_option;
$count = -1;

foreach ($shipment["rates"] as $rates) {
//    echo "<br>{$rates['carrier']}: {$rates['rate']}: {$rates['delivery_days']}: {$rates['service']}<br>";
    // If there's no delivery days listed,
    // don't include it in the list.
//    if ((empty($rates['delivery_days'])) && ($rates['carrier'] != "UPS")) {
//        continue;
//    } 
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



    $isThereReplacement = false;

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
//                $isThereReplacement = true;
            }

            break;
        }

        if ($i == (count($cheapest_days_and_rate_pair_array)) - 1) {
            array_push($cheapest_days_and_rate_pair_array, $new_delivery_option);
        }
    }
}


// TODO: DEBUG
echo "<pre>";
print_r($shipment["rates"]);
echo "</pre>";
?>