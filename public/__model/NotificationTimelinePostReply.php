<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-10-24
 * Time: 22:32
 */

//namespace App\Publico\Model;

//require_once("my_database.php");
require_once("Notification.php");


//use App\Publico\Model\Notification;
//use TimelinePostReply;
//use User;


class NotificationTimelinePostReply extends Notification
{
    protected static $table_name = "NotificationsTimelinePostReply";
    protected static $db_fields = array("notification_id", "timeline_post_reply_id");
    private static $uninherited_db_fields = array("notification_id", "timeline_post_reply_id");
    public $notification_id;
    public $timeline_post_reply_id;

    public function __construct()
    {
        self::$db_fields = array_merge(parent::$db_fields, self::$uninherited_db_fields);
    }

    private function get_sanitized_uninherited_attributes()
    {
        global $database;
        $sanitized_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->get_uninherited_attributes() as $key => $value) {
            $sanitized_attributes[$key] = $database->escape_value($value);
        }
        return $sanitized_attributes;
    }

    private function get_uninherited_attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$uninherited_db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function create_parent_obj() {
        $parent_notification = new Notification();
        $parent_notification->id = $this->id;
        $parent_notification->notified_user_id = $this->notified_user_id;
        $parent_notification->notifier_user_id = $this->notifier_user_id;
        $parent_notification->notification_msg_id = $this->notification_msg_id; // 2 is {NotifierUserName} wants to follow you.
        $parent_notification->is_deleted = $this->is_deleted;


        $is_creation_ok = $parent_notification->create_with_bool();

        if ($is_creation_ok) {
            $this->id = $parent_notification->id;
            $this->notification_id = $this->id;
        }


        return $is_creation_ok;
    }

    public function create() {
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

    public static function get_query_for_read($data)
    {

        $d = $data;
        $limit = 10;
        global $session;


        $q = "SELECT *";
        $q .= " FROM Notifications";
        $q .= " INNER JOIN NotificationsTimelinePostReply";
        $q .= " ON Notifications.id = NotificationsTimelinePostReply.notification_id";
        $q .= " WHERE notified_user_id = {$session->actual_user_id}";
        $q .= " AND notification_msg_id = 5";
        $q .= " AND initiation_date > '{$d['latest_notification_date']}'";
        $q .= " ORDER BY initiation_date DESC";
        $q .= " LIMIT {$limit}";

        return $q;
    }


    /**
     * @param $id
     * @return array|null
     * @note This was supposed to be a method inside class TimelinePostReply.
     * But because php messes up the reading of TimelinePostReply objs when
     * I do that (through removing the line of code "namespace App\Public..."),
     * I just stuck to this. But in properly namespaced project, I will do the other.
     */
    private static function timeline_post_reply_read_by_id($id) {

        $query = "SELECT * FROM TimelinePostReplies";
        $query .= " WHERE id = {$id}";

        $result_set = self::read_by_query($query);

        //
        $an_obj = null;


        global $database;
        while ($row = $database->fetch_array($result_set)) {

            //
            $an_obj = array(
                "timeline_post_id" => $row["parent_post_id"],
                "message" => $row["message"]
            );
        }

        //
        return $an_obj;
    }

    public static function read($data)
    {

        $d = $data;
        $query = self::get_query_for_read($d);

        $result_set = self::read_by_query($query);

        //
        $array_of_notifications = array();

        global $database;

        /* */
        require_once(PUBLIC_PATH . "/__model/my_user.php");
//        require_once(PUBLIC_PATH . "/__model/TimelinePostReply.php");


        /* */
        while ($row = $database->fetch_array($result_set)) {

            /* Another query to figure out the user-name of the timeline-poster. */
            $user = User::read_by_id($row["notifier_user_id"]);

            /* Another query to figure out the parent-timeline-post-id of every comment. */
//            $timeline_post_reply = TimelinePostReply::read_by_id($row["timeline_post_reply_id"]);
            $timeline_post_reply = self::timeline_post_reply_read_by_id($row["timeline_post_reply_id"]);


            //
            $a_notification = array(
                "notification_id" => $row['notification_id'],
                "notifier_user_id" => $row['notifier_user_id'],
                "notifier_user_name" => $user['user_name'],
                "notification_msg_id" => $row['notification_msg_id'],
                "timeline_post_id" => $timeline_post_reply["timeline_post_id"],
                "timeline_post_reply_id" => $row["timeline_post_reply_id"],
                "message" => $timeline_post_reply['message'],
                "date_updated" => $row['initiation_date'],
                "human_date" => self::get_my_carbon_date($row['initiation_date']));




            //
            array_push($array_of_notifications, $a_notification);
        }

        return $array_of_notifications;
    }
}