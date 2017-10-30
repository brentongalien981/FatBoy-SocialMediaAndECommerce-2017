<?php


// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once("my_database.php");
require_once("Notification.php");

class NotificationMyShopping extends Notification
{

    protected static $table_name = "NotificationsMyShopping";
    protected static $db_fields = array("notification_id", "invoice_item_id", "invoice_item_status_record_id");
    private static $uninherited_db_fields = array("notification_id", "invoice_item_id", "invoice_item_status_record_id");
    public $notification_id;
    public $invoice_item_id;
    public $invoice_item_status_record_id;

    public function __construct()
    {
        self::$db_fields = array_merge(parent::$db_fields, self::$db_fields);
    }



    public static function read_by_id($id = 0) {
//        $query = "SELECT * FROM " . self::$table_name . " WHERE UserId = ?";
//        $stmt = $mysqli->prepare($sql);
//
//        if (!$stmt) {
//            die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
//        }
    }

    public static function read_by_query_and_instantiate($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);

        $objects_array = array();

        while ($row = $database->fetch_array($result_set)) {
//            $objects_array[] = self::instantiate($row);
            array_push($objects_array, self::instantiate($row));
        }

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("METHOD: read_by_query_and_instantiate() called...");

        // This could be one or many instantiated objects.
        return $objects_array;
    }
    
    /**
     * 
     * @param int $notified_user_id
     * @return string $query
     */
    public static function get_query_for_read_all($notified_user_id) {
        $query = "SELECT * FROM " . self::$table_name;
        $query .= " INNER JOIN " . parent::$table_name;
        $query .= " ON " . self::$table_name . ".notification_id = " . parent::$table_name . ".id";
        $query .= " WHERE is_deleted = 0";
        $query .= " AND notified_user_id = {$notified_user_id}";
        
        return $query;
    }    

    public static function read_all($notified_user_id) {
        $query = self::get_query_for_read_all($notified_user_id);


        $objects_array = self::read_by_query_and_instantiate($query);

        return $objects_array;
    }

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }


    public static function create_invoice_item_status_record(&$data) {

        $query = "INSERT INTO InvoiceItemStatusRecord (invoice_item_id, invoice_item_status_id) ";
        $query .= "VALUES ({$data['the_invoice_item_id']}, {$data['new_invoice_item_status_id']})";

        $is_creation_ok = self::create_by_query($query);

        MyDebugMessenger::add_debug_message("DEBUG: QUERY: {$query}.");


        if ($is_creation_ok) {
            MyDebugMessenger::add_debug_message("SUCCESS creation of InvoiceItemStatusRecord.");
            global $database;
            $data['invoice_item_status_record_id'] = $database->get_last_inserted_id();
            return true;
        } else {
            MyDebugMessenger::add_debug_message("FAIL creation of InvoiceItemStatusRecord.");
            $data['invoice_item_status_record_id'] = -1;
            return false;
        }
    }



    public static function set_invoice_attribs(&$data) {
        $query = "SELECT * FROM Invoice ";
        $query .= "WHERE id = '{$data['invoice_id']}' LIMIT 1";

        $record_result = self::read_by_query($query);

        global $database;

        while ($row = $database->fetch_array($record_result)) {
            $data['notified_user_id'] = $row['buyer_user_id'];
            $data['notifier_user_id'] = $row['seller_user_id']; // Can also be $session->actual_user_id.

            $code_for_shopping_status_update = 1; // {NotifierUserName}’s Store updated the item {Produ...
            $data['notification_msg_id'] = $code_for_shopping_status_update;
        }
    }



    public static function update_to_deleted($notification_id) {
        $query = "UPDATE " . parent::$table_name;
        $query .= " SET is_deleted = 1";
        $query .= " WHERE id = {$notification_id}";

        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        return ($database->get_num_of_affected_rows() > 0) ? true : false;
    }










    public static function read_by_offset($data) {
//        $query = self::get_query_for_read_by_section($section, $limit);

        $query = self::get_query_for_read_by_offset($data);


//        $objects_array = self::read_by_query_and_instantiate($query);
        $result_set = self::read_by_query($query);

        // Array of friendship notifications, that for every array contains
        // infos like "notification_id", "notifier_user_id", "notifier_name"...
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notification_msg_id" => $row['notification_msg_id'],
                "seller_name" => $row['seller_name'],
                "invoice_id" => $row['invoice_id'],
                "invoice_item_id" => $row['invoice_item_id'],
                "item_name" => $row['item_name'],
                "status_name" => $row['invoice_item_status'],
                "date_updated" => $row['date_updated'],
                "human_date" => parent::get_my_carbon_date($row['date_updated']));


            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }



    public static function get_query_for_read_by_offset($data) {

        global $session;
        $d = $data;
        $limit = 10;
        $q = "";

        $q .= "SELECT n.notified_user_id, n.notifier_user_id, n.notification_msg_id, n.is_deleted";
        $q .= " ,nms.notification_id, nms.invoice_item_id, nms.invoice_item_status_record_id";
        $q .= " ,iisr.invoice_item_status_id, iisr.status_start_date AS date_updated";
        $q .= " ,iis.name AS invoice_item_status";
        $q .= " ,ii.invoice_id, ii.store_item_id";
        $q .= " ,msi.name AS item_name";
        $q .= " ,u.user_name AS seller_name";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsMyShopping nms ON n.id = nms.notification_id";
        $q .= " INNER JOIN InvoiceItemStatusRecord iisr ON (nms.invoice_item_id, nms.invoice_item_status_record_id) = 		(iisr.invoice_item_id, iisr.id)";
        $q .= " INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id";
        $q .= " INNER JOIN InvoiceItem ii ON nms.invoice_item_id = ii.id";
        $q .= " INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id";
        $q .= " INNER JOIN Users u ON n.notifier_user_id = u.user_id";
        $q .= " WHERE n.notified_user_id = {$session->actual_user_id}";
        $q .= " AND n.notification_msg_id = 1";
        $q .= " AND n.is_deleted = 0";
        $q .= " ORDER BY date_updated DESC";
        $q .= " LIMIT {$limit} OFFSET {$d['offset']}";


        return $q;
    }

    public static function get_query_for_fetch($data) {

        global $session;
        $d = $data;
        $limit = 2;
        $q = "";

        $q .= "SELECT n.notified_user_id, n.notifier_user_id, n.notification_msg_id, n.is_deleted";
        $q .= " ,nms.notification_id, nms.invoice_item_id, nms.invoice_item_status_record_id";
        $q .= " ,iisr.invoice_item_status_id, iisr.status_start_date AS date_updated";
        $q .= " ,iis.name AS invoice_item_status";
        $q .= " ,ii.invoice_id, ii.store_item_id";
        $q .= " ,msi.name AS item_name";
        $q .= " ,u.user_name AS seller_name";
        $q .= " FROM Notifications n";
        $q .= " INNER JOIN NotificationsMyShopping nms ON n.id = nms.notification_id";
        $q .= " INNER JOIN InvoiceItemStatusRecord iisr ON (nms.invoice_item_id, nms.invoice_item_status_record_id) = 		(iisr.invoice_item_id, iisr.id)";
        $q .= " INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id";
        $q .= " INNER JOIN InvoiceItem ii ON nms.invoice_item_id = ii.id";
        $q .= " INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id";
        $q .= " INNER JOIN Users u ON n.notifier_user_id = u.user_id";
        $q .= " WHERE n.notified_user_id = {$session->actual_user_id}";
        $q .= " AND n.notification_msg_id = 1";
        $q .= " AND n.is_deleted = 0";
        $q .= " AND iisr.status_start_date > '{$d['latest_notification_date']}'";
        $q .= " ORDER BY date_updated ASC";
        $q .= " LIMIT {$limit}";


        return $q;

    }

    public static function fetch($data)
    {

        $d = $data;
        $query = self::get_query_for_fetch($d);
        //ish

        $result_set = self::read_by_query($query);

        //
        $array_of_notifications = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notification_msg_id" => $row['notification_msg_id'],
                "seller_name" => $row['seller_name'],
                "invoice_id" => $row['invoice_id'],
                "invoice_item_id" => $row['invoice_item_id'],
                "item_name" => $row['item_name'],
                "status_name" => $row['invoice_item_status'],
                "date_updated" => $row['date_updated'],
                "human_date" => parent::get_my_carbon_date($row['date_updated']));




            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }





    // Find the invoice id where this invoice item that is being status-updated is in.
    public static function get_invoice_id_for_invoice_item($invoice_item_id) {
        $query = "SELECT invoice_id FROM InvoiceItem ";
        $query .= "WHERE id = {$invoice_item_id} LIMIT 1";

        $record_result = self::read_by_query($query);

        global $database;
        while ($row = $database->fetch_array($record_result)) {
            return $row['invoice_id'];
        }
    }



    public static function create_by_query($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        if ($database->get_num_of_affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }




    // TODO:REMINDER: Maybe put this to a class "InvoiceItemStatusRecord".
    public static function does_status_for_invoice_item_exist($data) {
        $query = "SELECT * FROM InvoiceItemStatusRecord ";
        $query .= "WHERE invoice_item_id = {$data['the_invoice_item_id']} ";
        $query .= "AND invoice_item_status_id = {$data['new_invoice_item_status_id']}";

        $record_result = self::read_by_query($query);

        global $database;
        $num_of_record_result = $database->get_num_rows_of_result_set($record_result);

        if ($num_of_record_result > 0) {
            return true;
        } else {
            return false;
        }
    }



    // Returns bool.
    public function create_with_bool() {
        if (!$this->create_parent_obj()) {
            return false;
        }


        //
        global $database;

        $attributes = $this->get_sanitized_uninherited_attributes();


        $query = "INSERT INTO " . self::$table_name . " (";
        $query .= join(", ", array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";



        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("QUERY2: {$query}");
//        $json_errors_array['query1'] = $query;



        // Start the transaction.
        if (!$database->start_transaction()) { return false; }


        // Execute the INSERT query.
        $query_result = $database->get_result_from_query($query);

        if ($query_result) {
//            $this->id = $database->get_last_inserted_id();
            //
            if (!$database->commit()) { return false; }
            return true;
        } else {
            //
            if (!$database->rollback()) { return false; }
            return false;
        }
    }



    private function get_sanitized_uninherited_attributes() {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_uninherited_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }




    private function get_uninherited_attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$uninherited_db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }




    public static function delete($id = 0) {
        global $database;

        $query = "DELETE FROM " . self::$table_name . " ";
        $query .= "WHERE id = " . $database->escape_value($id) . " ";
        $query .= "LIMIT 1";

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}.");

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }

    protected function get_sanitized_attributes() {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    protected function get_attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public function to_string() {
        $object_in_string = "";

        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                echo "{$field}: $this->$field<br>";
                $object_in_string .= "{$field}: $this->$field<br>";
            }
        }

        return $object_in_string;
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

}

?>