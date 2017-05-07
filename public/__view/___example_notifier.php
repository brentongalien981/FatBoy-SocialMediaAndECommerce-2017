<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php");     ?>











<?php

// TODO: SECTION: Function.
function get_new_notifications() {
    $query = "SELECT * FROM SampleNotifications ";
    $query .= "WHERE is_new = 1";

    $record_results = InvoiceItem::read_by_query($query);

    return $record_results;
}

//function set_notification_old($ids_of_old_notifications) {
function set_notification_old($id) {

    $query = "UPDATE SampleNotifications ";
    $query .= "SET is_new = 0 ";
//    $query .= "WHERE id = IN (";
    $query .= "WHERE id = {$id}";

    InvoiceItem::read_by_query($query);

//    for ($i = 0; $i < count($ids_of_old_notifications); $i++) {
//        $query .= "{$ids_of_old_notifications[$i]}";
//        
//        if (($i + 1) == count($ids_of_old_notifications)) {
//            // Don't add a comma, cause it's the last id.
//        }
//        else {
//            $query .= ",";
//        }
//    }
//    
//    $query .= ")";
}
?>




<?php

// TODO: SECTION: Meat.
if (isset($_POST["fetch_notification_record"])) {
    //
    $new_notifications_record_results = get_new_notifications();

    //
    $num_of_new_notifications = $database->get_num_rows_of_result_set($new_notifications_record_results);
    if ($num_of_new_notifications > 0) {
        //
        global $database;
        $entire_notification = "";
        
        $notification_script_tag = "";
        
        $ids_of_old_notifications = array();
        while ($row = $database->fetch_array($new_notifications_record_results)) {
            $div_id = 100 - $row['id'];
            
            $entire_notification .= "<h2><a id='link{$row['id']}' class='notification_links' href='#{$div_id}'>view</a>Notification name: {$row['notification_name']}</h2>";
            
//            $notification_script_tag .= "<script>";
//            $notification_script_tag .= "<script>";
//            $notification_script_tag .= "</script>";
            
            
            // TODO: See if you can add your own attribute to an element and access and modify that attribute
            // through js. Like: <div id='myDiv' myAttribute='myValue'></div>. Then 
            // document.getElementById("myDiv").setAttribute("myAttribute", "myValue2");

            // Then set the notification to is_new = 0.
            set_notification_old($row['id']);
//        array_push($ids_of_old_notifications, $row['id']);
        }
        
        
        //
        /*
    

    
        
            

//            document.getElementById("3").style.background = "red";
        
    
         * 
         */
//        $entire_notification .= "<script>";
////        $entire_notification .= "var notification_links_arr = document.getElementsByClassName('notification_links');";
////        $entire_notification .= "for (var i = 0; i < notification_links_arr.length; i++) {";
////            $entire_notification .= "notification_links_arr[i].onclick = function () {";
//                $entire_notification .= "window.alert('clicked');";
////            $entire_notification .= "};";
////        $entire_notification .= "}";
//        $entire_notification .= "</script>";
        
        
        //
        echo $entire_notification;
    }
}


if (isset($_POST["notification_name"])) {
    $notification_name = $_POST["notification_name"];

    $query = "INSERT INTO SampleNotifications ";
    $query .= "VALUES (NULL, '{$notification_name}', 1)";

    InvoiceItem::read_by_query($query);
}
?>











