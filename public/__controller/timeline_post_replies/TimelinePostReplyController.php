<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-24
 * Time: 02:33
 */

namespace App\Publico\Controller\TimelinePostReplies;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/TimelinePostReply.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\TimelinePostReply;


class TimelinePostReplyController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        return TimelinePostReply::read($data);
    }

    public function fetch($data)
    {
        return TimelinePostReply::fetch($data);
    }

    public function create($data)
    {
        $d = $data;

        global $session;
        $post = new TimelinePostReply();


        $post->parent_post_id = $d["parent_post_id"];
        $post->owner_user_id = $session->currently_viewed_user_id;
        $post->poster_user_id = $session->actual_user_id;
        $post->message = $d["message"];

        $is_creation_ok = $post->create();

        if ($is_creation_ok) { return $post->id; }
        else { return false; }

    }
}