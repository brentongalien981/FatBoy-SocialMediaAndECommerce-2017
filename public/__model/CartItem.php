<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 04:15
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class CartItem extends MainModel
{
    protected static $table_name = "CartItems";
    protected static $db_fields = array(
        "id",
        "cart_id",
        "item_id",
        "quantity"
    );

    public $id;
    public $cart_id;
    public $item_id;
    public $quantity;

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
//        $limit = 6;
        global $session;

        /**/
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE cart_id = {$session->cart_id}";
//        $q .= " LIMIT {$limit}";
//        $q .= " OFFSET {$d['offset']}";


        return $q;
    }

    // This is called if you're reading the user db
    // and instantiating user objects, then displaying them.
    private static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    public static function read_items_by_cart_id($cart_id) {

        $query = "SELECT *";
        $query .= " FROM " . self::$table_name;
        $query .= " WHERE cart_id = {$cart_id}";
        $query .= " AND quantity > 0";

        //
        $result_set = self::read_by_query($query);

        //
        global $database;
        $array_of_objs = array();

        while ($row = $database->fetch_array($result_set)) {

            $an_obj = self::instantiate($row);
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

    public static function read($data)
    {

        $query = self::get_query_for_read($data);

        $result_set = self::read_by_query($query);



        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            /* Get the store-item's record. */
            $store_item_details = self::read_store_item($row["item_id"]);


            //
            $an_obj = array(
                "store_item_id" => $store_item_details["store_item_id"],
                "cart_item_id" => $row["id"],
                "quantity" => $row["quantity"],
                "product_name" => $store_item_details["product_name"],
                "product_price" => $store_item_details["product_price"],
                "product_photo_address" => $store_item_details["product_photo_address"],
                "product_stock_quantity" => $store_item_details["product_stock_quantity"]
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

    private static function read_store_item($id)
    {

        $query = "SELECT * FROM MyStoreItems";
        $query .= " WHERE id = {$id}";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "store_item_id" => $row["id"],
                "product_name" => $row["name"],
                "product_price" => $row["price"],
                "product_photo_address" => $row["photo_address"],
                "product_stock_quantity" => $row["quantity"]
            );


            //
            return $an_obj;
        }
    }

    public static function update($data) {

        /**/
        $d = $data;
        global $database;

        /**/
        if (!self::is_new_quantity_within_stock_quantity($d)) { return false; }



        /**/
        $query = "UPDATE " . self::$table_name;
        $query .= " SET quantity = {$d['new_quantity']}";
        $query .= " WHERE id = {$d['cart_item_id']}";


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

    private static function is_new_quantity_within_stock_quantity($data) {

        /**/
        $new_quantity = $data["new_quantity"];

        /**/
        $store_item_details = self::read_store_item($data["store_item_id"]);
        $stock_quantity = $store_item_details["product_stock_quantity"];

        /**/
        if (($new_quantity > $stock_quantity) ||
            ($new_quantity < 0)) { return false; }

        return true;
    }
}