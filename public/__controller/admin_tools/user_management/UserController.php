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

}