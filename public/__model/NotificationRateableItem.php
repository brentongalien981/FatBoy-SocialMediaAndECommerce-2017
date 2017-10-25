<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-09
 * Time: 09:00
 */

//namespace App\Publico\Model;

require_once("my_database.php");
require_once("Notification.php");

//require_once(PRIVATE_PATH . "/includes/Carbon.php");
//use App\Privado\Includes\Carbon;


//use App\Privado\Includes\Carbon;


class NotificationRateableItem extends Notification
{
    protected static $table_name = "NotificationsRateableItem";
    protected static $db_fields = array("notification_id", "rateable_item_id", "rate_value");
    private static $uninherited_db_fields = array("notification_id", "rateable_item_id", "rate_value");
    public $notification_id;
    public $rateable_item_id;
    public $rate_value;

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

    public static function does_record_exist($rateable_item_id) {
        global $database;
        global $session;

        $q = "SELECT n.notified_user_id, n.notifier_user_id,";
        $q .= " nri.*,";
        $q .= " riu.date_updated";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsRateableItem nri ON n.id = nri.notification_id";
        $q .= " INNER JOIN RateableItemsUsers riu ON (n.notifier_user_id, nri.rateable_item_id) = (riu.responder_user_id, riu.rateable_item_id)";
        $q .= " WHERE notifier_user_id = {$session->actual_user_id}";
        $q .= " AND " . "nri.rateable_item_id = {$rateable_item_id}";

        $result_set = $database->get_result_from_query($q);

        $num_of_records = $database->get_num_rows_of_result_set($result_set);

        if ($num_of_records > 0) { return true; }
        return false;
    }

    public function create_with_bool()
    {
        // Check
        $does_record_exist = self::does_record_exist($this->rateable_item_id);
        if ($does_record_exist) { return $this->update(); }

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
        //

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";


//        // TODO:DEBUG
//        MyDebugMessenger::add_debug_message("QUERY2: {$query}");
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

    private function get_existing_record_id() {
        global $database;
        global $session;

        $q = "SELECT * FROM " . parent::$table_name;
        $q .= " INNER JOIN " . self::$table_name;
        $q .= " ON " . parent::$table_name . ".id =";
        $q .= " " . self::$table_name . ".notification_id";

        $q .= " WHERE notifier_user_id = {$session->actual_user_id}";
        $q .= " AND " . "rateable_item_id = {$this->rateable_item_id}";

        $result_set = $database->get_result_from_query($q);

        while ($row = $database->fetch_array($result_set)) {
            return $row["id"];
        }
    }

    private function update()
    {
        // Check if there's already a similar notification from another user.
        $this->id = $this->get_existing_record_id();

        // Update first the parent obj.
        $this->update_parent_obj();

        /* Update the child obj. */
        global $database;
        //uki2
        //
        $this->notification_id = $this->id;
        $attributes = $this->get_sanitized_uninherited_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . self::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);


        $query .= " WHERE rateable_item_id = {$this->rateable_item_id}";
        $query .= " AND notification_id = {$this->notification_id}";


        // Start transaction.
        if (!$database->start_transaction()) {
            return false;
        }

        $database->get_result_from_query($query);

        //
        $is_update_ok = ($database->get_num_of_affected_rows() == 1) ? true : false;


        //
        if ($is_update_ok) {
            //
            if (!$database->commit()) {
                return false;
            }

            //
            return true;
        } else {
            //
            $database->rollback();

            //
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

        $query = "SELECT COUNT(*) AS count FROM " . parent::$table_name;
        $query .= " INNER JOIN " . self::$table_name;
        $query .= " ON " . parent::$table_name . ".id = " . self::$table_name . ".notification_id";
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
        $query = self::get_query_for_read_by_offset($d);

        $result_set = self::read_by_query($query);

        //
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notifier_user_name" => $row['user_name'],
                "notification_msg_id" => $row['notification_msg_id'],
                "post_id" => $row['post_id'],
                "message" => $row['message'],
                "rate_tag" => $row['name'],
                "date_updated" => $row['initiation_date'],
                "human_date" => self::get_my_carbon_date($row['initiation_date']));




            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }

