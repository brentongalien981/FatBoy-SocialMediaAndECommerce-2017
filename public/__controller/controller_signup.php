<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<?php

echo "controller_signup.php";
?>

<?php

// NOTE: Only user POST requests when making changes.
//       Don't ever use GET changing things. Only use it to read things from the server.
// 1) Avoid CSRF by using csrf tokens as hidden field in your forms.
// 
// 
// 2) Use only allowable GET and POST variables. 
//    Maybe put an array like: $allowed_gets = array();
//    
//    
// 3) Validate inputs.
// 
// 
// 4) Strip tags.
// TODO: Sanitize against html, js, url, mysql, php, cmd.
//    
//    
//    
// 5) Avoid XSS by escaping inputs using functions h() j() u() and maybe s() for sql for output.
//    
//    
// 6) Make 2 versions of variables: "dirty" and "sanitized".
//    Strip html and script tags. Escape single quotes. Strip php tags.
// 7) Sessions on Cookies.
// 8) Check if that username exists in the db.
// 9) Hash the password.
// 10) Store it in db.
?>



<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}

$allowed_assoc_indexes_for_post = array('user_name', 'password');

$dirty_array = [];
$sanitized_array = [];
$can_proceed = false;




// NOTE: Only user POST requests when making changes.
//       Don't ever use GET changing things. Only use it to read things from the server.
// 1) Avoid CSRF by using csrf tokens as hidden field in your forms.
if (is_request_post() && isset($_POST["sign_up"])) {
    if (is_csrf_token_valid()) {
        MyDebugMessenger::add_debug_message("VALID FORM SUBMISSION");
        if (is_csrf_token_recent()) {
            MyDebugMessenger::add_debug_message("CSRF token is recent.");
            $can_proceed = true;
        } else {
            MyDebugMessenger::add_debug_message("CSRF token is NOT recent.");
        }
    } else {
        MyDebugMessenger::add_debug_message("CSRF TOKEN MISSING OR MISMATCHED");
    }
} else {
    // form not submitted or was GET request
    MyDebugMessenger::add_debug_message("Please login.");
}





// 2) Use only allowable GET and POST variables. 
//    Maybe put an array like: $allowed_gets = array();
if ($can_proceed) {
    foreach ($allowed_assoc_indexes_for_post as $assoc_index) {
        if (isset($_POST[$assoc_index])) {
            $dirty_array[$assoc_index] = $_POST[$assoc_index];
        } else {
            $can_proceed = false;
            $dirty_array[$assoc_index] = null;
        }
    }

// TODO: DEBUG
    foreach ($dirty_array as $value) {
        MyDebugMessenger::add_debug_message("VAR ARRAY dirty_array: {$value}.");
    }
}





// 3) Validate inputs.
//
//
if ($can_proceed) {
    MyValidationErrorLogger::initialize();
    
    // Validate that there's no empty, space, or tab only character.
    $required_fields = array("user_name", "password");
    validate_presences($required_fields);

//    // 
//    $fields_with_max_lengths = array("user_name" => 40, "password" => 50);
//    validate_max_lengths($fields_with_max_lengths);
    // Validate the length.
    // For user_name.
    // If the user name's length doesn't meet the requirements, 
    // then log an error.
    if (!has_length($dirty_array["user_name"], ["min" => 8, "max" => 40])) {
        MyValidationErrorLogger::log("User name doesn't meet the length requirements. Min is 8 characters and max is 40 characters.");
    }

    // For password.
    if (!has_length($dirty_array["password"], ["min" => 8, "max" => 50])) {
        MyValidationErrorLogger::log("Password doesn't meet the length requirements. Min is 8 characters and max is 50 characters.");
    }






    // For user_name.
    // Regex: Check if user_name contains invalid chars.
    $my_regex = '/[^a-zA-Z0-9_\-\.]/';
    if (has_format_matching($dirty_array["user_name"], $my_regex)) {
        MyValidationErrorLogger::log("Username contains invalid chars.");
    }

    // For at least 2 numeric chars.
    if (!has_numeric_chars($dirty_array["user_name"], 2)) {
        MyValidationErrorLogger::log("Username does not have at least 2 numeric characters.");
    }

    // For at least 5 letters.
    if (!has_alphabet_chars($dirty_array["user_name"], 5)) {
        MyValidationErrorLogger::log("Username does not have at least 5 alphabet characters.");
    }





    // TODO: NOW: Other validations.    
    // For password.
    // Regex: Check if password contains invalid chars.
    $my_regex = '/[^a-zA-Z0-9_\-\.]/';
    if (has_format_matching($dirty_array["password"], $my_regex)) {
        MyValidationErrorLogger::log("Password contains invalid chars.");
    }

    // For at least 2 numeric chars.
    if (!has_numeric_chars($dirty_array["password"], 3)) {
        MyValidationErrorLogger::log("Password does not have at least 3 numeric characters.");
    }

    // For at least 5 letters.
    if (!has_alphabet_chars($dirty_array["password"], 5)) {
        MyValidationErrorLogger::log("Password does not have at least 5 alphabet characters.");
    }
}





