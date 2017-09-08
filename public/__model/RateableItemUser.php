<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-09-03
 * Time: 16:40
 */

namespace App\Publico\Model;


class RateableItemUser
{
    protected static $table_name = "RateableItemsUsers";
    protected static $db_fields = array("rateable_item_id", "responder_user_id", "rate_value");
//    public static $searchable_fields = array("title");
    public $rateable_item_id;
    public $responder_user_id;
    public $rate_value;
//    public $date_updated;

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

//            //
//            $this->id = $database->get_last_inserted_id();

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

    public function update()
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
        $query .= ", date_updated = NOW()";

        $query .= " WHERE rateable_item_id = {$this->rateable_item_id}";
        $query .= " AND responder_user_id = {$this->responder_user_id}";


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

    public static function does_record_exist($rateable_item_id) {
        global $database;
        global $session;

        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE rateable_item_id = {$rateable_item_id}";
        $query .= " AND responder_user_id = {$session->actual_user_id}";

        $result_set = $database->get_result_from_query($query);
        $num_of_records = $database->get_num_rows_of_result_set($result_set);

        if ($num_of_records > 0) { return true; }
        return false;
    }


    public static function get_query_for_read_x_data($data)
    {

        global $session;
        $d = $data;
        $q = "";

        switch ($d["to_read"]) {
            case "rate_tags":
                //
                $q .= "SELECT * FROM " . self::$table_name;
                $q .= " WHERE responder_user_id = {$session->actual_user_id}";
                $q .= " AND rateable_item_id IN (";
//        $q .= join(", ", array_keys($d['item_x_id']));
                $q .= "{$d['rateable_item_ids']}";
                $q .= ")";
                break;
            case "rate_sigma":

                $q .= "SELECT rateable_item_id, COUNT(*) AS 'count'";
                $q .= " FROM " . self::$table_name;
                $q .= " WHERE rateable_item_id IN (";
                $q .= "{$d['rateable_item_ids']}";
                $q .= ")";
                $q .= " GROUP BY rateable_item_id";
                break;
            case "rate_value_sigma":

                $q .= "SELECT rateable_item_id, COUNT(*) AS 'count', SUM(rate_value) AS 'rate_value_sum'";
                $q .= " FROM " . self::$table_name;
                $q .= " WHERE rateable_item_id IN (";
                $q .= "{$d['rateable_item_ids']}";
                $q .= ")";
                $q .= " GROUP BY rateable_item_id";

                break;
        }
        

        return $q;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public static function read($data)
    {
        //uki
        $query = self::get_query_for_read_x_data($data);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_things = array();

        global $database;
        $d = $data;

        while ($row = $database->fetch_array($result_set)) {
            //
            $a_thing = null;

            switch ($d["to_read"]) {
                case "rate_tags":

                    $a_thing = array(
                        "rateable_item_id" => $row['rateable_item_id'],
                        "responder_user_id" => $row['responder_user_id'],
                        "rate_value" => $row['rate_value']
                    );

                    break;
                case "rate_sigma":

                    $a_thing = array(
                        "rateable_item_id" => $row['rateable_item_id'],
                        "count" => $row['count']
                    );

                    break;
                case "rate_value_sigma":

                    $a_thing = array(
                        "rateable_item_id" => $row['rateable_item_id'],
                        "count" => $row['count'],
                        "rate_value_sum" => $row['rate_value_sum']
                    );

                    break;
            }


            //
            array_push($array_of_things, $a_thing);
        }

        return $array_of_things;
    }
}