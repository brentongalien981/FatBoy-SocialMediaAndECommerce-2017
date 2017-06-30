<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_users_and_likes.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




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







<?php
use App\Publico\Model\MyValidationErrorLogger;

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

function delete_user_like_record() {
    //    
    global $session;
    $is_deletion_ok = UsersAndLikes::delete($session->actual_user_id, $_POST["like_id"]);


    // 
    if ($is_deletion_ok) {
        MyDebugMessenger::add_debug_message("SUCCESS deleting a user like.");
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL deleting a user like.");
        return false;
    }
}
?>






<?php

// For like deletion.
if (is_request_post() && isset($_POST["delete_user_like"]) && $_POST["delete_user_like"] == "yes") {
    //
    $allowed_assoc_indexes_for_post = array('like_id');

// These value are for error logs.
    $json_errors_array = array("error_like_id" => "", "is_result_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "");

    $can_proceed = false;

    MyValidationErrorLogger::initialize();





    // Check csrf_token.
    if (is_csrf_token_legit()) {
        $can_proceed = true;

        // TODO:REMINDER: Delete this on production.
        $json_errors_array['POST_csrf_token'] = $_POST['csrf_token'];
        $json_errors_array['SESSION_csrf_token'] = $_SESSION['csrf_token'];
    } else {
        $can_proceed = false;
    }





    // White listing POST vars.
//    $dirty_array = are_post_vars_valid($allowed_assoc_indexes_for_post);
    if ($can_proceed && are_post_vars_valid($allowed_assoc_indexes_for_post)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }





    // Validate inputs.
    $var_lengts_arr = array("like_id" => ["min" => 1, "max" => 9]);

    if ($can_proceed && validate_vars_lengths($var_lengts_arr)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }





    /* Here's I'll know if there's an error overall or not. */
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }

    /* Log the errors. */
    // Put to the JSON array the first error for each error type.
    // Here, basically, one $log_error_msg is like:
    //      csrf_token::: not valid
    // So the returned json_error_array will have:
    //      json.error_csrf_token => "* not valid"
    foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
        MyDebugMessenger::add_debug_message($log_error_msg);
        // Find which field that error is based on "field::: is bad" log_error_msg.
        // $pos = position of :::
        $pos = strpos($log_error_msg, ":::");

        $error_field = "error_" . substr($log_error_msg, 0, $pos);

        // If the error_field in the $json_errors_array doesn't have value yet,
        // add the log_error_msg.
        if ($json_errors_array[$error_field] == "") {
            $json_errors_array[$error_field] = "* " . substr($log_error_msg, $pos + 4);
        }
    }


    MyValidationErrorLogger::reset();






    // Try to add record to db.
    if ($can_proceed && delete_user_like_record()) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }

    echo json_encode($json_errors_array);
}
?>