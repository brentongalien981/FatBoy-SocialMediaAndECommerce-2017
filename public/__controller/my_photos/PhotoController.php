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
//require_once(PUBLIC_PATH . "/__controller/my_photos/PhotoHelper.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/PhotoValidator.php");


use App\Privado\HelperClasses\Validation\PhotoValidator;
use App\Publico\Controller\MainController;
use App\Publico\Model\Photo;
//use App\Publico\Controller\MyPhotos\PhotoHelper;


class PhotoController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new PhotoValidator();
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

        $new_photo->href = $d['href'];
        $new_photo->src = $d['src'];
        $new_photo->width = $d['width'];
        $new_photo->height = $d['height'];

        //
        return $new_photo->create();
    }

    public function update($data)
    {
        //
        $d = $data;
        global $session;

        //
        $new_photo = new Photo();
        $new_photo->id = $d['edit_photo_id'];
        $new_photo->user_id = $session->actual_user_id;
        $new_photo->title = $d['edit_photo_title'];

        $new_photo->href = $d['edit_href'];
        $new_photo->src = $d['edit_src'];
        $new_photo->width = $d['edit_width'];
        $new_photo->height = $d['edit_height'];


        //
        return $new_photo->update();
    }

    public function delete($data)
    {

        //
        return Photo::delete($data);
    }
}