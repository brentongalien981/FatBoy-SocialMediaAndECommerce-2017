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

    public function __construct() {
        self::$db_fields = array_merge(parent::$db_fields, self::$uninherited_db_fields);
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
}