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


use App\Publico\Controller\MainController;
use App\Publico\Model\CartItem;

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
}