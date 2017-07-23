<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-20
 * Time: 16:42
 */

namespace App\Publico\Controller\AdminTools\UserManagement;


require_once("../../MainController.php");
require_once(PUBLIC_PATH . "/__model/User.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\User;


class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
//        return array("shit" => "butom");
        return User::read_with_offset($data['offset']);
    }


    public function create($data) {
        //
        global $session;

        // TODO:DEBUG
        return true;

//        $user = new User();
//        $user->id = null;
//        $user->notified_user_id = $data["friend_id"];
//        $user->notifier_user_id = $session->actual_user_id;
//        $user->notification_msg_id = $data["notification_msg_id"];
//        $user->is_deleted = false;
//
//
//        $is_creation_ok = $user->create_with_bool();
//
//        return $is_creation_ok;
    }

}