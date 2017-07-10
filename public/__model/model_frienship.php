<?php

// If it's going to need the database, then it's
// probably smart to require it before we start.
require_once("my_database.php");

class Friendship
{

    protected static $table_name = "Friendship";
    protected static $db_fields = array("user_id", "friend_id");
    public $user_id;
    public $friend_id;

    public static function read_by_id($id = 0)
    {
//        $query = "SELECT * FROM " . self::$table_name . " WHERE UserId = ?";
//        $stmt = $mysqli->prepare($sql);
//
//        if (!$stmt) {
//            die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
//        }
    }


    /**
     *
     * @global type $session
     * @global type $database
     * @param int $user_id
     * @return string
     */
    public static function get_profile_pic_src($user_id)
    {
        global $session;

        $query = "SELECT * FROM Profile ";
        $query .= "WHERE user_id = {$user_id}";

        $record_result = Friendship::read_by_query($query);

        global $database;

        // Default pic_url.
        $default_url = "/public/_photos/icon_profile.png";


        $num_of_results = $database->get_num_rows_of_result_set($record_result);
        if ($num_of_results == 0) {
            return $default_url;
        }


        while ($row = $database->fetch_array($record_result)) {
            // If there's no valid pic src, then the default pic src,
            // otherwise return the valid pic src.
            if (
                (!isset($row["pic_url"])) ||
                (empty($row["pic_url"])) ||
                (is_null($row["pic_url"])) ||
                (($row["pic_url"] === 0))
            ) {
                $pic_url = $default_url;
            } else {
                $pic_url = $row["pic_url"];
            }
            //
            return $pic_url;
        }
    }

    /**
     *
     * @param int $actual_user_id
     * @return string
     */
    public static function get_query_for_suggested_friends($actual_user_id)
    {
        $query = "SELECT user_id, user_name ";
        $query .= "FROM Users ";

        // Don't show users that are already my followers
        // cause they already appear on my Followers section.
        $query .= "WHERE user_id NOT IN ";
        $query .= "(";
        $query .= "SELECT friend_id ";
        $query .= "FROM Friendship ";
        $query .= "WHERE user_id = {$actual_user_id}";
        $query .= ") ";
        $query .= "AND user_id != {$actual_user_id} ";

        // Don't show users that are already my muses
        // cause they already appear on my Muses section.
        $query .= "AND user_id NOT IN (";
        $query .= "SELECT user_id ";
        $query .= "FROM Friendship ";
        $query .= "WHERE friend_id = {$actual_user_id}) ";

        // Also, don't suggest users that are currently in pending friendship status with you.
        $query .= "AND user_id NOT IN (";
        $query .= "SELECT notified_user_id ";
        $query .= "FROM Notifications ";
        $query .= "WHERE notifier_user_id = {$actual_user_id} ";
        $query .= "AND notification_msg_id IN (2, 3)) ";

        $query .= "AND user_id NOT IN (";
        $query .= "SELECT notifier_user_id ";
        $query .= "FROM Notifications ";
        $query .= "WHERE notified_user_id = {$actual_user_id} ";
        $query .= "AND notification_msg_id IN (2, 3))";

        return $query;
    }

    public static function read_by_query_and_instantiate($query = "")
    {
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


    public static function get_all_friends()
    {
        global $database;
        global $session;

        $query = "SELECT * FROM `Users` WHERE user_id IN ( SELECT friend_id FROM Friendship WHERE user_id = {$session->currently_viewed_user_id})";

        //
        $result_set = self::read_by_query($query);

        //
        $friends = array();

        while ($row = $database->fetch_array($result_set)) {
            array_push($friends, array(
                "friend_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "user_pic_src" => self::get_profile_pic_src($row['user_id'])
                //uki
            ));
        }

        //
        return $friends;
    }


    public static function get_all_muses()
    {
        global $database;
        global $session;

        $query = "SELECT * FROM `Users` WHERE user_id IN ( SELECT user_id FROM Friendship WHERE friend_id = {$session->currently_viewed_user_id})";

        // TODO:DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}");

        //
        $result_set = self::read_by_query($query);

        //
        $muses = array();

        while ($row = $database->fetch_array($result_set)) {
            array_push($muses, array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "user_pic_src" => self::get_profile_pic_src($row['user_id'])
                //uki
            ));
        }

        //
        return $muses;
    }

    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);


        //
        return $result_set;
    }

    public static function read_all()
    {
        $query = "SELECT * FROM " . self::$table_name;
//        $query .= "ORDER BY name ASC";


        $objects_array = self::read_by_query_and_instantiate($query);

        return $objects_array;
    }

    private function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->get_attributes());
    }

    // Returns bool.
    public function create_with_bool()
    {
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
            return true;
        } else {
            return false;
        }
    }

    public static function delete($id = 0)
    {
        global $database;

        $query = "DELETE FROM " . self::$table_name . " ";
        $query .= "WHERE id = " . $database->escape_value($id) . " ";
        $query .= "LIMIT 1";

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY: {$query}.");

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }

    public static function delete_by_query($query)
    {
        global $database;

        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("QUERY DELETE: {$query}.");

        $database->get_result_from_query($query);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }

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

    public function to_string()
    {
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
    private static function instantiate($record)
    {
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