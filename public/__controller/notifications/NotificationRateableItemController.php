<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-09
 * Time: 08:52
 */

namespace App\Publico\Controller\Notifications;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/NotificationRateableItem.php");


use App\Publico\Controller\MainController;
use NotificationRateableItem;

class NotificationRateableItemController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data) {
        //
        global $session;

        $notification = new NotificationRateableItem();
        $notification->id = null;
        $notification->notified_user_id = $session->currently_viewed_user_id;
        $notification->notifier_user_id = $session->actual_user_id;
        $notification->notification_msg_id = $data["notification_msg_id"];
        $notification->rateable_item_id = $data["rateable_item_id"];
        $notification->rate_value = $data["rate_value"];
//        $notification->is_deleted = false;
        $notification->is_deleted = false;

        $is_creation_ok = $notification->create_with_bool();

        return $is_creation_ok;
    }

    public function read($data)
    {
        return NotificationRateableItem::read_by_offset($data);
    }

    public function fetch($data)
    {
        return NotificationRateableItem::fetch($data);
    }

    public function delete($data) {
        return NotificationRateableItem::delete($data['notification_id']);
    }
}