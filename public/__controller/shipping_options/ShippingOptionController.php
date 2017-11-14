<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-08
 * Time: 11:27
 */

namespace App\Publico\Controller\ShippingOptions;

require_once("../MainController.php");
require_once(PRIVATE_PATH . "/external_api/easypost-php-master/lib/easypost.php");

require_once(PUBLIC_PATH . "/__model/ShippingOption.php");
require_once(PUBLIC_PATH . "/__model/Address.php");
require_once(PUBLIC_PATH . "/__model/StoreCart.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\ShippingOption;
use App\Publico\Model\StoreCart;
use App\Publico\Model\Address;


class ShippingOptionController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        /**/
        global $session;
        $cart_id = $session->cart_id;

        /* Get the seller_user_id in StoreCart model. */
        $cart = StoreCart::read_by_id($cart_id);
        $seller_user_id = $cart["seller_user_id"];


        /* Get the address of the seller based on the seller_user_id in obj form. */
        $seller_address = Address::read_by_user_id($seller_user_id);

        /* Get the address of the buyer in obj form based on session's $ship_to_address_id. */
        $buyer_address = Address::read_by_id($session->ship_to_address_id);

        /**/
        $data["seller_address"] = $seller_address;
        $data["buyer_address"] = $buyer_address;

        $so = new ShippingOption();

        return $so->read($data);
    }
}