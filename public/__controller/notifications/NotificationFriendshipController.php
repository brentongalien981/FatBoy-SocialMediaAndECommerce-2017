<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-07
 * Time: 13:48
 */

namespace App\Publico\Controller\Notifications;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/NotificationFriendship.php");


use App\Publico\Controller\MainController;
use NotificationFriendship;


class NotificationFriendshipController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return array
     */
    public function read($section)
    {
        return NotificationFriendship::read_by_section($section);
    }

}
?>