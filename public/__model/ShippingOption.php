<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-08
 * Time: 11:39
 */

namespace App\Publico\Model;


class ShippingOption
{
    protected function get_sanitized_attributes()
    {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    protected function get_attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    private function get_shipping_parcel_api_obj()
    {
// TODO: Don't forget to add the object "Customs"
// for international shipping.
        // Setting the item mass & dimension (parcel).
        global $session;

        // Query for selecting all the items on the current cart.
        $query = "SELECT CartItems.cart_id, CartItems.quantity AS 'quantity', length, width, height, mass ";
        $query .= "FROM CartItems ";
        $query .= "INNER JOIN MyStoreItems ON CartItems.item_id = MyStoreItems.id ";
        $query .= "WHERE cart_id = {$session->cart_id}";

        $results = self::read_by_query($query);


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


        return $parcel;
    }

    public function read($data)
    {
        /**/
        return $this->get_shipping_options($data);
    }

    private function get_shipping_options($data)
    {

        /**/
        $d = $data;

        //
//        require_once(PRIVATE_PATH . "/external_api/easypost-php-master/lib/easypost.php");
//    require_once(PUBLIC_PATH . "/easypost-php-master/lib/easypost.php");
        // Key from github.
        \EasyPost\EasyPost::setApiKey('cueqNZUb3ldeWTNX7MU3Mel8UXtaAMUi');

        // Production Key for odox700@gmail.com.
//    \EasyPost\EasyPost::setApiKey('BCZMVeLiKaUJbW9jlZhNyw');

        // Test Key.
//    \EasyPost\EasyPost::setApiKey('1SEVj2JbQefTe0JxShMtiw');


        // Shipping requirement 1: $from_address.
        $from_address = $this->get_ship_from_address_api_obj($d["seller_address"]);


        // Shipping requirement 2: $to_address.
        // TODO: TODO: Create a table "Basic Info" for names for this...
        // Then INNER JOIN to the Address table query.
        $to_address = $this->get_ship_to_address_api_obj($d["buyer_address"]);


        // Shipping requirement 3: $parcel.
        $parcel = $this->get_shipping_parcel_api_obj();


        // Shipping requirement 4: shipment.
        $shipment = $this->get_shipment_api_obj($from_address, $to_address, $parcel);

        // Figure out the cheapest and shortest-day shipping options.
        $cheapest_days_and_rate_pair_array = $this->get_cheapest_days_and_rate_pair_array($shipment);


        return $this->get_cheapest_shipping_options($cheapest_days_and_rate_pair_array);

    }

    private function get_shipment_api_obj($from_address, $to_address, $parcel)
    {

        $shipment = \EasyPost\Shipment::create(
            array(
                "to_address" => $to_address,
                "from_address" => $from_address,
                "parcel" => $parcel
            )
        );

        return $shipment;
    }

    private function get_ship_from_address_api_obj($seller_address)
    {

        /**/
        $sa = $seller_address;

        $from_address = \EasyPost\Address::create(
            array(
                "company" => "Company Name of Seller",
                "street1" => $sa["street1"],
                "street2" => $sa["street2"],
                "city" => $sa["city"],
                "state" => $sa["state"],
                "zip" => $sa["zip"],
                "country" => $sa["country_code"]
//                        "phone" => 620-123-4567"
            )
        );


        return $from_address;
    }

    private function get_ship_to_address_api_obj($buyer_address)
    {

        /**/
        $ba = $buyer_address;

        $to_address = \EasyPost\Address::create(
            array(
                "company" => "Company Name of Seller",
                "street1" => $ba["street1"],
                "street2" => $ba["street2"],
                "city" => $ba["city"],
                "state" => $ba["state"],
                "zip" => $ba["zip"],
                "country" => $ba["country_code"]
//                        "phone" => 620-123-4567"
            )
        );


        return $to_address;
    }


    /**
     *  Because the EasyPost Shipping API gives back a variety
     * of shipping options, this method basically compares which
     * are the cheaper of all the options and returns those cheap ones.
     *
     * @param $shipment
     * @return array
     */
    private function get_cheapest_days_and_rate_pair_array($shipment)
    {

        $cheapest_days_and_rate_pair_array = array();

        $current_delivery_carrier = null;
        $current_delivery_service = null;
        $current_delivery_days = null;
        $current_delivery_rate = null;
        $new_delivery_option = null;
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


        //
        return $cheapest_days_and_rate_pair_array;
    }

    private function get_cheapest_shipping_options($cheapest_days_and_rate_pair_array) {

        $cheapest_shipping_options = array();

        foreach ($cheapest_days_and_rate_pair_array as $a_verified_delivery_option) {
            if ($a_verified_delivery_option[0] == "zZz") {
                continue;
            }

//            echo "<option value='{$a_verified_delivery_option[3]}'>{$a_verified_delivery_option[0]} - {$a_verified_delivery_option[1]} - Ships in {$a_verified_delivery_option[2]} days - USD \${$a_verified_delivery_option[3]}</option>";

            $an_obj = array(
                "shipping_company" => $a_verified_delivery_option[0],
                "shipping_type" => $a_verified_delivery_option[1],
                "shipping_days" => $a_verified_delivery_option[2],
                "shipping_price" => $a_verified_delivery_option[3]
            );

            array_push($cheapest_shipping_options, $an_obj);
        }


        return $cheapest_shipping_options;

    }
}