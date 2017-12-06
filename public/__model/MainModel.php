<?php
/**
 * NOTE: There's a problem when updating using the transaction and
 * when you're in debug mode. Because of this limitation, I Just do the
 * update with simple codes...
 */

namespace App\Publico\Model;


class MainModel
{
    protected static $db_fields = array();
    protected static $table_name = "DEFAULT_TABLE_NAME";

    protected static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public function __construct()
    {

        $this->create_properties();

    }

    protected static function init() {

        // Initialize self::$db_fields = array();

        // Initialize self::$table_name = "TableName";
    }

    private function create_properties() {
        foreach (self::$db_fields as $property) {
            $this->$property = null;
        }
    }

    protected function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
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

    public function create() {
        global $database;
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

        //
        $query = self::update_query_with_current_time_stamp($query);

        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
            $this->id = $database->get_last_inserted_id();
            return true;
        } else {
            return false;
        }
    }

    protected static function update_query_with_current_time_stamp($query) {
        return str_replace("'CURRENT_TIMESTAMP'","NOW()", $query);
    }

}