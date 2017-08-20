<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-08-19
 * Time: 22:53
 */

namespace App\Publico\Controller\MyPhotos;


class PhotoHelper
{
    public static function get_shit() {
        return "shit";
    }

    /**
     * @param $attribute
     * @return string
     */
    public static function get_attribute_value($s, $attribute)
    {

        $start_index = strpos($s, "$attribute", 0);

        /*
         * For ex:
         *      $start_offset = "href" + "=\"";
         *                    = 4 + 2
         *                    = 6
         */
        $start_offset = strlen($attribute) + 2;
        $start_index += $start_offset;

        $end_index = strpos($s, "\"", $start_index);


        $length = $end_index - $start_index;

        $attribute_value = substr($s, $start_index, $length);

//    echo "<a href='" . $sub_embed_code . "'>link</a>";
        return $attribute_value;
    }
}