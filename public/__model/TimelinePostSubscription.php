<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-24
 * Time: 00:17
 */

namespace App\Publico\Model;


class TimelinePostSubscription
{
    protected static $table_name = "TimelinePostUserSubscription";
    protected static $db_fields = array("timeline_post_id", "subscriber_user_id");
    public $timeline_post_id;
    public $subscriber_user_id;
//    public $date_posted;

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

    public function create()
    {
        global $database;
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

//            // * Optional depending on the db.
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

    public static function read($data) {


        $query = self::get_query_for_read($data);

        $result_set = self::read_by_query($query);

        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "subscriber_user_id" => $row["subscriber_user_id"]
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

    public static function get_query_for_read($data)
    {
        $d = $data;
        $limit = 10;
        global $session;

        $query = "SELECT * ";
        $query .= "FROM " . self::$table_name . " ";
        $query .= "WHERE timeline_post_id = {$d['timeline_post_id']}";


        return $query;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }
}