<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/my_user.php"); ?>






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
function show_non_friends() {
    //
    global $database;
    global $session;

    $query = "SELECT user_id, user_name ";
    $query .= "FROM Users ";
    $query .= "WHERE user_id NOT IN ";
    $query .= "(";
    $query .= "SELECT friend_id ";
    $query .= "FROM Friendship ";
    $query .= "WHERE user_id = {$session->actual_user_id}";
    $query .= ") ";
    $query .= "AND user_id != {$session->actual_user_id} ";

    // Also, don't suggest users that are currently in pending friendship status with you.
    $query .= "AND user_id NOT IN (";
    $query .= "SELECT notified_user_id ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "WHERE notifier_user_id = {$session->actual_user_id}) ";

    $query .= "AND user_id NOT IN (";
    $query .= "SELECT notifier_user_id ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "WHERE notified_user_id = {$session->actual_user_id})";


    //
    $non_friends_records_result_set = User::read_by_query($query);


    // If the code goes here, the query is ok.
    echo "<br><br><br>";
    echo "<h4>Suggested Friends</h4>";
    echo "<table>";
    while ($row = $database->fetch_array($non_friends_records_result_set)) {
        echo "<tr>";
        echo "<td>" . "{$row['user_name']}" . "</td>";
        echo "<td>";
        echo "<form action='../__controller/controller_friendship_notification.php' method='post'>";
        echo "<input type='submit' name='create_friendship_notification' value='add friend'>";
        echo "<input type='hidden' name='friend_id' value='{$row['user_id']}'>";
        echo "</form>";
        echo "</td>";

        // TODO: It is supposed to be like this:
        // TODO: "<td>" . "<a href='friendship_notification_creation.php?friend_id={$row['UserId']}'>add</a>" . "</td>";
//            echo "<td><a>add</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function show_friend_request_for_me() {
    //
    global $database;
    global $session;

    $actual_user_id = $session->actual_user_id;
    $dub_request_id = 1;

    $query = "SELECT notified_user_id, notifier_user_id, notification_type_id, user_name ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "INNER JOIN Users ON FriendshipNotifications.notifier_user_id = Users.user_id ";
    $query .= "WHERE FriendshipNotifications.notified_user_id = {$actual_user_id} AND notification_type_id = {$dub_request_id}";

    //
    $friend_requests_records_result_set = User::read_by_query($query);


    // If the code goes here, the query is ok.
    echo "<h4>Friend Requests From Others</h4>";
    echo "<table>";
    while ($row = $database->fetch_array($friend_requests_records_result_set)) {
        echo "<tr>";
        echo "<td>" . "{$row['user_name']} wants to admire you." . "</td>";
        // TODO: NOW
//        echo "<td>" . "<a href='friendship_acceptance_creation.php?friend_id={$row['notifier_user_id']}'>accept</a>" . "</td>";
        echo "<td>";
            echo "<form action='../__controller/controller_friendship_notification.php' method='post'>";
                echo "<input type='hidden' name='friend_id' value='{$row['notifier_user_id']}'>";
                echo "<input type='submit' name='accept_friend_request' value='accept'>";
            echo "</form>";
        echo "</td>";
        
        
        echo "<td>";
            echo "<form action='../__controller/controller_friendship_notification.php' method='post'>";
                echo "<input type='hidden' name='friend_id' value='{$row['notifier_user_id']}'>";
                echo "<input type='submit' name='reject_friend_request' value='reject'>";
            echo "</form>";
        echo "</td>";
        
        
        echo "</tr>";
    }
    echo "</table>";
}

function create_new_friendship($friend_id) {
    MyDebugMessenger::add_debug_message("A new friendship is about to be born.");
    
    redirect_to("../__view/view_friends.php");
}
?>




<!--Meat-->
<?php
?>