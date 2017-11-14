<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-03
 * Time: 10:32
 */

namespace App\Publico\Controller\Shipping;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/Address.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\Address;


class ShippingController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $sa = new Address();

        $sa->id = null;
        $sa->user_id = $session->actual_user_id;
        $sa->address_type_code = null;
        $sa->street1 = $d["shipping_street1"];
        if (isset($d["shipping_street2"])) { $sa->street2 = $d["shipping_street2"]; }

        $sa->city = $d["shipping_city"];
        $sa->state = $d["shipping_state"];
        $sa->zip = $d["shipping_zip"];
        $sa->country_code = $d["shipping_country_code"];
        $sa->phone = $d["shipping_phone"];

        /*
         * If the address-details don't constitute to an existing address record,
         * then create a new record.
         */
        $is_crud_ok = false;

        if ($sa->does_address_exist()) {
            $existing_address = $sa->read_existing_address();
            $sa->id = $existing_address["address_id"];

            $is_crud_ok = true;
        }
        else {
            // number 3 means a one-time-address-type.
            $sa->address_type_code = 3;

            $is_crud_ok = $sa->create();
        }


        /* Set the session-variable "shipping-address-id." */
        if ($is_crud_ok) {
            $session->set_ship_to_address_id($sa->id);
        }



        /**/
        if (isset($session->ship_to_address_id)) { return $session->ship_to_address_id; }
        return false;
    }
}