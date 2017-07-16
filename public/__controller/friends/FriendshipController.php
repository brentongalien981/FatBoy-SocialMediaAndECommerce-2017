<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-15
 * Time: 21:40
 */

namespace App\Publico\Controller\Friends;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/Friendship.php");
require_once(PUBLIC_PATH . "/__controller/notifications/NotificationFriendshipController.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\Friendship;
use App\Publico\Controller\Notifications\NotificationFriendshipController;


class FriendshipController extends MainController
{
    public function __construct() {
        parent::__construct();
    }



    public function create($data) {
        //
        global $session;

        $friendship = new Friendship();
        $friendship->user_id = $session->actual_user_id;
        $friendship->friend_id = $data["friend_id"];


        global $database;

        // Start a db TRANSACTION.
        if (!$database->start_transaction()) { return false; }

        // Create a friendship record.
        $is_creation_ok = $friendship->create_with_bool();

        // Create a friendship notification record.
        if ($is_creation_ok) { $is_creation_ok = (new NotificationFriendshipController())->create($data); }


        // COMMIT or ROLLBAck the db.
        if ($is_creation_ok) {
            if (!$database->commit()) { return false; }
        }
        else {
            if (!$database->rollback()) { return false; }

        }

        //
        return $is_creation_ok;
    }
}