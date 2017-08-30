<?php // require_once("../../private/includes/initializations.php");            ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");            ?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/my_user.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_signup_completion.php");     ?>
<?php //define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php

// TODO: LOG
//if (MyDebugMessenger::is_initialized()) {
//    MyDebugMessenger::show_debug_message();
//    MyDebugMessenger::clear_debug_message();
//}
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<?php

// Make sure the actual user is NOT logged-in.
global $session;
if ($session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>







<?php

// TODO: SECTION: Functions.
function log_in_user($signup_token) {
    $query = "SELECT * FROM Users ";
    $query .= "WHERE signup_token = '{$signup_token}' LIMIT 1";

    $record_result = User::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        global $session;
        $logging_user = User::authenticate_with_user_object_return($row['user_name']);

        if ($logging_user) {
            $session->login($logging_user);
            return true;
        }


    }

    return false;
}



function is_signup_token_valid($token) {
    $query = "SELECT * FROM Users ";
    $query .= "WHERE signup_token = '{$token}'";

    $record_result = User::read_by_query($query);

    global $database;

    if ($database->get_num_rows_of_result_set($record_result) == 1) {
        return true;
    } else {
        return false;
    }
}

function create_user_profile() {
    global $session;
    $query = "INSERT INTO Profile(user_id) VALUES({$session->actual_user_id})";

    $is_creation_ok = User::create_by_query($query);

    if ($is_creation_ok) {
        return true;
    }

    return false;
}

function delete_signup_token($token) {

    $query = "UPDATE Users SET signup_token = NULL";
    $query .= " WHERE signup_token = '{$token}' LIMIT 1";

    $is_update_ok = User::update_by_query($query);

    return $is_update_ok;
}
?>






<?php

$account_validated = "no";
$token = "";
if (isset($_GET['token']) && is_signup_token_valid($_GET['token']) &&
    log_in_user($_GET['token'])) {


    if (create_user_profile() &&
        delete_signup_token($_GET['token'])) {

        $account_validated = "yes";

    }
}


//
redirect_to(LOCAL . "/public/signup_completion_bruh.php?account_validated={$account_validated}");
?>