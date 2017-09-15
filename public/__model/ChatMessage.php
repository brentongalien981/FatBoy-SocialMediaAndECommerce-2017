<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-14
 * Time: 16:24
 */

namespace App\Publico\Model;


class ChatMessage
{
    protected static $table_name = "ChatMessage";
//    public static $searchable_fields = array("");
    protected static $db_fields = array("id", "chat_thread_id", "chatter_user_id", "message");
    public $id;
    public $chat_thread_id;
    public $chatter_user_id;
    public $message;

    protected function get_sanitized_attributes()
    {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    protected function get_attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public function create()
    {
        global $database;
        $attributes = $this->get_sanitized_attributes();

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        // Start transaction.
        if (!$database->start_transaction()) {
            return false;
        }


        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
            //
            if (!$database->commit()) {
                return false;
            }

            //
            $this->id = $database->get_last_inserted_id();

            //
            return true;
        } else {
            //
            if (!$database->rollback()) {
                return false;
            }

            //
            return false;
        }
    }

    public static function read()
    {
        global $session;
        global $database;

        $q = "SELECT * FROM ChatMessage ";
        $q .= "WHERE chat_thread_id = {$session->chat_thread_id} ";
        $q .= "ORDER BY date_posted ASC";

        //
        $record_results = ChatMessage::read_by_query($q);

        $array_of_objs = array();

        while ($row = $database->fetch_array($record_results)) {

            // If the chat_msg is new..
            if ($row["is_new"] == 1) {
                // ..check if it hasn't been seen by the user.
                $current_chat_msg_id = $row["id"];

                $is_log_creation_ok = null;

                if (!self::has_user_seen_chat_msg($current_chat_msg_id)) {
                    $is_log_creation_ok = self::create_chat_msg_seen_log_record($current_chat_msg_id);

                    // If there's an error, disregard everything.
                    if (!$is_log_creation_ok) {
                        return false;
                    }
                }

                //
                if (self::has_chat_msg_seen_by_all($current_chat_msg_id)) {
                    $is_update_ok = self::set_chat_msg_old($current_chat_msg_id);

                    // Error? Then quit..
                    if (!$is_update_ok) {
                        return false;
                    }
                }
            }

            //
            $an_obj = array(
                "chatter_user_id" => $row['chatter_user_id'],
                "date_posted" => $row['date_posted'],
                "message" => $row['message']
            );

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

    public static function create_chat_msg_seen_log_record($chat_msg_id)
    {
        global $session;
        $query = "INSERT INTO ChatMsgSeenLog ";
        $query .= "VALUES ({$chat_msg_id}, {$session->actual_user_id})";

        $is_creation_ok = ChatMessage::create_by_query($query);

        return $is_creation_ok;
    }

    public static function create_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        if ($database->get_num_of_affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function has_user_seen_chat_msg($current_chat_msg_id)
    {
        global $session;
        $query = "SELECT * FROM ChatMessage ";
        $query .= "INNER JOIN ChatMsgSeenLog ";
        $query .= "ON ChatMessage.id = ChatMsgSeenLog.chat_msg_id ";
        $query .= "WHERE ChatMessage.id = {$current_chat_msg_id} ";
        $query .= "AND ChatMsgSeenLog.seen_by_user_id = {$session->actual_user_id} ";

        $record_results = ChatMessage::read_by_query($query);

        global $database;
        $num_of_results = $database->get_num_rows_of_result_set($record_results);

        if ($num_of_results == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function has_chat_msg_seen_by_all($chat_msg_id)
    {
        global $session;
        $query = "SELECT * FROM ChatMsgSeenLog ";
        $query .= "WHERE chat_msg_id = {$chat_msg_id}";

        $record_results = ChatMessage::read_by_query($query);

        global $database;
        $num_of_results = $database->get_num_rows_of_result_set($record_results);

        // TODO: REMINDER: Set this to a variable number that changes depending
        // on the number of chatters involved. For now it's just between 2 chatters,
        // but in the future, update it so that it involves more than 2 chatters.
        $max_num_of_chatters_involved = 2;

        if ($num_of_results == $max_num_of_chatters_involved) {
            return true;
        } else {
            return false;
        }
    }

    public static function set_chat_msg_old($id)
    {

        $query = "UPDATE ChatMessage ";
        $query .= "SET is_new = 0 ";
        $query .= "WHERE id = {$id}";

        $is_update_ok = ChatMessage::update_by_query($query);

        return $is_update_ok;
    }

    public static function update_by_query($query = "")
    {
        global $database;

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

}