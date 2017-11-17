<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-03
 * Time: 10:48
 */

namespace App\Publico\Model;


class Address
{
    protected static $table_name = "Address";
    protected static $db_fields = array("id", "user_id", "address_type_code", "street1", "street2", "city", "state", "zip", "country_code", "phone");
    public $id;
    public $user_id;
    public $address_type_code;
    public $street1;
    public $street2;
    public $city;
    public $state;
    public $zip;
    public $country_code;
    public $phone;

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

    public function does_address_exist()
    {

        /**/
        global $database;

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE street1 = '{$this->street1}'";
        $q .= " AND street2 = '{$this->street2}'";
        $q .= " AND city = '{$this->city}'";
        $q .= " AND state = '{$this->state}'";
        $q .= " AND zip = '{$this->zip}'";
        $q .= " AND country_code = '{$this->country_code}'";
        $q .= " AND phone = '{$this->phone}'";

        $result_set = self::read_by_query($q);

        $num_of_records = $database->get_num_rows_of_result_set($result_set);

        return ($num_of_records > 0) ? true : false;
    }

    public function create()
    {
        global $database;

        //uki
        $attributes = $this->get_sanitized_attributes();

        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";


        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
            //
            $this->id = $database->get_last_inserted_id();
            return true;
        }

        return false;
    }

    public static function read_by_id($id = 0)
    {

        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE id = {$id}";
        $q .= " LIMIT 1";

        global $database;
        $result_set = $database->get_result_from_query($q);

        //
        $an_obj = null;

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "address_id" => $row["id"],
                "user_id" => $row["user_id"],
                "address_type_code" => $row["address_type_code"],
                "street1" => $row["street1"],
                "street2" => $row["street2"],
                "city" => $row["city"],
                "state" => $row["state"],
                "zip" => $row["zip"],
                "country_code" => $row["country_code"],
                "phone" => $row["phone"]

            );


        }

        return $an_obj;
    }

    public static function read_by_user_id($user_id = 0)
    {
//        $home_address_type_code = 1;
        $business_address_type_code = 2;
//        $one_time_address_type_code = 3;


        $q = "SELECT * FROM " . self::$table_name . " WHERE user_id = {$user_id} AND address_type_code = {$business_address_type_code} LIMIT 1";

        global $database;
        $result_set = $database->get_result_from_query($q);

        //
        $an_obj = null;

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "address_id" => $row["id"],
                "user_id" => $row["user_id"],
                "address_type_code" => $row["address_type_code"],
                "street1" => $row["street1"],
                "street2" => $row["street2"],
                "city" => $row["city"],
                "state" => $row["state"],
                "zip" => $row["zip"],
                "country_code" => $row["country_code"],
                "phone" => $row["phone"]

            );


        }

        return $an_obj;
    }


    public function read_existing_address()
    {

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE street1 = '{$this->street1}'";
        $q .= " AND street2 = '{$this->street2}'";
        $q .= " AND city = '{$this->city}'";
        $q .= " AND state = '{$this->state}'";
        $q .= " AND zip = '{$this->zip}'";
        $q .= " AND country_code = '{$this->country_code}'";
        $q .= " AND phone = '{$this->phone}'";

        $result_set = self::read_by_query($q);

        /**/
        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "address_id" => $row["id"]
            );


            //
            return $an_obj;
        }
    }
}