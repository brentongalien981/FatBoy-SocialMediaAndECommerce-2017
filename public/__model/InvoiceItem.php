<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-28
 * Time: 16:58
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class InvoiceItem extends MainModel
{
    protected static $table_name = "InvoiceItem";
    protected static $db_fields = array("id", "invoice_id", "store_item_id", "price_per_item", "quantity");
    public $id;
    public $invoice_id;
    public $store_item_id;
    public $price_per_item;
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

    public static function read_by_id($id) {

        $query = "SELECT *";
        $query .= " FROM " . self::$table_name;
        $query .= " WHERE id = {$id}";

        //
        $result_set = self::read_by_query();

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
//            $this->id = $database->get_last_inserted_id();
            return true;
        } else {
            return false;
        }
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
        global $session;
        $d = $data;

        $query = "SELECT * FROM " . self::$table_name;
        $query .= " WHERE invoice_id = '{$d['invoice_id']}'";


        return $query;
    }

    public static function read_invoice_item_status_record($invoice_item_id) {

        $query = "SELECT * FROM InvoiceItemStatusRecord";
        $query .= " WHERE invoice_item_id = {$invoice_item_id}";
        $query .= " ORDER BY status_start_date DESC";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "invoice_item_status_id" => $row['invoice_item_status_id'],
                "status_start_date" => $row['status_start_date']
            );


            //
            return $an_obj;
        }
    }

    public static function read_store_item_details($store_item_id) {

        $query = "SELECT * FROM MyStoreItems";
        $query .= " WHERE id = {$store_item_id}";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "item_name" => $row['name'],
                "item_photo_address" => $row['photo_address']
            );


            //
            return $an_obj;
        }
    }

    public static function read_by_sessions_invoice_id() {

        global $session;

        $query = "SELECT *";
        $query .= " FROM " . self::$table_name;
        $query .= " WHERE invoice_id = '{$session->invoice_id}'";

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

            /**/
            // Get the latest invoice-item-status-record of that item.
            $invoice_item_id = $row["id"];
            $invoice_item_status_record = self::read_invoice_item_status_record($invoice_item_id);
            $iisr = $invoice_item_status_record;



            /**/
            // Get the store-item-details.
            $store_item_id = $row["store_item_id"];
            $store_item_details = self::read_store_item_details($store_item_id);
            $sid = $store_item_details;


            /**/
            $an_obj = array(
                "invoice_item_id" => $row['id'],
                "store_item_id" => $row['store_item_id'],
                "price_per_item" => $row['price_per_item'],
                "quantity" => $row['quantity'],
                "invoice_item_status_id" => $iisr['invoice_item_status_id'],
                "item_name" => $sid['item_name'],
                "item_photo_address" => $sid['item_photo_address']
            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }
}