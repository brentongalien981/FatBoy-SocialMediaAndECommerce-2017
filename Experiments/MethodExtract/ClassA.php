<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-26
 * Time: 01:02
 */

namespace MethodExtract;

class ClassA
{
    protected static $db_fields = array();
    protected static $table_name = "butikis";



    /**
     * ClassA constructor.
     */
    public function __construct()
    {

//        self::createProperties();
        $this->createProperties();

    }

    private function createProperties() {
        foreach (self::$db_fields as $property) {
            $this->$property = null;
        }
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

//    public function showAttributesExistence() {
//        echo "******************************<br>";
//        echo "In method showAttributesExistence()<br>";
//        foreach (self::$properties as $property) {
//            if (property_exists($this, $property)) {
//                echo "Property $property exists? ==> true with value ==> {$this->$property}<br>";
//            }
//        }
//    }

    public function create() {
//        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

//        $attributes = $this->get_sanitized_attributes();
        $attributes = $this->get_attributes();

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        return $query;

//        $query_result = $database->get_result_from_query($query);
//
//        if ($query_result) {
//            $this->id = $database->get_last_inserted_id();
//            return true;
//        } else {
//            return false;
//        }
    }



//    protected function


}
