<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_friendship_notification.php"); ?>






<?php
// Protected page.
if ((!$session->is_logged_in()) || (!$session->is_viewing_own_account())) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function delete_friendship_notification($friend_id) {
    global $session;
    
    $notified_user_id = $session->actual_user_id;
    $notifier_user_id = $friend_id;
    $dub_request_id = 1;
    
    //
    $query = "DELETE FROM `FriendshipNotifications` WHERE notified_user_id = {$notified_user_id} AND notifier_user_id = {$notifier_user_id} AND notification_type_id = {$dub_request_id}";
    
    
    //
    $is_deletion_ok = FriendshipNotification::delete_by_query($query);
    
    
    //
    if ($is_deletion_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS deleting entry to from 'FriendshipNotifications' bruh..");
    }
    else {
        MyDebugMessenger::add_debug_message("FAIL deleting entry to from 'FriendshipNotifications' bruh..");
    }
    
    
    //
    redirect_to("../__view/view_friends.php");
}

function delete_confirmed_friendship_notification() {
    global $session;
    
    $notified_user_id = $session->actual_user_id;
    $notifier_user_id = $_POST["friend_id"];
    $dub_acceptance_id = 2;
    
    //
    $query = "DELETE FROM `FriendshipNotifications` WHERE notified_user_id = {$notified_user_id} AND notifier_user_id = {$notifier_user_id} AND notification_type_id = {$dub_acceptance_id}";
    
    
    //
    $is_deletion_ok = FriendshipNotification::delete_by_query($query);
    
    
    //
    if ($is_deletion_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS deleting entry to from 'FriendshipNotifications' bruh..");
    }
    else {
        MyDebugMessenger::add_debug_message("FAIL deleting entry to from 'FriendshipNotifications' bruh..");
    }
    
    
    //
    redirect_to("../__view/view_friends.php");
}
?>




<!--Meat-->
<?php
if (isset($_POST["okd_friendship"])) {
    delete_confirmed_friendship_notification();
}

if (isset($_POST["create_friendship_notification"])) {

//    global $connection;
    //
    $notified_user_id = $_POST["friend_id"];
    $notifier_user_id = $session->actual_user_id;
    $dub_request_id = 1; // This is a default value from table NotificationTypes.
    //
    $new_friendship_notification = new FriendshipNotification();
    $new_friendship_notification->notified_user_id = $notified_user_id;
    $new_friendship_notification->notifier_user_id = $notifier_user_id;
    $new_friendship_notification->notification_type_id = $dub_request_id;

    $is_creation_ok = $new_friendship_notification->create_with_bool();

    if ($is_creation_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS creating entry to table 'FriendshipNotification' bruh..");

        //
        $_SESSION["alert_message"] = "<script>window.alert('Your friendship request has been sent');</script>";
    } else {
        MyDebugMessenger::add_debug_message("FAIL! There's an error with the create query to table 'FriendshipNotification' bro...<br>" .
                "or you've already befriended the same person...");
    }


    //
    redirect_to("../__view/view_friends.php");
}

if (isset($_POST["reject_friend_request"])) {
    // 
    $notified_user_id = $session->actual_user_id;
    $notifier_user_id = $_POST["friend_id"];
    $dub_request_id = 1;


    //
    $query = "DELETE FROM `FriendshipNotifications` WHERE notified_user_id = {$notified_user_id} AND notifier_user_id = {$notifier_user_id} AND notification_type_id = {$dub_request_id} LIMIT 1";


    //
    $is_deletion_ok = FriendshipNotification::delete_by_query($query);


    // 
    if ($is_deletion_ok) {
        MyDebugMessenger::add_debug_message("SUCCES deleting friendship notification record.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL deleting friendship notification record.");
    }

    //
    redirect_to("../__view/view_friends.php");
}

//
if (isset($_POST["accept_friend_request"])) {
    // 
    $notified_user_id = $_POST["friend_id"];
    $notifier_user_id = $session->actual_user_id;
    $dub_request_id = 2;


    //
//    $query = "INSERT INTO `FriendshipNotifications` (`notified_user_id`, `notifier_user_id`, notification_type_id) VALUES ({$notified_user_id}, {$notifier_user_id}, {$dub_acceptance_id})";    
    $new_friendship_acceptance_notification_record = new FriendshipNotification();
    $new_friendship_acceptance_notification_record->notified_user_id = $notified_user_id;
    $new_friendship_acceptance_notification_record->notifier_user_id = $notifier_user_id;
    $new_friendship_acceptance_notification_record->notification_type_id = $dub_request_id;

    $is_creation_ok = $new_friendship_acceptance_notification_record->create_with_bool();


    // 
    if ($is_creation_ok) {
        MyDebugMessenger::add_debug_message("SUCCES creating friendship acceptance notification record.");

        //
        require_once("controller_friends.php");

        //
        create_new_friendship($notified_user_id);
    } else {
        MyDebugMessenger::add_debug_message("FAIL creating friendship acceptance notification record.");

        //
        redirect_to("../__view/view_friends.php");
    }
}
?>