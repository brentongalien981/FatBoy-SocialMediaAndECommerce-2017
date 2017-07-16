<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-13
 * Time: 17:04
 */

namespace App\Publico\Controller\Friends;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/FriendshipMuse.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\FriendshipMuse;


class FriendshipMuseController extends MainController
{
    public function __construct() {
        parent::__construct();
    }


    public function read($data) {
        $section = $data['section'];
        $x_friends =  FriendshipMuse::read_by_section($section);
        return $x_friends;
    }



    public function delete($data) {

        return FriendshipMuse::delete($data['muse_user_id']);
    }

}