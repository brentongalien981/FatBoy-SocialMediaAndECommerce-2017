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

}

?>