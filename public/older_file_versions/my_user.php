<?php

// If it's going to need the database, then it's 
// probably smart to require it before we start.
//require_once(PUBLIC_PATH . '/__model/my_database.php');
require_once("my_database.php");

class User {

    protected static $table_name = "Users";
    protected static $db_fields = array('UserId', 'UserName', 'HashedPassword', 'UserTypeId');
//    public $user_id;
//    public $user_name;
//    public $hashed_password;
//    public $user_type_id;
    public $UserId;
    public $UserName;
    public $HashedPassword;
    public $UserTypeId;
    
    
    
    

    public static function read_by_id($id = 0) {
//        $query = "SELECT * FROM " . self::$table_name . " WHERE UserId = ?";
//        $stmt = $mysqli->prepare($sql);
//
//        if (!$stmt) {
//            die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
//        }
    }

    public static function read_by_query($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);

        $objects_array = array();

        while ($row = $database->fetch_array($result_set)) {
//            $objects_array[] = self::instantiate($row);
            array_push($objects_array, self::instantiate($row));
        }

        return $objects_array;


        //
    }

    public static function read_all() {
        $query = "SELECT * FROM " . self::$table_name;

        $objects_array = self::read_by_query($query);

        return $objects_array;
    }

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
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