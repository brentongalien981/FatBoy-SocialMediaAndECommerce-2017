<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-20
 * Time: 16:52
 */

namespace App\Publico\Model;


class User
{
    protected static $table_name = "Users";
    protected static $db_fields = array("user_id", "user_name", "email", "hashed_password", "user_type_id", "signup_token", "private", "account_status_id");
    public static $searchable_fields = array("user_name", "email");
    public $user_id;
    public $user_name;
    public $email;
    public $hashed_password;
    public $user_type_id;
    public $signup_token;
    public $private;
    public $account_status_id;


    public static function read_by_query($query = "")
    {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }


    public static function create_user_profile($user_id)
    {
//        global $session;
        global $database;
        $query = "INSERT INTO Profile(user_id) VALUES({$user_id})";

        $is_creation_ok = $database->get_result_from_query($query);

        if ($is_creation_ok) {
            return true;
        }

        return false;
    }


    public function create()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection

        //
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
            $this->user_id = $database->get_last_inserted_id();

            //
            $is_user_profile_creation_ok = self::create_user_profile($this->user_id);

            //
            if (!$is_user_profile_creation_ok) {
                return false;
            }

            //
            if (!$database->commit()) {
                return false;
            }

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


    public function update()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->get_sanitized_attributes();
        $attribute_pairs = array();

        foreach ($attributes as $key => $value) {
            // Don't include the password for the update.
            if ($key == "hashed_password") {
                continue;
            }

            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . self::$table_name . " SET ";
        $query .= join(", ", $attribute_pairs);
        $query .= " WHERE user_id =" . $database->escape_value($this->user_id);//uki


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


    public static function read($data)
    {
        $query = self::get_query_for_read($data);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_users = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_user = array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "private" => $row['private'],
                "account_status_id" => $row['account_status_id'],
                "user_type_id" => $row['user_type_id']
            );


            //
            array_push($array_of_users, $a_user);
        }

        return $array_of_users;
    }


    // @deprecated kinna
    public static function read_with_offset($offset)
    {
        $query = self::get_query_for_read_with_offset($offset);


        //
        $result_set = self::read_by_query($query);

        //
        $array_of_users = array();

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $a_user = array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "email" => $row['email'],
                "private" => $row['private'],
                "account_status_id" => $row['account_status_id'],
                "user_type_id" => $row['user_type_id']);


            //
            array_push($array_of_users, $a_user);
        }

        return $array_of_users;
    }





    public static function get_query_for_read($data)
    {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;
//        $notified_user_id = $session->actual_user_id;
        $limit = 5;

        $query = "SELECT u.*";
//        $query .= " ,p.*";
        $query .= " FROM Users u";
        $query .= " WHERE user_id LIKE '%{$data['user_id']}%'";
        
        
        if ($data['is_search_filtered']) {
            $query .= " AND user_name LIKE '%{$data['user_name']}%'";
            $query .= " AND email LIKE '%{$data['email']}%'";
            $query .= " AND private LIKE '%{$data['privacy']}%'";
            $query .= " AND account_status_id LIKE '%{$data['account_status']}%'";
            $query .= " AND user_type_id LIKE '%{$data['user_type']}%'";
        }
        else {
            $query .= " OR user_name LIKE '%{$data['user_name']}%'";
            $query .= " OR email LIKE '%{$data['email']}%'";
            $query .= " OR private LIKE '%{$data['privacy']}%'";
            $query .= " OR account_status_id LIKE '%{$data['account_status']}%'";
            $query .= " OR user_type_id LIKE '%{$data['user_type']}%'";
        }

        $query .= " ORDER BY user_id ASC";

        $query .= " LIMIT {$limit} OFFSET {$data['offset']}";

        \MyDebugMessenger::add_debug_message("QUERY: {$query}");

        return $query;
    }


    public static function get_query_for_read_with_offset($offset)
    {
        // TODO:REMINDER: Only select the necessary columns.

        global $session;
        $notified_user_id = $session->actual_user_id;
        $limit = 5;

        $query = "SELECT u.*";
//        $query .= " ,p.*";
        $query .= " FROM Users u";
//        $query .= " INNER JOIN Profile p ON u.user_id = p.user_id";


        $query .= " ORDER BY user_id ASC";

        $query .= " LIMIT {$limit} OFFSET {$offset}";

        \MyDebugMessenger::add_debug_message("QUERY: {$query}");

        return $query;
    }

}