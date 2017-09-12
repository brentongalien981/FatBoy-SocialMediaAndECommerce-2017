<?php


// If it's going to need the database, then it's
// probably smart to require it before we start.
require_once("my_database.php");
require_once("Notification.php");

class NotificationFriendship extends Notification {

    protected static $table_name = "NotificationsFriendship";
    protected static $db_fields = array("notification_id");
    private static $uninherited_db_fields = array("notification_id");
    public $notification_id;

    public function __construct() {
        self::$db_fields = array_merge(parent::$db_fields, self::$uninherited_db_fields);
    }

    public static function read_by_id($id = 0) {
//        $query = "SELECT * FROM " . self::$table_name . " WHERE UserId = ?";
//        $stmt = $mysqli->prepare($sql);
//
//        if (!$stmt) {
//            die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
//        }
    }

    public static function read_by_query($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        return $result_set;
    }

    public static function read_and_instantiate($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);

        $objects_array = array();

        while ($row = $database->fetch_array($result_set)) {
//            $objects_array[] = self::instantiate($row);
            array_push($objects_array, self::instantiate($row));
        }

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("METHOD: read_by_query_and_instantiate() called...");

        // This could be one or many instantiated objects.
        return $objects_array;
    }

    /**
     *
     * @param int $notified_user_id
     * @return string $query
     */
    public static function get_query_for_read_all($notified_user_id) {
        // TODO:REMINDER: Only select the necessary columns.
        $query = "SELECT * FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " INNER JOIN Users";
        $query .= " ON " . parent::$table_name . ".notifier_user_id = Users.user_id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$notified_user_id}";

//        MyDebugMessenger::add_debug_message("QUERY: {$query}");

        return $query;
    }


    public static function get_query_for_read_by_section($section, $limit) {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;
        $notified_user_id = $session->actual_user_id;
        $item_per_section = 2;


        $query = "SELECT * FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " INNER JOIN Users";
        $query .= " ON " . parent::$table_name . ".notifier_user_id = Users.user_id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$notified_user_id}";
        $query .= " ORDER BY id ASC";

        // For update_fetch: fetch only 1 notification.
        if ($limit == 1) {
            if ($section == 0) {
                $query .= " LIMIT {$limit} OFFSET 0";
            }
            else {
                $num_items_to_skip = ($section * $item_per_section) - 1;
                $query .= " LIMIT {$limit} OFFSET {$num_items_to_skip}";
            }

        }
        // For actual read: read 10 notifications.
        else {
            $num_items_to_skip = ($section - 1) * $item_per_section;
            $query .= " LIMIT {$limit} OFFSET {$num_items_to_skip}";
        }

        MyDebugMessenger::add_debug_message("QUERY: {$query}");

        return $query;
    }

    public static function get_query_for_read_by_offset($data) {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;
        $limit = 10;
        $d = $data;


        $query = "SELECT * FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " INNER JOIN Users";
        $query .= " ON " . parent::$table_name . ".notifier_user_id = Users.user_id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$session->actual_user_id}";
        $query .= " ORDER BY " . parent::$table_name . ".initiation_date DESC";
        $query .= " LIMIT {$limit} OFFSET {$d['offset']}";


        return $query;
    }

    public static function get_query_for_fetch($data)
    {
        // TODO:REMINDER: Only select the necessary columns.

        $d = $data;
        $limit = 2;
        global $session;

        $query = "SELECT * FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " INNER JOIN Users";
        $query .= " ON " . parent::$table_name . ".notifier_user_id = Users.user_id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$session->actual_user_id}";
        $query .= " AND initiation_date > '{$d['latest_notification_date']}'";
        $query .= " ORDER BY initiation_date ASC";
        $query .= " LIMIT {$limit}";


        return $query;
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
                "notification_msg_id" => $row['notification_msg_id'],
                "user_name" => $row['user_name'],
                "date_updated" => $row['initiation_date'],
                "human_date" => parent::get_my_carbon_date($row['initiation_date']));




            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }

    public static function read_all($notified_user_id) {
        $query = self::get_query_for_read_all($notified_user_id);


//        $objects_array = self::read_by_query_and_instantiate($query);
        $result_set = self::read_by_query($query);

        // Array of friendship notifications, that for every array contains
        // infos like "notification_id", "notifier_user_id", "notifier_name"...
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notification_msg_id" => $row['notification_msg_id'],
                "user_name" => $row['user_name']);
            
            
            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }



    public static function read_by_offset($data) {
//        $query = self::get_query_for_read_by_section($section, $limit);
        $query = self::get_query_for_read_by_offset($data);

//        $objects_array = self::read_by_query_and_instantiate($query);
        $result_set = self::read_by_query($query);

        // Array of friendship notifications, that for every array contains
        // infos like "notification_id", "notifier_user_id", "notifier_name"...
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notification_msg_id" => $row['notification_msg_id'],
                "user_name" => $row['user_name'],
                "date_updated" => $row['initiation_date'],
                "human_date" => parent::get_my_carbon_date($row['initiation_date']));


            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }



    // Returns bool.
    public function create_with_bool() {

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

    public static function delete($id = 0) {
        global $database;

        // 1) Delete the foreign table.
        // Delete the foreign record.
        $query = "DELETE FROM " . self::$table_name . " ";
        $query .= "WHERE notification_id = " . $database->escape_value($id) . " ";
        $query .= "LIMIT 1";


        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}.");


        // Execute the query.
        if (!$database->start_transaction()) { return false; }

        $database->get_result_from_query($query);
        $is_deletion_ok = ($database->get_num_of_affected_rows() == 1) ? true : false;
//        $is_deletion_ok = false;
//        if ($database->get_num_of_affected_rows() != 0) {
//            $is_deletion_ok = true;
//        }


        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("VAR:\$is_deletion_ok: {$is_deletion_ok}.");



        // 2) Delete the primary table.
        // Delete the primary notification record.
        if ($is_deletion_ok) {
            $is_deletion_ok = parent::delete($id);
        }



        // 3) Return result.
        if ($is_deletion_ok) {
            if (!$database->commit()) { return false; }
            return true;
        }
        else {
            if (!$database->rollback()) { return false; }
            return false;
        }

    }
    
    /**
     * 
     * @param string $query
     * @return bool
     */
    public static function delete_by_query($query) {
        return parent::delete_by_query($query);
    }

    
    

    protected function get_sanitized_attributes() {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    private function get_sanitized_uninherited_attributes() {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_uninherited_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    protected function get_attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    private function get_uninherited_attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$uninherited_db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public function to_string() {
        $object_in_string = "";

        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                echo "{$field}: $this->$field<br>";
                $object_in_string .= "{$field}: $this->$field<br>";
            }
        }

        return $object_in_string;
    }

    // This is called if you're reading the user db
    // and instantiating user objects, then displaying them.
    private static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

}

?>