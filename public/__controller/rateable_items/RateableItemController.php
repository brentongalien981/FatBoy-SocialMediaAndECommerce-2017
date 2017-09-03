<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-01
 * Time: 15:24
 */

namespace App\Publico\Controller\RateableItems;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/RateableItem.php");
//require_once(PRIVATE_PATH . "/helper_classes/validation/Validator.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/RateableItemValidator.php");

use App\Publico\Controller\MainController;
use App\Publico\Model\RateableItem;
//use App\Privado\HelperClasses\Validation\Validator;
use App\Privado\HelperClasses\Validation\RateableItemValidator;


class RateableItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new RateableItemValidator();
    }

    public function read_rateable_item_ids($data) {
        return RateableItem::read_rateable_item_ids($data);
    }
    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $rateable_item = new RateableItem();

//        $rateable_item->user_id = $session->actual_user_id;

        $rateable_item->item_x_id = $d['item_x_id'];

        $rateable_item->item_x_type_id = $d['item_x_type_id'];

        //
        return $rateable_item->create();
    }
}