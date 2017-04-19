<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/my_user.php"); ?>
<?php require_once("../__model/model_frienship.php"); ?>






<?php
// Protected page.
if (!$session->is_logged_in()) {
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

//<!--Show all the confirmed friend requests from others. -->
//<!--Here's how it goes.-->
//<!--You made a friend request, and she accepts it.-->
//<!--And so you get notified.-->
//<!--NOTE: That if she rejects it, you won't get any notification.-->
function show_friend_acceptance() {
    //
    global $database;
    global $session;

    $actual_user_id = $session->actual_user_id;
    $dub_acceptance_id = 2;

    $query = "SELECT notified_user_id, notifier_user_id, notification_type_id, user_name ";
    $query .= "FROM FriendshipNotifications ";
    $query .= "INNER JOIN Users ON FriendshipNotifications.notifier_user_id = Users.user_id ";
    $query .= "WHERE FriendshipNotifications.notified_user_id = {$actual_user_id} AND notification_type_id = {$dub_acceptance_id}";

    //
    $friend_acceptances_records_result_set = User::read_by_query($query);


    //
    echo "<h4>Confirmed Friend Requests From Others</h4>";
    echo "<table>";
    while ($row = $database->fetch_array($friend_acceptances_records_result_set)) {
        echo "<tr>";
        echo "<td>" . "{$row['user_name']} accepted your friend request." . "</td>";

//        echo "<td>" . "<a href='friendship_acceptance_deletion.php?friend_id={$row['NotifierUserId']}'>OK</a>" . "</td>";
        echo "<td>";
        echo "<form action='../__controller/controller_friendship_notification.php' method='post'>";
        echo "<input type='hidden' name='friend_id' value='{$row['notifier_user_id']}'>";
        echo "<input type='submit' name='okd_friendship' value='ok'>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}

function show_user_friends() {
    //
    global $database;
    global $session;

    $query = "SELECT * FROM `Users` WHERE user_id IN ( SELECT friend_id FROM Friendship WHERE user_id = {$session->currently_viewed_user_id})";

    //
    $friends_of_user_records_result_set = User::read_by_query($query);

    //
    echo "<h4>My Friends</h4>";
    echo "<table>";
    while ($row = $database->fetch_array($friends_of_user_records_result_set)) {
        echo "<tr>";
        echo "<td>" . "{$row['user_name']}" . "</td>";

        // Here is the form for authenticating the friendship.
        // In other words, this gives the user the ability to click and view
        // a friends account if they're actually friends.
        echo "<td>";
        echo "<form action='../__controller/controller_friends.php' method='post'>";
        echo "<input type='hidden' name='friend_id' value='{$row['user_id']}'>";
        echo "<input type='hidden' name='friend_name' value='{$row['user_name']}'>";
        echo "<input type='submit' name='view_friend_account' value='view'>";
        echo "</form>";
        echo "</td>";


        // If the actual user is viewing her own account, 
        // then show her the button to unfriend her friend.
        if ($session->is_viewing_own_account()) {
            echo "<td>";
            echo "<form action='../__controller/controller_friends.php' method='post'>";
            echo "<input type='hidden' name='friend_id' value='{$row['user_id']}'>";
            echo "<input type='submit' name='unfriend' value='unfriend'>";
            echo "</form>";
            echo "</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}

function authenticate_friendship($actual_user_id, $friend_id, $friend_name) {
    //
    $query = "SELECT * FROM Friendship ";
    $query .= "WHERE (user_id = {$actual_user_id} AND friend_id = {$friend_id}) LIMIT 1";


    //
    global $database;
    $record_of_result_set = Friendship::read_by_query($query);

    //
    $num_of_results = $database->get_num_rows_of_result_set($record_of_result_set);

    if ($num_of_results > 0) {
        //
        global $session;
        $session->set_currently_viewed_user($friend_id, $friend_name);
        MyDebugMessenger::add_debug_message("Friendship is authenticated bruh..");
    } else {
        MyDebugMessenger::add_debug_message("Friendship is NOT authenticated bruh..");
    }


    //
    redirect_to("../index.php");
}

function create_new_friendship($friend_id) {
    global $session;

    MyDebugMessenger::add_debug_message("A new friendship is about to be born.");

    $new_friendship = new Friendship();
    $new_friendship->user_id = $session->actual_user_id;
    $new_friendship->friend_id = $friend_id;

    $is_creation_ok = $new_friendship->create_with_bool();


    // Here, just reciprocate the friendship.
    if ($is_creation_ok) {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("SUCCESS adding the first side of the friendship.");

        $new_friendship = new Friendship();
        $new_friendship->user_id = $friend_id;
        $new_friendship->friend_id = $session->actual_user_id;

        $is_creation_ok = $new_friendship->create_with_bool();

        if ($is_creation_ok) {
            // TODO: LOG
            MyDebugMessenger::add_debug_message("SUCCESS adding the second side of the friendship.");

            //
            require_once("controller_friendship_notification.php");

            //
            delete_friendship_notification($friend_id);
        } else {
            // TODO: LOG
            MyDebugMessenger::add_debug_message("FAIL adding the second side of the friendship.");
        }
    } else {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("FAIL adding the first side of the friendship.");
    }

    redirect_to("../__view/view_friends.php");
}
?>




<!--Meat-->
<?php
if (isset($_POST["view_friend_account"])) {
    //
    $actual_user_id = $session->actual_user_id;
    $friend_id = $_POST["friend_id"];
    $friend_name = $_POST["friend_name"];

    //
    if ($actual_user_id === $friend_id) {
        // echo "YOU ARE JUST TRYING TO VIEW YOUR OWN ACCOUNT";
        MyDebugMessenger::add_debug_message("YOU ARE JUST TRYING TO VIEW YOUR OWN ACCOUNT");
        // So just redirect to homepage.
        //
        $session->reset_currently_viewed_user();

        redirect_to("../index.php");
    } else {
        // echo "Your'e actually trying to view a friend account huh.";
        // 
        authenticate_friendship($actual_user_id, $friend_id, $friend_name);
    }
}



if (isset($_POST["unfriend"])) {
    //
    if (!$session->is_viewing_own_account()) {
        redirect_to("../__view/view_friends.php");
    }


    //
    $actual_user_id = $session->actual_user_id;
    $friend_id = $_POST["friend_id"];


    //
    $query = "DELETE FROM `Friendship` WHERE user_id = {$actual_user_id} AND friend_id = {$friend_id}";


    //
    $is_deletion_ok = Friendship::delete_by_query($query);

    if ($is_deletion_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS deleting 1st part of friendship from the mapping table 'Friendship' bruh..");


        //
        // Reciprocate the deletion of friendship.
        $query = "DELETE FROM `Friendship` WHERE user_id = {$friend_id} AND friend_id = {$actual_user_id}";


        //
        //
        $is_deletion_ok = Friendship::delete_by_query($query);

        if ($is_deletion_ok) {
            MyDebugMessenger::add_debug_message("SUCCESS deleting 2nd part of friendship from the mapping table 'Friendship' bruh..");
        } else {
            MyDebugMessenger::add_debug_message("FAIL deleting 2nd part of friendship from the mapping table 'Friendship' bruh..");
        }
    } else {
        MyDebugMessenger::add_debug_message("FAIL deleting 1st part of friendship from the mapping table 'Friendship' bruh..");
    }


    //
    redirect_to("../__view/view_friends.php");
}
?>