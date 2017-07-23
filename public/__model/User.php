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
    protected static $db_fields = array("user_id", "user_name", "email", "hashed_password", "user_type_id", "signup_token");
    public static $searchable_fields = array("user_name", "email");
    public $user_id;
    public $user_name;
    public $email;
    public $hashed_password;
    public $user_type_id;
    public $signup_token;





    public static function read_by_query($query = "") {
        global $database;

        $result_set = $database->get_result_from_query($query);

        //
        return $result_set;
    }





    public static function read_with_offset($offset) {
        $query = self::get_query_for_read_with_offset($offset);


        //uki
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
                "user_type_id" => $row['user_type_id']);


            //
            array_push($array_of_users, $a_user);
        }

        return $array_of_users;
    }





    public static function get_query_for_read_with_offset($offset) {
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