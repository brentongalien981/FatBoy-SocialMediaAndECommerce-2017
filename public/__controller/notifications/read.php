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
    $return_array = array("is_result_ok" => true);
    
    $return_array["categorized_notifications"] = NotificationFetcher::fetch_all_notifications();
    

    //
    echo json_encode($return_array);
}
?>