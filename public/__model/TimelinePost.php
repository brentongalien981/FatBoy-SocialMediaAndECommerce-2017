<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-20
 * Time: 19:57
 */

namespace App\Publico\Model;


class TimelinePost
{
    protected static $table_name = "TimelinePosts";
    protected static $db_fields = array("id", "owner_user_id", "poster_user_id",/*"date_posted",*/ "message");
    public $id;
    public $owner_user_id;
    public $poster_user_id;
//    public $date_posted;
    public $message;

    public static function get_query_for_fetch($data)
    {
        $d = $data;
        global $session;

        $query = "SELECT * ";
        $query .= "FROM TimelinePosts ";
        $query .= "INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
        $query .= "INNER JOIN Profile ON TimelinePosts.poster_user_id = Profile.user_id ";
        $query .= "WHERE owner_user_id = {$session->currently_viewed_user_id} ";
        $query .= "AND date_posted > '{$d['latest_timeline_post_date']}'";



        return $query;
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

    public static function get_query_for_read()
    {
        $limit = 10;
        global $session;

        $query = "SELECT * ";
        $query .= "FROM TimelinePosts ";
        $query .= "INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
        $query .= "INNER JOIN Profile ON TimelinePosts.poster_user_id = Profile.user_id ";
        $query .= "WHERE owner_user_id = {$session->currently_viewed_user_id} ";
        $query .= "ORDER BY date_posted DESC ";
        $query .= "LIMIT {$limit}";


        return $query;
    }

    public static function fetch($data)
    {

        $d = $data;
        $query = self::get_query_for_fetch($d);

        $result_set = self::read_by_query($query);

        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "post_id" => $row['id'],
                "date_posted" => $row['date_posted'],
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "pic_url" => $row['pic_url'],
                "message" => $row['message']
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
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

    public static function read()
    {

        $query = self::get_query_for_read();

        $result_set = self::read_by_query($query);

        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "post_id" => $row['id'],
                "date_posted" => $row['date_posted'],
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "pic_url" => $row['pic_url'],
                "message" => $row['message']
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

}