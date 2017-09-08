<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-07
 * Time: 13:55
 */

namespace App\Publico\Controller\Notifications;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/NotificationPost.php");


use App\Publico\Controller\MainController;
use NotificationPost;

class NotificationPostController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data) {
        //
        global $session;

        $notification = new NotificationPost();
        $notification->id = null;
        $notification->notified_user_id = $session->currently_viewed_user_id;
        $notification->notifier_user_id = $session->actual_user_id;
        $notification->notification_msg_id = $data["notification_msg_id"];
        $notification->post_id = $data["post_id"];
        $notification->is_deleted = false;


        $is_creation_ok = $notification->create_with_bool();

        return $is_creation_ok;
    }
}