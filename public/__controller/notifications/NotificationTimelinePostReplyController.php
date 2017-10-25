<?php

namespace App\Publico\Controller\Notifications;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/NotificationTimelinePostReply.php");
require_once(PUBLIC_PATH . "/__controller/timeline_post_subscriptions/TimelinePostSubscriptionController.php");


use App\Publico\Controller\MainController;
use NotificationTimelinePostReply;
use App\Publico\Controller\TimelinePostSubscriptions\TimelinePostSubscriptionController;

class NotificationTimelinePostReplyController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        /* Vars. */
        $d = $data;
        global $session;


        /* Read user-ids that that are subscribed to the timeline-post-id. */
        $timeline_post_subscriptions = TimelinePostSubscriptionController::read($d);


        /*
         * Loop throught all user-ids. And for each user-id,
         * create a notification-timeline-post-reply record.
         */
        foreach ($timeline_post_subscriptions as $subscription) {

            $n = new NotificationTimelinePostReply();
            $n->id = null;
            $n->notified_user_id = $subscription["subscriber_user_id"];
            $n->notifier_user_id = $session->actual_user_id;
            $n->notification_msg_id = 5;
            $n->is_deleted = false;
            $n->timeline_post_reply_id = $d["timeline_post_reply_id"];

            $is_creation_ok = $n->create();

            // If there only one erronous creation, quit.
            if (!$is_creation_ok) { return false; }
        }

        //
        return true;



    }
}