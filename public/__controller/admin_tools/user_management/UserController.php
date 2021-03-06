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
//        return User::read_with_offset($data['offset']);
        return User::read($data);
    }


    public function create($data)
    {
        //
        $d = $data;

        //
        $new_user = new User();

        $new_user->user_name = $d['user_name'];
//        $new_user->email = $sanitized_array["email"];

        $hashed_password = password_hash($d['password'], PASSWORD_BCRYPT);
        $new_user->hashed_password = $hashed_password;

        $new_user->user_type_id = $d['user_type'];

        $new_user->private = $d['privacy'];

//        if ($d['account_status'] == "0") {
//            // Public
//            $new_user->account_status_id = false;
//        } else if ($d['account_status'] == "1") {
//            // Public
//            $new_user->account_status_id = true;
//        }


        $new_user->account_status_id = (int) $d['account_status'];


        //
        return $new_user->create();
    }





    public function update($data)
    {
        //
        $d = $data;

        //
        $current_user = new User();

        $current_user->user_id = $d['user_id'];
        $current_user->user_name = $d['user_name'];
        $current_user->email = $d['email'];

//        $hashed_password = password_hash($d['password'], PASSWORD_BCRYPT);
//        $current_user->hashed_password = $hashed_password;

        $current_user->user_type_id = $d['user_type'];

        $current_user->private = $d['privacy'];

//        if ($d['account_status'] == "0") {
//            // Public
//            $current_user->account_status_id = false;
//        } else if ($d['account_status'] == "1") {
//            // Public
//            $current_user->account_status_id = true;
//        }


        $current_user->account_status_id = (int) $d['account_status'];


        //
        return $current_user->update();
    }

}