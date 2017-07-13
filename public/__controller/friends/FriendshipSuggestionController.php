<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-13
 * Time: 17:04
 */

namespace App\Publico\Controller\Friends;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/FriendshipSuggestion.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\FriendshipSuggestion;


class FriendshipSuggestionController extends MainController
{
    public function __construct() {
        parent::__construct();
    }


    public function read($data) {
        $section = $data['section'];
        $suggested_friends =  FriendshipSuggestion::read_by_section($section);
        return $suggested_friends;
    }

}