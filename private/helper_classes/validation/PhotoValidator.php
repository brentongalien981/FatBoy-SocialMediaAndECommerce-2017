<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-08-28
 * Time: 11:21
 */

namespace App\Privado\HelperClasses\Validation;


class PhotoValidator extends Validator
{
    public $photo_validator_shit = "PHOTO VALIDATOR IS LEGIT!";
    private $href = null;
    private $src = null;
    private $width = null;
    private $height = null;

    function __construct()
    {
        parent::__construct();
    }


    /**
     *         $new_photo->href = PhotoHelper::get_attribute_value($d['embed_code'], "href");
    $new_photo->src = PhotoHelper::get_attribute_value($d['embed_code'], "src");
    $new_photo->width = PhotoHelper::get_attribute_value($d['embed_code'], "width");
    $new_photo->height = PhotoHelper::get_attribute_value($d['embed_code'], "height");
     */

}