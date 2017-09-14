<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-13
 * Time: 12:54
 */

namespace App\Publico\Controller\ChatList;

require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/ChatList.php");

use App\Publico\Controller\MainController;
use App\Publico\Model\ChatList;

class ChatListController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function read($data)
    {
        return ChatList::read($data);
    }

    public function manage_thread($data) {
        $friend_id = $data["user_id"];
        global $session;

        // Check if there's already an existing chat thread for the 2 users.
        if (ChatList::does_chat_thread_exist($friend_id)) {

            // Get the thread id.
            $session->set_chat_thread_id(ChatList::get_existing_chat_thread($friend_id));
            return true;
        }
        else {
            //
            ChatList::create_new_chat_thread($friend_id);
            return true;
        }

        return false;
    }
}