<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-05
 * Time: 01:05
 */

namespace App\Publico\Controller\Profile;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/Profile.php");
require_once(PRIVATE_PATH . "/helper_classes/validation/Validator.php");


use App\Privado\HelperClasses\Validation\Validator;
use App\Publico\Controller\MainController;
use App\Publico\Model\Profile;

class ProfileController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        $profile = new Profile();
        return $profile->read($data);
    }
}