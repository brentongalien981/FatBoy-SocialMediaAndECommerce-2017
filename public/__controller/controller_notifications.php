<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_sales_notification.php");  ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>











<?php

// TODO: SECTION: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// TODO: SECTION: Functions.
function delete_sales_notification() {
    SalesNotification::delete($_GET["sales_notification_id"]);
    
    redirect_to(LOCAL . "/public/__view/view_notifications.php");
}

function get_new_notifications_records() {
    global $session;
    $query = "SELECT sn.id, sn.notified_user_id, sn.notifier_user_id, sn.invoice_item_id, ";
    $query .= "ii.invoice_id, ";
    $query .= "msi.name, ";
    $query .= "u.user_name ";
    $query .= "FROM SalesNotification sn ";
    $query .= "INNER JOIN InvoiceItem ii ON sn.invoice_item_id = ii.id ";
    $query .= "INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id ";
    $query .= "INNER JOIN Users u ON sn.notifier_user_id = u.user_id ";
    $query .= "WHERE sn.notified_user_id = {$session->actual_user_id} ";
    $query .= "AND sn.is_active = 1";

    $record_results = SalesNotification::read_by_query($query);

    return $record_results;
}


function show_sales_notifications() {
    echo "<div id='sales_notifications' class='section'>";
    echo "<h4>Sales Notifications</h4>";
//    echo "<hr>";
    echo "<table>";

    //
    $new_notifications_records = get_new_notifications_records();

    //
    global $database;
    while ($row = $database->fetch_array($new_notifications_records)) {
        // Output should be:
        // Bren's Store updated the status of the item PS4 you bought.
        // Seller's name : Item's name.
        echo "<tr>";
        
        echo "<td>";
        echo "{$row['user_name']}'s Store updated the status of the item \"{$row['name']}\" you bought.";
        echo "</td>";
      
        
        echo "<td>";
        echo "<a href='" . LOCAL.  "/public/__view/view_store_cart/index.php?store_content_page=2&shopping_history_item_status_update=yes&invoice_id={$row['invoice_id']}&invoice_item_id={$row['invoice_item_id']}'>view</a>";
        echo "</td>";  
        
        echo "<td>";
        echo "<a href='" . LOCAL . "/public/__controller/controller_notifications.php?is_notification_seen=yes&sales_notification_id={$row['id']}'>delete</a>";
        echo "</td>";          
        
        echo "</tr>";
    }


    echo "</table>";
    echo "</div>";
}
?>












<?php

// TODO: SECTION: Meat.
if (isset($_GET["is_notification_seen"])) {
//    echo "<h1>{$_GET['is_notification_seen']}</h1>";
    delete_sales_notification();
}
?>