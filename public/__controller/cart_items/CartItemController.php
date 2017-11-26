<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 04:14
 */

namespace App\Publico\Controller\CartItems;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/CartItem.php");
require_once(PUBLIC_PATH . "/__model/StoreCart.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\CartItem;
use App\Publico\Model\StoreCart;

class CartItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        global $session;

        if (!isset($session->cart_id)) { return null; }

        return CartItem::read($data);
    }

    public function update($data)
    {
        //
        $d = $data;
        global $session;


        /**/
        $is_update_ok = CartItem::update($d);

        return $is_update_ok;
    }

    public function create($data)
    {
        //
        $d = $data;
        global $session;
        $is_creation_ok = false;


        //ish
        if (StoreCart::does_cart_exist()) {

            $is_creation_ok = self::try_creating_cart_item($d);
        }
        else {
            $new_store_cart = new StoreCart();
            $new_store_cart->cart_id = null;
            $new_store_cart->buyer_user_id = $session->actual_user_id;
            $new_store_cart->seller_user_id = $session->currently_viewed_user_id;
            $new_store_cart->is_complete = 0;

            $is_creation_ok = $new_store_cart->create();

            if ($is_creation_ok) {
                StoreCart::set_cart_id($new_store_cart->cart_id);

                $is_creation_ok = self::try_creating_cart_item($d);
            }
        }




        //
        return $is_creation_ok;
    }

    private static function try_creating_cart_item($data) {

        global $session;
        $is_creation_ok = false;

        if (CartItem::is_store_item_already_in_cart($data)) {
            $is_creation_ok = true;
        }
        else {
            // Create a cart-item record.
            $new_cart_item = new CartItem();
            $new_cart_item->id = null;
            $new_cart_item->cart_id = $session->cart_id;
            $new_cart_item->item_id = $data["store_item_id"];
            $new_cart_item->quantity = 1;

            $is_creation_ok = $new_cart_item->create();

        }

        return $is_creation_ok;
    }
}