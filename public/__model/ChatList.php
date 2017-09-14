<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-13
 * Time: 13:00
 */

namespace App\Publico\Model;


class ChatList
{

    public static function get_query_for_read($data)
    {
        //
        global $database;
        global $session;
        $d = $data;
        $limit = 20;

        $q = "SELECT * FROM Users WHERE user_id IN ( SELECT friend_id FROM Friendship WHERE user_id = {$session->actual_user_id})";

        return $q;
    }

    public static function create_new_chat_thread($friend_id) {
        global $session;
        $query = "INSERT INTO ChatThread (initiator_user_id, responder_user_id) ";
        $query .= "VALUES ({$session->actual_user_id}, {$friend_id})";

        $is_creation_ok = ChatList::create_by_query($query);


        if ($is_creation_ok) {
            //
            global $database;
            $session->set_chat_thread_id($database->get_last_inserted_id());
        }

        return $is_creation_ok;
    }

    public static function create_by_query($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        if ($database->get_num_of_affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_existing_chat_thread($friend_user_id) {
        global $session;
        $query = "SELECT * FROM ChatThread ";
        $query .= "WHERE (initiator_user_id = {$session->actual_user_id} ";
        $query .= "AND responder_user_id = {$friend_user_id}) OR (";
        $query .= "initiator_user_id = {$friend_user_id} ";
        $query .= "AND responder_user_id = {$session->actual_user_id}) LIMIT 1";


        $record_result = ChatList::read_by_query($query);

        global $database;
        while ($row = $database->fetch_array($record_result)) {
            return $row["id"];
        }
    }

    public static function does_chat_thread_exist($friend_user_id) {
        global $session;
        $query = "SELECT * FROM ChatThread ";
        $query .= "WHERE (initiator_user_id = {$session->actual_user_id} ";
        $query .= "AND responder_user_id = {$friend_user_id}) OR (";
        $query .= "initiator_user_id = {$friend_user_id} ";
        $query .= "AND responder_user_id = {$session->actual_user_id}) LIMIT 1";

//    MyDebugMessenger::add_debug_message("QUERY: {$query}");

        $record_result = ChatList::read_by_query($query);

        global $database;
        $num_of_result = $database->get_num_rows_of_result_set($record_result);

        if ($num_of_result == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public static function read($data)
    {
        //
        $query = self::get_query_for_read($data);
        $result_set = self::read_by_query($query);

        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $an_obj = array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "profile_pic_src" => b_get_profile_pic_src($row['user_id'])
            );


            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }
}