<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-16
 * Time: 18:32
 */

namespace App\Publico\Controller\AppSettings;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/AppSetting.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\AppSetting;


class AppSettingController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update($data) {
        //
        return AppSetting::update($data);
    }

    public static function read() {
        return AppSetting::read();
    }
}