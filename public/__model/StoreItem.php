<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-30
 * Time: 06:21
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class StoreItem extends MainModel
{
    protected static $table_name = "MyStoreItems";
    protected static $db_fields = array(
        "id",
        "user_id",
        "name",
        "price",
        "description",
        "photo_address",
        "quantity",
        "mass",
        "length",
        "width",
        "height",
    );

    public $id;
    public $user_id;
    public $name;
    public $price;
    public $description;
    public $photo_address;
    public $quantity;
    public $mass;
    public $length;
    public $width;
    public $height;

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

    /**
     * @note that when debugging any UPDATE query here in PhpStorm, the method
     *      $database->get_num_of_affected_rows() will return -1, an erronous
     *      value. But if it's a regular mode (not debugging) it works perfectly.
     *      WEIRD!
     * @param $store_item_id
     * @param $new_stock_quantity
     * @return bool
     */
    public static function update_item_stock_quantity($store_item_id, $new_stock_quantity) {
        $q = "UPDATE " . self::$table_name;
        $q .= " SET quantity = {$new_stock_quantity}";
        $q .= " WHERE id = {$store_item_id}";

        global $database;
        // Start transaction.
        if (!$database->start_transaction()) {
            return false;
        }

        $database->get_result_from_query($q);

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

    public static function read_by_id($id) {

        $query = "SELECT *";
        $query .= " FROM " . self::$table_name;
        $query .= " WHERE id = {$id}";

        //
        $result_set = self::read_by_query($query);

        //
        global $database;

        while ($row = $database->fetch_array($result_set)) {

            return self::instantiate($row);
        }
    }

    private static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
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
        $query .= " WHERE id =" . $database->escape_value($this->id);


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

    public static function get_query_for_read($data)
    {
        $d = $data;
        $limit = 6;
        global $session;

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE user_id = {$session->currently_viewed_user_id}";
        $q .= " LIMIT {$limit}";
        $q .= " OFFSET {$d['offset']}";


        return $q;
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

    public static function read($data)
    {

        $query = self::get_query_for_read($data);

        $result_set = self::read_by_query($query);



        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            /* Get the username of the seller. */
            $seller_user = self::read_user($row["user_id"]);
            $seller_user_name = $seller_user["user_name"];


            //
            $an_obj = array(
                "product_id" => $row["id"],
                "seller_user_id" => $row["user_id"],
                "seller_user_name" => $seller_user_name,
                "product_name" => $row["name"],
                "product_price" => $row["price"],
                "product_description" => $row["description"],
                "product_photo_address" => $row["photo_address"],
                "product_quantity" => $row["quantity"],
                "product_mass" => $row["mass"],
                "product_length" => $row["length"],
                "product_width" => $row["width"],
                "product_height" => $row["height"]
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }
}