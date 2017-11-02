<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 02:58
 */

namespace App\Publico\Controller\Session;

require_once("../MainController.php");
//require_once(PUBLIC_PATH . "/__model/Session.php");




use App\Publico\Controller\MainController;
//use Sesion;

class SessionController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update($data)
    {
        /* Vars. */
        $d = $data;
        global $session;

        /* Which variables to update? */
        if (isset($d["cart_id"])) { $session->set_cart_id($d["cart_id"]); }
        if (isset($d["something_else"])) { $session->set_cart_xx($d["something_else"]); }


        //
        return true;



    }
}