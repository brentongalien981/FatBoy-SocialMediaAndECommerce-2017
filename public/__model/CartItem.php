<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-02
 * Time: 04:15
 */

namespace App\Publico\Model;


class CartItem
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
                "product_name" => $row["name"],
                "product_price" => $row["price"],
                "product_photo_address" => $row["photo_address"],
                "product_stock_quantity" => $row["quantity"]
            );


            //
            return $an_obj;
        }
    }
}