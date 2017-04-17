<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_users_and_likes.php"); ?>




<?php
// Protected page.
global $session;
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<!--Functions-->
<?php

function did_user_already_like_this($actual_user_id, $like_id) {
    // 
    $query = "SELECT * FROM UsersAndLikes ";
    $query .= "WHERE user_id = {$actual_user_id} ";
    $query .= "AND like_id = {$like_id} LIMIT 1";

    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("QUERY: {$query}.");

    //
    $result_set = UsersAndLikes::read_by_query($query);

    // 
    global $database;
    $num_of_rows = $database->get_num_rows_of_result_set($result_set);

    //
    if ($num_of_rows < 1) {
        return false;
    } else {
        return true;
    }
}

function create_mapping_record_bruh($actual_user_id, $like_id) {
    $query = "INSERT INTO UsersAndLikes ";
    $query .= "VALUES (";
    $query .= "{$actual_user_id}, {$like_id})";
    
    $a_mapping_record = new UsersAndLikes();
    $a_mapping_record->user_id = $actual_user_id;
    $a_mapping_record->like_id = $like_id;
    
    return $a_mapping_record->create_with_bool();
}
?>





<!--Meat-->
<?php ?>





<?php
//redirect_to("../__view/view_profile.php");
?>