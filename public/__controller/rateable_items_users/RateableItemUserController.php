<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-03
 * Time: 16:27
 */

namespace App\Publico\Controller\RateableItemsUsers;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/RateableItemUser.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/Validator.php");

use App\Publico\Controller\MainController;
use App\Publico\Model\RateableItemUser;
use App\Privado\HelperClasses\Validation\Validator;


class RateableItemUserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update($data)
    {
        //
        $d = $data;
        global $session;

        //
        $riu = new RateableItemUser();
        $riu->rateable_item_id = $d['rateable_item_id'];
        $riu->responder_user_id = $session->actual_user_id;
        $riu->rate_value = $d['rate_value'];
//        $riu->date_created = $d['date_created'];
//        $riu->date_updated = "NOW()";

        if (RateableItemUser::does_record_exist($riu->rateable_item_id)) {
            return $riu->update();
        }
        else {
            return $riu->create();
        }



        //

    }
}