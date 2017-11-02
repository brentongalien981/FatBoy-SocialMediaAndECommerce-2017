<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 00:16
 */

namespace App\Publico\Controller\StoreCarts;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/StoreCart.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\StoreCart;


class StoreCartController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        return StoreCart::read($data);
    }
}