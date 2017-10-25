<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-24
 * Time: 22:32
 */

//namespace App\Publico\Model;

//require_once("my_database.php");
require_once("Notification.php");

//use App\Publico\Model\Notification;


class NotificationTimelinePostReply extends Notification
{
    protected static $table_name = "NotificationsTimelinePostReply";
    protected static $db_fields = array("notification_id", "timeline_post_reply_id");
    private static $uninherited_db_fields = array("notification_id", "timeline_post_reply_id");
    public $notification_id;
    public $timeline_post_reply_id;

    public function __construct()
    {
        self::$db_fields = array_merge(parent::$db_fields, self::$uninherited_db_fields);
    }

    private function get_sanitized_uninherited_attributes()
    {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_uninherited_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    private function get_uninherited_attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$uninherited_db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function create_parent_obj() {
        $parent_notification = new Notification();
        $parent_notification->id = $this->id;
        $parent_notification->notified_user_id = $this->notified_user_id;
        $parent_notification->notifier_user_id = $this->notifier_user_id;
        $parent_notification->notification_msg_id = $this->notification_msg_id; // 2 is {NotifierUserName} wants to follow you.
        $parent_notification->is_deleted = $this->is_deleted;


        $is_creation_ok = $parent_notification->create_with_bool();

        if ($is_creation_ok) {
            $this->id = $parent_notification->id;
            $this->notification_id = $this->id;
        }


        return $is_creation_ok;
    }

    public function create() {
        if (!$this->create_parent_obj()) {
            return false;
        }


        //
        global $database;

        $attributes = $this->get_sanitized_uninherited_attributes();


        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";



        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("QUERY2: {$query}");
//        $json_errors_array['query1'] = $query;



        // Start the transaction.
        if (!$database->start_transaction()) { return false; }


        // Execute the INSERT query.
        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
//            $this->id = $database->get_last_inserted_id();
            //
            if (!$database->commit()) { return false; }
            return true;
        } else {
            //
            if (!$database->rollback()) { return false; }
            return false;
        }
    }
}