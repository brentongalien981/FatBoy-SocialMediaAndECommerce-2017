<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-28
 * Time: 02:20
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;
use Carbon\Carbon;


class Invoice extends MainModel
{
    protected static $table_name = "Invoice";
    protected static $db_fields = array("id", "seller_user_id", "buyer_user_id", "ship_from_address_id", "ship_to_address_id");
    public $id;
    public $seller_user_id;
    public $buyer_user_id;
    public $ship_from_address_id;
    public $ship_to_address_id;

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
//            $this->id = $database->get_last_inserted_id();
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

    public static function get_query_for_read($data)
    {
        $d = $data;
        $limit = 3;
        global $session;

//        $query = "SELECT Invoice.id, Invoice.seller_user_id, Invoice.buyer_user_id, ";
//        $query .= "Invoice.ship_from_address_id, Invoice.ship_to_address_id, Users.user_name, ";
//        $query .= "s.street1 AS seller_street1, b.street1 AS buyer_street1 ";
//        $query .= "FROM Invoice ";
//        $query .= "INNER JOIN Users ON Invoice.buyer_user_id = Users.user_id ";
//        $query .= "INNER JOIN Address s ON Invoice.ship_from_address_id = s.id ";
//        $query .= "INNER JOIN Address b ON Invoice.ship_to_address_id = b.id ";
//        $query .= "WHERE Invoice.seller_user_id = {$session->actual_user_id}";
//        $query .= " LIMIT {$limit}";

        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE seller_user_id = {$session->actual_user_id}";
        $q .= " LIMIT {$limit}";
        $q .= " OFFSET {$d['offset']}";


        return $q;
    }

    public static function get_my_carbon_date($raw_datetime)
    {
//        $timestamp = '2014-02-06 16:34:00';



        if (empty($raw_datetime) ||
            is_null($raw_datetime) ||
            $raw_datetime == "") {

            //
            $raw_datetime = "1917-05-21 04:51:59";
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $raw_datetime, '-4');
        $date->setTimezone('UTC');

//        $dt = Carbon::parse($raw_datetime);
//        $dt->setTimezone('-5');
//        Carbon::now(-1)
        return $date->diffForHumans();
    }

    public static function read($data)
    {

        $query = self::get_query_for_read($data);

        $result_set = self::read_by_query($query);

        //
        $array_of_objs = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {

            /* Get the order date of the invoice. */
            $invoice_id = $row["id"];
            $invoice_item = self::read_invoice_item($invoice_id);
            $invoice_item_id = $invoice_item["invoice_item_id"];

            $invoice_item_status_record = self::read_invoice_item_status_record($invoice_item_id);
            $invoice_order_date = $invoice_item_status_record["invoice_order_date"];


            /* Get the username of the buyer. */
            $buyer_user = self::read_user($row["buyer_user_id"]);
            $buyer_user_name = $buyer_user["user_name"];


            /* Get the address of the seller. */
            $seller_address = self::read_address($row["ship_from_address_id"]);

            /* Get the address of the buyer. */
            $buyer_address = self::read_address($row["ship_to_address_id"]);

            //
            $an_obj = array(
                "invoice_id" => $row["id"],
                "invoice_order_date" => $invoice_order_date,
                "human_invoice_order_date" => self::get_my_carbon_date($invoice_order_date),
                "buyer_user_name" => $buyer_user_name,
                "seller_street1" => $seller_address["street1"],
                "seller_street2" => $seller_address["street2"],
                "seller_city" => $seller_address["city"],
                "seller_state" => $seller_address["state"],
                "seller_zip" => $seller_address["zip"],
                "seller_country_code" => $seller_address["country_code"],
                "seller_phone" => $seller_address["phone"],
                "buyer_street1" => $buyer_address["street1"],
                "buyer_street2" => $buyer_address["street2"],
                "buyer_city" => $buyer_address["city"],
                "buyer_state" => $buyer_address["state"],
                "buyer_zip" => $buyer_address["zip"],
                "buyer_country_code" => $buyer_address["country_code"],
                "buyer_phone" => $buyer_address["phone"],

            );

            //
            array_push($array_of_objs, $an_obj);

        }

        return $array_of_objs;
    }

    private static function read_address($address_id)
    {

        $query = "SELECT * FROM Address";
        $query .= " WHERE id = {$address_id}";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "street1" => $row["street1"],
                "street2" => $row["street2"],
                "city" => $row["city"],
                "state" => $row["state"],
                "zip" => $row["zip"],
                "country_code" => $row["country_code"],
                "phone" => $row["phone"]
            );


            //
            return $an_obj;
        }
    }

    private static function read_invoice_item_status_record($invoice_item_id)
    {

        $query = "SELECT * FROM InvoiceItemStatusRecord";
        $query .= " WHERE invoice_item_id = {$invoice_item_id}";
        $query .= " ORDER BY status_start_date ASC";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "invoice_item_status_id" => $row['invoice_item_status_id'],
                "invoice_order_date" => $row['status_start_date']
            );


            //
            return $an_obj;
        }
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

    private static function read_invoice_item($invoice_id)
    {

        $query = "SELECT * FROM InvoiceItem";
        $query .= " WHERE invoice_id = '{$invoice_id}'";
        $query .= " LIMIT 1";

        $result_set = self::read_by_query($query);


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "invoice_item_id" => $row["id"]
            );


            //
            return $an_obj;
        }
    }
}