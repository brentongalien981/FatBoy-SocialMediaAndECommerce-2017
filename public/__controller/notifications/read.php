<?php

if (isset($_GET["get_all_notifications"]) &&
        ($_GET["get_all_notifications"] == "yes")) {
    
    return_all_notifications();
    
}

if (isset($_GET["get_all_notifications_count"]) &&
        ($_GET["get_all_notifications_count"] == "yes")) {
    
    $notification_count = NotificationFetcher::get_all_notification_count();
    
    echo json_encode(array("is_result_ok" => true, "notification_count" => $notification_count));
    
}
?>





<?php

function return_all_notifications() {
    $return_array = array("is_result_ok" => false);
    
    /**
     * 
     */
    $categorized_notifications_arr = array("Friendship", "MyShopping");
    $notifications_objs_arr_keys = array("friendship", "my_shopping");
    
    foreach ($categorized_notifications_arr as $notification_category_index => $notification_category) {
        // This VAR is like "notifications_friendship_objs_array".
        $notifications_objs_arr_key = "notifications_" . $notifications_objs_arr_keys[$notification_category_index] . "_objs_array";


        $current_class = "Notification" . $notification_category;

        // All user's notifications for a specific Notification type, like "Notifications for Friendship.
        // Ex:
        //    $notifications_my_shopping_objs_array = NotificationMyShopping::read_all($session->actual_user_id);
        //    $notifications_friendship_objs_array = NotificationFriendship::read_all($session->actual_user_id);        
        global $session;
        $notifications_objs_array = $current_class::read_all($session->actual_user_id);



        // Ex
        //    $return_array["notifications_my_shopping_objs_array"] = $notifications_my_shopping_objs_array;
        //    $return_array["notifications_friendship_objs_array"] = $notifications_friendship_objs_array;        
        $return_array[$notifications_objs_arr_key] = $notifications_objs_array;
    }
    

    //
    echo json_encode($return_array);
}
?>