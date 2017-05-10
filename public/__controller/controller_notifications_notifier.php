<?php
// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_sales_notification.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php");        ?>











<?php

// TODO: SECTION: Function.
function get_new_notifications() {
    global $session;
    $query = "SELECT * FROM SalesNotification ";
    $query .= "WHERE notified_user_id = {$session->actual_user_id} ";
    $query .= "AND is_active = 1";

    $record_results = SalesNotification::read_by_query($query);

    return $record_results;
}

//function set_notification_old($ids_of_old_notifications) {
function set_notification_old($id) {

    $query = "UPDATE SampleNotifications ";
    $query .= "SET is_new = 0 ";
//    $query .= "WHERE id = IN (";
    $query .= "WHERE id = {$id}";

    InvoiceItem::read_by_query($query);
}
?>




<?php
// TODO: SECTION: Meat.
if (isset($_POST["notification_fetcher"]) &&
        ($_POST["notification_fetcher"] == "active")) {

//    //
//    echo "yea PHP was called";
//    echo "<script>";
//    echo "window.alert('tae tae');";
//    echo "</script>";
    //
    $new_notifications_record_results = get_new_notifications();

    //
    global $database;
    $num_of_new_notifications = $database->get_num_rows_of_result_set($new_notifications_record_results);



    //
    global $session;
    $session->set_num_of_notifications($num_of_new_notifications);


    //
    if ($num_of_new_notifications >= 0) {
        echo "{$num_of_new_notifications}";
    }

    return;
    // TODO: DEBUG
//    echo "<h3>shit</h3>";
}


if (isset($_POST["notification_name"])) {
    $notification_name = $_POST["notification_name"];

    $query = "INSERT INTO SampleNotifications ";
    $query .= "VALUES (NULL, '{$notification_name}', 1)";

    InvoiceItem::read_by_query($query);
}
?>













<script>
// Global variables
    var interval_handle;
    var count = 0;
    var update_interval = 3000;

    window.onload = function () {
//        interval_handle = setInterval(start_notification_fetcher, update_interval);
    };







    function start_notification_fetcher() {
        var xhr = new XMLHttpRequest();

        var url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_notifications_notifier.php";
//        var url = "../__controller/controller_notifications_fetcher.php";
        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            console.log('readyState: ' + xhr.readyState);
            if (xhr.readyState == 2) {
//            target.innerHTML = 'Loading...';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {

                // Basically, if there's no actual values echoed or returned in html form,
                // don't do anything.
                if (xhr.responseText.trim().length == 0) {
                    return;
                }

                // If the number of new notifications is 0
                if (xhr.responseText.trim() == 0) {
                    document.getElementById("span_num_of_notifications").style.display = "none";
                } else {
                    // Else, the # of new notifications is positive.
                    document.getElementById("span_num_of_notifications").style.display = "inline";
                    document.getElementById("span_num_of_notifications").innerHTML = xhr.responseText.trim();
                }


            }
        }

        var post_key_value_pairs = "notification_fetcher=active";
        xhr.send(post_key_value_pairs);

    }
</script>











