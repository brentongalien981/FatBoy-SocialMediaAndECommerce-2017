<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-23
 * Time: 23:41
 */

namespace App\Publico\Controller\TimelinePostSubscriptions;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/TimelinePostSubscription.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\TimelinePostSubscription;


class TimelinePostSubscriptionController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function create($data)
    {
        $d = $data;

        global $session;
        $tps = new TimelinePostSubscription();


        $tps->timeline_post_id = $d["timeline_post_id"];
        $tps->subscriber_user_id = $session->actual_user_id;

        $is_creation_ok = $tps->create();

        return $is_creation_ok;
    }

    public static function read($data) {
        return TimelinePostSubscription::read($data);
    }
}