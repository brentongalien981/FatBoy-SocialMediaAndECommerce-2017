<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-07
 * Time: 13:48
 */

namespace App\Publico\Controller\Friends;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/model_frienship.php");
require_once(PUBLIC_PATH . "/__model/NotificationFriendship.php");

use App\Publico\Controller\MainController;
use Friendship;



class Followers extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read() {
        return Friendship::get_all_friends();
    }

}





// Instance
$followers = new Followers();





// AJAX Handler.
if (isset($_GET['get_all_followers'])) {
    $returned_json = array("is_result_ok" => true);
    $returned_json['friends'] = $followers->read();
    echo json_encode($returned_json);
}