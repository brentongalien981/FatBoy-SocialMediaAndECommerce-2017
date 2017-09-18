<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-16
 * Time: 19:02
 */

namespace App\Publico\Model;


class AppSetting
{
    public static function read() {
        $app_settings = array();

        //
        if (isset($_SESSION["notifications_is_maximized"])) {
            $app_settings["notifications_is_maximized"] = $_SESSION["notifications_is_maximized"];
        } else {
            $app_settings["notifications_is_maximized"] = false;
        }

        //
        if (isset($_SESSION["chat_list_is_maximized"])) {
            $app_settings["chat_list_is_maximized"] = $_SESSION["chat_list_is_maximized"];
        } else {
            $app_settings["chat_list_is_maximized"] = false;
        }

        //
        if (isset($_SESSION["chat_pod_is_maximized"])) {
            $app_settings["chat_pod_is_maximized"] = $_SESSION["chat_pod_is_maximized"];
        } else {
            $app_settings["chat_pod_is_maximized"] = false;
        }

        //
        return $app_settings;
    }

    public static function update($data) {

        global $session;
        $d = $data;


        $_SESSION["notifications_is_maximized"] = $d["notifications_is_maximized"];

        $_SESSION["chat_list_is_maximized"] = $d["chat_list_is_maximized"];

        $_SESSION["chat_pod_is_maximized"] = $d["chat_pod_is_maximized"];


        return true;

    }
}