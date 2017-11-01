<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-30
 * Time: 06:18
 */

namespace App\Publico\Controller\StoreItems;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/StoreItem.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/StoreItemValidator.php");


use App\Privado\HelperClasses\Validation\StoreItemValidator;
use App\Publico\Controller\MainController;
use App\Publico\Model\StoreItem;

class StoreItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new StoreItemValidator();
    }

    public function read($data)
    {
        return StoreItem::read($data);
    }

    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $si = new StoreItem();

//        $si->id = null;
        $si->user_id = $session->actual_user_id;
        $si->name = $d["product_name"];
        $si->price = $d["product_price"];
        $si->quantity = $d["product_quantity"];
        $si->description = $d["product_description"];
        $si->photo_address = $d["product_photo_src"];
        $si->mass = $d["product_mass"];
        $si->length = $d["product_length"];
        $si->width = $d["product_width"];
        $si->height = $d["product_height"];

        //
        return $si->create();
    }

    public function update($data)
    {
        //
        $d = $data;
        global $session;

        //
        $si = new StoreItem();

        $si->id = $d["product_id"];
        $si->user_id = $session->actual_user_id;
        $si->name = $d["product_name"];
        $si->price = $d["product_price"];
        $si->quantity = $d["product_quantity"];
        $si->description = $d["product_description"];
        $si->photo_address = $d["product_photo_src"];
        $si->mass = $d["product_mass"];
        $si->length = $d["product_length"];
        $si->width = $d["product_width"];
        $si->height = $d["product_height"];

        //
        return $si->update();
    }
}