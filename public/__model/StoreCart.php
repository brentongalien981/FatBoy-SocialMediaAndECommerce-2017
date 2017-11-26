<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 00:21
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class StoreCart extends MainModel
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

        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
            $this->id = $database->get_last_inserted_id();
            return true;
        } else {
            return false;
        }
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }

    /**
     * Check if there's already a valid (not yet complete) cart with details
     * for the seller-user-id and buyer-user-id.
     * @return bool
     */
    public static function does_cart_exist() {
        //
        global $session;

        //
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE seller_user_id = {$session->currently_viewed_user_id}";
        $q .= " AND buyer_user_id = {$session->actual_user_id}";
        $q .= " AND is_complete = 0";

        //
        $result_set = self::read_by_query($q);

        //
        global $database;
        $num_of_rows = $database->get_num_rows_of_result_set($result_set);

        if ($num_of_rows > 0) {

            //
            self::set_cart_id($result_set);

            return true;
        } else {
            return false;
        }
    }

    public static function set_cart_id($result_set) {

        global $database;
        global $session;

        while ($row = $database->fetch_array($result_set)) {
            $session->set_cart_id($row["cart_id"]);
            return;
        }
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

    public static function get_seller_user_id() {
        global $session;

        $cart = StoreCart::read_by_id($session->cart_id);
        return $cart["seller_user_id"];
    }

    public static function finalize_cart() {
        global $session;

        $q = "UPDATE " . self::$table_name;
        $q .= " SET is_complete = 1";
        $q .= " WHERE cart_id = {$session->cart_id}";

        global $database;
        $database->get_result_from_query($q);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
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