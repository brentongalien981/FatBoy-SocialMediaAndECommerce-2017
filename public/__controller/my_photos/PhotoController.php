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
require_once(PUBLIC_PATH . "/__controller/my_photos/PhotoHelper.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/PhotoValidator.php");


use App\Privado\HelperClasses\Validation\PhotoValidator;
use App\Publico\Controller\MainController;
use App\Publico\Model\Photo;
use App\Publico\Controller\MyPhotos\PhotoHelper;


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


//        $new_photo->embed_code = $d['embed_code'];
//        $new_photo->href = PhotoHelper::get_attribute_value($d['embed_code'], "href");
//        $new_photo->src = PhotoHelper::get_attribute_value($d['embed_code'], "src");
//        $new_photo->width = PhotoHelper::get_attribute_value($d['embed_code'], "width");
//        $new_photo->height = PhotoHelper::get_attribute_value($d['embed_code'], "height");


        // Check if there was an invalid attribute value in the embed_code.
        if (!$new_photo->href) { return false; }
        if (!$new_photo->src) { return false; }
        if (!$new_photo->width) { return false; }
        if (!$new_photo->height) { return false; }


        /*
         * <a data-flickr-embed="true"  href="https://www.flickr.com/photos/151625521@N05/36597937226/in/dateposted-public/" title="jet1">
         * <img src="https://farm5.staticflickr.com/4370/36597937226_e64d44568d_o.jpg"
         * width="1920" height="1080" alt="jet1"></a>
         */

        // Extra validations.
        if (!PhotoHelper::has_prefix("https://farm5.staticflickr.com/", $new_photo->src)) { return false; }
        if (!PhotoHelper::has_prefix("https://www.flickr.com/photos/", $new_photo->href)) { return false; }
        if (!PhotoHelper::is_uniformly_numeric($new_photo->width)) { return false; }
        if (!PhotoHelper::is_uniformly_numeric($new_photo->height)) { return false; }

        //uki
//        $new_photo->embed_code = PhotoHelper::get_shit();
//        echo PhotoHelper::get_shit();


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


//        $new_photo->embed_code = $d['embed_code'];
        $new_photo->href = PhotoHelper::get_attribute_value($d['edit_embed_code'], "href");
        $new_photo->src = PhotoHelper::get_attribute_value($d['edit_embed_code'], "src");
        $new_photo->width = PhotoHelper::get_attribute_value($d['edit_embed_code'], "width");
        $new_photo->height = PhotoHelper::get_attribute_value($d['edit_embed_code'], "height");


        // Check if there was an invalid attribute value in the embed_code.
        if (!$new_photo->href) { return false; }
        if (!$new_photo->src) { return false; }
        if (!$new_photo->width) { return false; }
        if (!$new_photo->height) { return false; }



        //uki
//        $new_photo->embed_code = PhotoHelper::get_shit();
//        echo PhotoHelper::get_shit();


        //
        return $new_photo->update();
    }

    public function delete($data)
    {

        //
        return Photo::delete($data);
    }
}