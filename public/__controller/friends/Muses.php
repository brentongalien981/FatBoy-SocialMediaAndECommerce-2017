<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-07
 * Time: 13:48
 */

namespace App\Publico\Controller\Friends;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/model_frienship.php");
require_once(PUBLIC_PATH . "/__model/NotificationFriendship.php");

use App\Publico\Controller\MainController;
use Friendship;


class Muses extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return array
     */
    public function read()
    {
        return Friendship::get_all_muses();
    }

}





// Instance
$muses = new Muses();





// AJAX Handler.
if (isset($_GET['get_all_muses']) && $_GET['get_all_muses'] == "yes") {
    // Validate
    $allowed_assoc_indexes = array("get_all_muses");
    $required_vars_length_array = array("get_all_muses" => ["min" => 2, "max" => 3]); // For value "yes".
    $muses->validator->set_request_type("get");
    $muses->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $muses->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $muses->validator->validate();
    $json_errors_array = $muses->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
        $json_errors_array['muses'] = $muses->read();
    }


    //
    echo json_encode($json_errors_array);
}