// What you should be checking here is that,
// if the MyValidationErrorLogger is not empty, then ask again for credentials.
if (MyValidationErrorLogger::is_empty()) {
    // Proceed to the next validation step.
    $can_proceed = true;
} else {
    $can_proceed = false;
}


//
// Copy the error messages to the app status messenger.
foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
    MyDebugMessenger::add_debug_message($log_error_msg);
}

MyValidationErrorLogger::reset();







// 4) TODO: NOW: Strip tags.
//    Sanitize against html, js, url, mysql, php, cmd.
//    TODO: Don't forget sanitizing against mysql, php, cmd.
if ($can_proceed) {
    foreach ($allowed_assoc_indexes_for_post as $assoc_index) {
        $dirty_array[$assoc_index] = my_strip_tags($dirty_array[$assoc_index]);
        $dirty_array[$assoc_index] = h($dirty_array[$assoc_index]);
    }
}






// TODO: This is temporary insertion to db.
//       There's gotta be a lot more validations.
$sanitized_array = $dirty_array;
// TODO: DEBUG
//MyDebugMessenger::add_debug_message($additional_message);
echo  "<pre>";
print_r($sanitized_array);
echo "</pre>";






// TODO: This is temporary creation of the user account.
//       In production, you should first use the PHP mailer and send an
//       email for the user to be validated as authentic and not a bot.
if ($can_proceed) {
//    $password = $_POST["password"];
//    $user_name = $_POST["user_name"];
    
    // @@@method password_hash() is built-in.
    $hashed_password = password_hash($sanitized_array["password"], PASSWORD_BCRYPT);

//    $do_passwords_match = password_verify($password, $hashed_password);
    
    $new_user = new User();
    
    $user_type_id_for_regular_user = 1;
    
//    $new_user->user_name = null;
    $new_user->user_name = $sanitized_array["user_name"];
    $new_user->hashed_password = $hashed_password;
    $new_user->user_type_id = $user_type_id_for_regular_user;
    
    $user_creation_result = $new_user->create_with_bool();
    
    if ($user_creation_result) {
//        MyDebugMessenger::clear_debug_message();
        MyDebugMessenger::add_debug_message("We sent you an email at {$user_name}.");
        echo "We sent you an email at {$user_name}.<br>";
        MyDebugMessenger::add_debug_message("Check it to complete your account creation.");
        echo "Check it to complete your account creation.<br>";
        redirect_to("../index.php");
    }
    else {
        echo "FAILURE User creation.";
    }
}





// Redirect after everything.
// TODO: DEBUG: This link is just for debugging. Delete this later.
echo "<a href='../__view/view_signup.php'>go to view_signup.php</a>";
//redirect_to("../__view/view_signup.php");
?>
