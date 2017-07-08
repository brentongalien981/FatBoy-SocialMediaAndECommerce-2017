<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-07
 * Time: 13:49
 */

namespace App\Publico\Controller;

require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");
require_once(PUBLIC_PATH . "/__model/session.php");

use App\Privado\HelperClasses\Validation\Validator;


class MainController
{
    public $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }
}