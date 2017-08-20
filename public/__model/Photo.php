<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-08-17
 * Time: 21:41
 */

namespace App\Publico\Model;


class Photo
{
    protected static $table_name = "Photos";
    protected static $db_fields = array("id", "user_id", "title", "href", "src", "width", "height");
    public static $searchable_fields = array("title");
    public $id;
    public $user_id;
    public $title;
    public $href;
    public $src;
    public $width;
    public $height;



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





    public static function get_query_for_read($data)
    {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;
        $d = $data;
//        $notified_user_id = $session->actual_user_id;
        $limit = 20;

        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE user_id = {$session->actual_user_id}";
        $query .= " ORDER BY id DESC";

        $query .= " LIMIT {$limit} OFFSET {$d['offset']}";

        \MyDebugMessenger::add_debug_message("QUERY: {$query}");

        return $query;
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
        //uki now
        $query = self::get_query_for_read($data);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_photos = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_photo = array(
                "id" => $row['id'],
                "user_id" => $row['user_id'],
                "photo_title" => $row['title'],
                "embed_code" => $row['embed_code'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );


            //
            array_push($array_of_photos, $a_photo);
        }

        return $array_of_photos;
    }






    public function create()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        //uki
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
}