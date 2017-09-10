<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-07
 * Time: 14:33
 */

//namespace App\Publico\Model;

require_once("Notification.php");


class NotificationPost extends Notification
{
    protected static $table_name = "NotificationsPost";
    protected static $db_fields = array("notification_id", "post_id");
    private static $uninherited_db_fields = array("notification_id", "post_id");
    public $notification_id;
    public $post_id;

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

    public function create_with_bool()
    {

        // Create the parent record first, the Notification.
        if (!$this->create_parent_obj()) {
            return false;
        }


        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        $attributes = $this->get_sanitized_uninherited_attributes();
        //uki

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";


        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("QUERY2: {$query}");
//        $json_errors_array['query1'] = $query;


        // Start the transaction.
        if (!$database->start_transaction()) {
            return false;
        }


        // Execute the INSERT query.
        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
//            $this->id = $database->get_last_inserted_id();
            //
            if (!$database->commit()) {
                return false;
            }
            return true;
        } else {
            //
            if (!$database->rollback()) {
                return false;
            }
            return false;
        }
    }

    /**
     * @return mixed
     */
    public static function get_notification_count()
    {
        global $session;
        global $database;

        $query = "SELECT COUNT(*) AS 'count' FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " INNER JOIN Users";
        $query .= " ON " . parent::$table_name . ".notifier_user_id = Users.user_id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$session->actual_user_id}";

        MyDebugMessenger::add_debug_message("QUERY: {$query}");

        $result_set = $database->get_result_from_query($query);
        while ($row = $database->fetch_array($result_set)) {
            return $row["count"];
        }

    }

    public static function read_by_offset($data)
    {

        $d = $data;
        $query = self::get_query_for_read_by_offset($d["offset"]);

        $result_set = self::read_by_query($query);

        //
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['responder_user_id'],
                "notifier_user_name" => $row['user_name'],
                "notification_msg_id" => $row['notification_msg_id'],
                "post_id" => $row['post_id'],
                "message" => $row['message'],
                "rate_tag" => $row['rate_tag'],
                "date_updated" => $row['date_updated']);


            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }

    public static function get_query_for_read_by_offset($offset, $limit = 10)
    {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;

        $q = "";
        $q .= "SELECT tp.*,";
        $q .= " ri.id AS rateable_item_id, ri.item_x_type_id,";
        $q .= " riu.responder_user_id, riu.rate_value, riu.date_updated,";
        $q .= " u.user_name,";
        $q .= " r.name";
        $q .= " FROM TimelinePosts tp";
        $q .= " INNER JOIN RateableItems ri ON tp.id = ri.item_x_id";
        $q .= " INNER JOIN RateableItemsUsers riu ON ri.id = riu.rateable_item_id";
        $q .= " INNER JOIN Users u ON riu.responder_user_id = u.user_id";
        $q .= " INNER JOIN rates r ON riu.rate_value = r.value";
        $q .= "";

        $q .= " WHERE tp.owner_user_id = {$session->actual_user_id}";
        $q .= " AND ri.item_x_type_id = 1"; // A post item. Not photo etc..
        $q .= " AND n.is_deleted = 0";
        $q .= " AND n.notification_msg_id = 4";
        $q .= " ORDER BY riu.date_updated ASC";
        $q .= " LIMIT {$limit} OFFSET {$offset}";

        MyDebugMessenger::add_debug_message("************************");
        MyDebugMessenger::add_debug_message("QUERY: {$q}");
        MyDebugMessenger::add_debug_message("************************");


        return $q;
    }


}