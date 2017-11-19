<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-19
 * Time: 00:06
 */

namespace App\Publico\Model;


class UserPayPalAccount
{
    protected static $table_name = "UserPayPalAccount";
    protected static $db_fields = array("id", "user_id", "paypal_client_id", "paypal_secret_id", "account_type");
    public $id;
    public $user_id;
    public $paypal_client_id;
    public $paypal_secret_id;
    public $account_type;

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
        $limit = 1;
        $business_account_type_code = 2;
        global $session;

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE user_id = {$d['seller_user_id']}";
        $q .= " AND account_type = {$business_account_type_code}";
        $q .= " LIMIT {$limit}";


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

            //
            $an_obj = array(
                "paypal_client_id" => $row["paypal_client_id"],
                "paypal_secret_id" => $row["paypal_secret_id"]
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

}