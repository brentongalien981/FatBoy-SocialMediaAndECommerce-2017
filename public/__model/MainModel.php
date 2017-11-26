<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-20
 * Time: 20:15
 */

namespace App\Publico\Model;


class MainModel
{
    protected function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }


}