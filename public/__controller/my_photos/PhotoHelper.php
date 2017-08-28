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
    public static function has_prefix($prefix, $raw)
    {
        $prefix_length = strlen($prefix);
        $raw_prefix = substr($raw, 0, $prefix_length);

        if ($raw_prefix &&
            $prefix == $raw_prefix) {
            return true;
        }

        return false;

    }

//    is_uniformly_numeric
    public static function is_uniformly_numeric($dimension)
    {
        $dimension_length = strlen($dimension);

        for ($i = 0; $i < $dimension_length; $i++) {
            $char = substr($dimension, $i, 1);
            if (!is_numeric($char)) {
                return false;
            }
        }

        return true;

    }

    /**
     * @param $s raw string
     * @param $attribute
     * @return string / bool if false
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