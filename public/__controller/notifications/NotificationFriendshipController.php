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


    public function read($data)
    {
        return NotificationFriendship::read_by_offset($data);
    }

    public function update_fetch($data)
    {
        // For updates, limit the read by just 1.
        $limit = 1;

        // TODO:REMINDER: Make the $section a variable in the scripts of _script/notifications
        // and the rest of the Notification sub-menus.
        return NotificationFriendship::read_by_section($data['section'], $limit);
    }

    public function fetch($data)
    {
        return NotificationFriendship::fetch($data);
    }


    public function create($data) {
        //
        global $session;

        $notification = new NotificationFriendship();
        $notification->id = null;
        $notification->notified_user_id = $data["friend_id"];
        $notification->notifier_user_id = $session->actual_user_id;
        $notification->notification_msg_id = $data["notification_msg_id"];
        $notification->is_deleted = false;


        $is_creation_ok = $notification->create_with_bool();

        return $is_creation_ok;
    }


    public function delete($data) {

        return NotificationFriendship::delete($data['notification_id']);
    }

}

?>