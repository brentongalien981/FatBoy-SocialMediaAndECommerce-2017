<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-14
 * Time: 16:19
 */

namespace App\Publico\Controller\ChatMessage;


require_once("../MainController.php");
require_once(PUBLIC_PATH . "/__model/ChatMessage.php");


use App\Publico\Controller\MainController;
use App\Publico\Model\ChatMessage;


class ChatMessageController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        //
        $d = $data;
        global $session;

        //
        $new_chat_msg = new ChatMessage();
        $new_chat_msg->id = null;
        $new_chat_msg->chat_thread_id = $session->chat_thread_id;
        $new_chat_msg->chatter_user_id = $session->actual_user_id;
        $new_chat_msg->message = $d["message"];

        return $new_chat_msg->create();
    }

    public function read()
    {
        //
//        $d = $data;
//        global $session;
//
//        //
//        $new_chat_msg = new ChatMessage();
//        $new_chat_msg->chat_thread_id = $session->chat_thread_id;

        return ChatMessage::read();
    }
}