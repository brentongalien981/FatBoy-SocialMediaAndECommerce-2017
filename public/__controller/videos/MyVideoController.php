<?php
/**
 * Created by PhpStorm.
 * Photo: ops
 * Date: 2017-08-17
 * Time: 20:08
 */

namespace App\Publico\Controller\Videos;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/MyVideo.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/VideoValidator.php");


use App\Privado\HelperClasses\Validation\VideoValidator;
use App\Publico\Controller\MainController;
use App\Publico\Model\MyVideo;


class MyVideoController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new VideoValidator();
    }

    public function read($data)
    {
//        return MyVideo::read($data);
        $my_video = new MyVideo();
        return $my_video->read($data);
    }

    public function fetch($data)
    {
        $my_video = new MyVideo();
        return $my_video->fetch($data);
    }

    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $new_video = new MyVideo();

        $new_video->id = null;
        $new_video->user_id = $session->actual_user_id;
        $new_video->title = $d['video_title'];
        $new_video->src = $d['src'];
        $new_video->rating = 0;
        $new_video->created_at = "CURRENT_TIMESTAMP";
        $new_video->updated_at = "CURRENT_TIMESTAMP";

        //
        return $new_video->create();
    }

    public function update($data)
    {
        //
        return MyVideo::update($data);
    }

    public function delete($data)
    {
        //
        return MyVideo::delete($data);
    }
}