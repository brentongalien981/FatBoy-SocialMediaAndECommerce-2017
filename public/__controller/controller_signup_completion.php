<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PRIVATE_PATH . "/includes/swiftmailer/config.php"); ?>
<?php // define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>

<?php
// TODO: SECTION: Functions.
function show_welcome_msg($signup_token) {
        $query = "SELECT * FROM Users ";
    $query .= "WHERE signup_token = '{$signup_token}' LIMIT 1";
    
    $record_result = User::read_by_query($query);
    
    global $database;
    while ($row = $database->fetch_array($record_result)) {
        echo "<h4>Welcome {$row['user_name']}</h4>";
        echo "<p>You've successfully created your account.</p>";
        echo "<p>This account verification came from your email {$row['email']}</p>";
    }
}

function is_signup_token_valid($token) {
    $query = "SELECT * FROM Users ";
    $query .= "WHERE signup_token = '{$token}' LIMIT 1";
    
    $record_result = User::read_by_query($query);
    
    global $database;
    
    if ($database->get_num_rows_of_result_set($record_result) > 0) {
        return true;
    }
    else {
        return false;
    }
}
?>


