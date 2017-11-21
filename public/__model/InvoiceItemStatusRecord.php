<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-20
 * Time: 18:08
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class InvoiceItemStatusRecord extends MainModel
{
    protected static $table_name = "InvoiceItemStatusRecord";
    protected static $db_fields = array("id", "invoice_item_id", "invoice_item_status_id");
    public $id;
    public $invoice_item_id;
    public $invoice_item_status_id;

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
}