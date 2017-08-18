<?php
/**
 * Created by PhpStorm.
 * Photo: ops
 * Date: 2017-08-17
 * Time: 20:08
 */

namespace App\Publico\Controller\MyPhotos;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/Photo.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\Photo;


class PhotoController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
//        return array("shit" => "butom");
//        return Photo::read_with_offset($data['offset']);
        return Photo::read($data);
    }


    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $new_photo = new Photo();

        $new_photo->user_id = $session->actual_user_id;

        $new_photo->title = $d['photo_title'];


        $new_photo->embed_code = $d['embed_code'];


        //
        return $new_photo->create();
    }
}