    public static function fetch($data)
    {

        $d = $data;
        $query = self::get_query_for_fetch($d);

        $result_set = self::read_by_query($query);

        //
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notifier_user_name" => $row['user_name'],
                "notification_msg_id" => $row['notification_msg_id'],
                "post_id" => $row['post_id'],
                "message" => $row['message'],
                "rate_tag" => $row['name'],
                "date_updated" => $row['initiation_date'],
                "human_date" => parent::get_my_carbon_date($row['initiation_date']));




            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }



    public static function get_query_for_read_by_offset($data)
    {
        // TODO:REMINDER: Only select the necessary columns.

        $d = $data;
        $limit = 10;
        $is_request_fetch = false;
        global $session;

        if (isset($d["fetch"]) && $d["fetch"] == "yes") {
            $limit = 1;
            $is_request_fetch = true;
        }

        $q = "SELECT n.*,";
        $q .= " nri.*,";
        $q .= " u.user_name,";
        $q .= " r.name,";
        $q .= " tp.id AS post_id, tp.message";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsRateableItem nri ON n.id = nri.notification_id";
        $q .= " INNER JOIN Users u ON n.notifier_user_id = u.user_id";
        $q .= " INNER JOIN Rates r ON nri.rate_value = r.value";
        $q .= " INNER JOIN RateableItems ri ON nri.rateable_item_id = ri.id";
        $q .= " INNER JOIN TimelinePosts tp ON ri.item_x_id = tp.id";
        $q .= " WHERE n.notified_user_id = {$session->actual_user_id}";
        $q .= " AND n.notification_msg_id = 4";
        $q .= " AND n.is_deleted = 0";

        if ($is_request_fetch) {
            $q .= " ORDER BY n.initiation_date ASC";
        }
        else {
            $q .= " ORDER BY n.initiation_date DESC";
        }

        $q .= " LIMIT {$limit} OFFSET {$d['offset']}";

        return $q;
    }

    public static function get_query_for_fetch($data)
    {
        // TODO:REMINDER: Only select the necessary columns.

        $d = $data;
        $limit = 2;
        global $session;

        $q = "SELECT n.*,";
        $q .= " nri.*,";
        $q .= " u.user_name,";
        $q .= " r.name,";
        $q .= " tp.id AS post_id, tp.message";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsRateableItem nri ON n.id = nri.notification_id";
        $q .= " INNER JOIN Users u ON n.notifier_user_id = u.user_id";
        $q .= " INNER JOIN Rates r ON nri.rate_value = r.value";
        $q .= " INNER JOIN RateableItems ri ON nri.rateable_item_id = ri.id";
        $q .= " INNER JOIN TimelinePosts tp ON ri.item_x_id = tp.id";
        $q .= " WHERE n.notified_user_id = {$session->actual_user_id}";
        $q .= " AND n.notification_msg_id = 4";
        $q .= " AND n.is_deleted = 0";
        $q .= " AND n.initiation_date > '{$d['latest_notification_date']}'";
        $q .= " ORDER BY n.initiation_date ASC";
        $q .= " LIMIT {$limit}";

        return $q;
    }

    public static function delete($id = 0) {

        global $database;

        $query = "DELETE FROM " . self::$table_name;
        $query .= " WHERE notification_id = " . $database->escape_value($id);
        $query .= " LIMIT 1";


        $database->get_result_from_query($query);
        $is_deletion_ok = ($database->get_num_of_affected_rows() == 1) ? true : false;

        if ($is_deletion_ok) {
            $is_deletion_ok = parent::delete($id);
        }

        return $is_deletion_ok;
    }
}