<?php
namespace App\Publico\Controller\TimelinePosts;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/TimelinePost.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\TimelinePost;

class TimelinePostController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetch($data)
    {
        return TimelinePost::fetch($data);
    }

    public function create($data)
    {
        $d = $data;

        global $session;
        $post = new TimelinePost();

        
        $post->owner_user_id = $session->currently_viewed_user_id;
        $post->poster_user_id = $session->actual_user_id;
        $post->message = $d["message"];

        $is_creation_ok = $post->create();

        return $is_creation_ok;
    }

    public function read()
    {
        return TimelinePost::read();
    }
}