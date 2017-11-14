<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 00:21
 */

namespace App\Publico\Model;


class StoreCart
{
    protected static $table_name = "StoreCart";
    protected static $db_fields = array(
        "cart_id",
        "seller_user_id",
        "buyer_user_id",
        "is_complete"
    );

    public $cart_id;
    public $seller_user_id;
    public $buyer_user_id;
    public $is_complete;

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

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    public static function get_query_for_read($data)
    {
        $d = $data;
        $limit = 6;
        global $session;

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE buyer_user_id = {$session->actual_user_id}";
        $q .= " AND is_complete = 0";
//        $q .= " LIMIT {$limit}";
//        $q .= " OFFSET {$d['offset']}";


        return $q;
    }

    public static function read($data)
    {

        $query = self::get_query_for_read($data);

        $result_set = self::read_by_query($query);



        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            /* Get the username of the seller. */
            $seller_user = self::read_user($row["seller_user_id"]);


            //
            $an_obj = array(
                "cart_id" => $row["cart_id"],
                "seller_user_id" => $row["seller_user_id"],
                "seller_user_name" => $seller_user["user_name"],
                "buyer_user_id" => $row["buyer_user_id"],
                "is_complete" => $row["is_complete"]
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

    public static function read_by_id($id)
    {

        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE cart_id = {$id}";
        $q .= " LIMIT 1";

        $result_set = self::read_by_query($q);



        //
        $an_obj = null;

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "cart_id" => $row["cart_id"],
                "seller_user_id" => $row["seller_user_id"],
                "buyer_user_id" => $row["buyer_user_id"],
                "is_complete" => $row["is_complete"]
            );



        }

        return $an_obj;
    }

    private static function read_user($user_id)
    {

        $query = "SELECT * FROM Users";
        $query .= " WHERE user_id = {$user_id}";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "user_name" => $row["user_name"]
            );


            //
            return $an_obj;
        }
    }
}