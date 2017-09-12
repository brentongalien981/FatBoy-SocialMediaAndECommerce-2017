<?php


// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once("my_database.php");

use Carbon\Carbon;

class Notification {

    protected static $table_name = "Notifications";
    protected static $db_fields = array("id", "notified_user_id", "notifier_user_id", "notification_msg_id", "is_deleted");
    public $id;
    public $notified_user_id;
    public $notifier_user_id;
    public $notification_msg_id;
    public $is_deleted;

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

    protected function update_parent_obj()
    {
        global $database;
        //uki2
        $attributes = $this->get_sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . self::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);

        // Plus, add an update to the column "updated_at".
        $query .= ", initiation_date = NOW()";

        $query .= " WHERE id = {$this->id}";
        $query .= " AND notifier_user_id = {$this->notifier_user_id}";


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
        } else {
            //
            $database->rollback();

            //
            return false;
        }

    }

    public static function get_my_carbon_date($raw_datetime) {
//        $timestamp = '2014-02-06 16:34:00';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $raw_datetime, '-4');
        $date->setTimezone('UTC');

//        $dt = Carbon::parse($raw_datetime);
//        $dt->setTimezone('-5');
//        Carbon::now(-1)
        return $date->diffForHumans();
    }


    
    public static function read_all($notified_user_id) {
        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE notified_user_id = {$notified_user_id}";
        $query .= " AND is_deleted = 0";


        $objects_array = self::read_by_query_and_instantiate($query);

        return $objects_array;
    }    

    public static function read_by_query_and_instantiate($query = "") {
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

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }

    // Returns bool.
    public function create_with_bool() {
        global $database;

        //
        if (!$database->start_transaction()) { return false; }





        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        $attributes = $this->get_sanitized_attributes();

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";


        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("QUERY1: {$query}");


        // Execute the query.
        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
            $this->id = $database->get_last_inserted_id();

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

        $query = "DELETE FROM " . self::$table_name;
        $query .= " WHERE id = " . $database->escape_value($id);
        $query .= " LIMIT 1";

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}.");

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
        
//        if ($database->get_num_of_affected_rows() != 0) {
//            return true;
//        }
//        else {
//            return false;
//        }
    }
    
    
    /**
     * 
     * @global type $database
     * @param type $query
     * @return bool
     */
    protected static function delete_by_query($query) {
        global $database;
        
        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}.");

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
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