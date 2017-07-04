<?php

class NotificationFetcher {

    private static $notifiable_classes = array("Friendship", "MyShopping");
    private $num_of_notifications_arr = array("Friendship" => 0, "MyShopping" => 0);

    /**
     * @return int $notification_count Number of all notifications.
     */
    public static function get_all_notification_count() {
        global $session;
        global $database;

        foreach (self::$notifiable_classes as $key => $notifiable_class) {
            // $notification_class is like "Notification" . "Friendship" = NotificationFriendship.
            $notification_class = "Notification" . $notifiable_class;

            // $read_all_query for ex is the query for reading all friendship notifications.
            $read_all_query = $notification_class::get_query_for_read_all($session->actual_user_id);



            $result_set = $database->get_result_from_query($read_all_query);
            $notification_count = $database->get_num_rows_of_result_set($result_set);

            $num_of_notifications_arr[$notifiable_class] = $notification_count;
        }



        // Sum up all the notifications.
        $total_notifications = 0;
        foreach ($num_of_notifications_arr as $key => $value) {
            $total_notifications += $value;
        }

        //
        return $total_notifications;
    }

    /**
     * 
     * @global type $session
     * @param string $from_notification_type
     * @return array $notifications_objs_array
     */
    public static function fetch_notifications($from_notification_type) {
        $current_class = "Notification" . $from_notification_type;


        // All user's notifications for a specific Notification type, like "Notifications for Friendship.
        // Ex:
        //    $notifications_my_shopping_objs_array = NotificationMyShopping::read_all($session->actual_user_id);
        //    $notifications_friendship_objs_array = NotificationFriendship::read_all($session->actual_user_id);        
        global $session;
        $notifications_objs_array = $current_class::read_all($session->actual_user_id);


        // Ex
        //    $return_array["notifications_my_shopping_objs_array"] = $notifications_my_shopping_objs_array;
        //    $return_array["notifications_friendship_objs_array"] = $notifications_friendship_objs_array;        
        return $notifications_objs_array;
    }

    
    /**
     * 
     * @return array
     */
    public static function fetch_all_notifications() {
//        $categorized_notifications_arr = array("Friendship", "MyShopping");
        $notifications_objs_arr_keys = array("friendship", "my_shopping");
        
        //
        $all_notifications = array();

        foreach (self::$notifiable_classes as $index => $notification_category) {
            // This VAR is like "notifications_friendship_objs_array".
            $notifications_objs_arr_key = $notifications_objs_arr_keys[$index];

            // @var array $notifications_from_type contains all the notification objs
            //      for that specific NotificationType.
            $notifications_from_type = self::fetch_notifications($notification_category);
            
            $all_notifications[$notifications_objs_arr_key] = $notifications_from_type;
        }
        
        return $all_notifications;
    }

}

?>