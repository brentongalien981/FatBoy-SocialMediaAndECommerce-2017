<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-01
 * Time: 23:28
 */

namespace App\Publico\Model;


class RateableItem
{
    protected static $table_name = "RateableItems";
    protected static $db_fields = array("id", "item_x_id", "item_x_type_id");
//    public static $searchable_fields = array("title");
    public $id;
    public $item_x_id;
    public $item_x_type_id;

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

    public static function does_record_exist($rateable_item) {
        $d = $rateable_item;
        global $database;
//        global $session;

        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE item_x_id = {$d->item_x_id}";
        $query .= " AND item_x_type_id = {$d->item_x_type_id}";

        $result_set = $database->get_result_from_query($query);
        $num_of_records = $database->get_num_rows_of_result_set($result_set);

        if ($num_of_records > 0) { return true; }
        return false;
    }

    public function create()
    {
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

    public static function get_query_for_read_rateable_item_ids($data)
    {

        global $session;
        $d = $data;


        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE item_x_type_id = {$d['item_x_type_id']}";
        $query .= " AND item_x_id IN (";
//        $query .= join(", ", array_keys($d['item_x_id']));
        $query .= "{$d['post_ids']}";
        $query .= ")";

        return $query;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public static function read_rateable_item_ids($data)
    {
        //uki
        $query = self::get_query_for_read_rateable_item_ids($data);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_things = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_thing = array(
                "item_x_id" => $row['item_x_id'],
                "rateable_item_id" => $row['id']
            );


            //
            array_push($array_of_things, $a_thing);
        }

        return $array_of_things;
    }
}