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
// 3) Validate inputs.
//    
//    
// 4) Avoid XSS by escaping inputs using functions h() j() u() and maybe s() for sql.



//    
//    
// 5) Make 2 versions of variables: "dirty" and "sanitized".
// 6) Sanitize against html, js, mysql, php.
//    Strip html and script tags. Escape single quotes. Strip php tags.
// 7) Sessions on Cookies.
?>



<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}




// NOTE: Only user POST requests when making changes.
//       Don't ever use GET changing things. Only use it to read things from the server.
// 1) Avoid CSRF by using csrf tokens as hidden field in your forms.
if (is_request_post()) {
    if (is_csrf_token_valid()) {
        MyDebugMessenger::add_debug_message("VALID FORM SUBMISSION");
        if (is_csrf_token_recent()) {
            MyDebugMessenger::add_debug_message("CSRF token is recent.");
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
$allowed_assoc_indexes_for_post = array('user_name', 'password');

$dirty_array = [];

foreach ($allowed_assoc_indexes_for_post as $assoc_index) {
    if (isset($_POST[$assoc_index])) {
        $dirty_array[$assoc_index] = $_POST[$assoc_index];
    }
    else {
        $dirty_array[$assoc_index] = null;
    }
}

// TODO: DEBUG
foreach ($dirty_array as $value) {
    MyDebugMessenger::add_debug_message("VAR ARRAY dirty_array: {$value}.");
}





// 3) Validate inputs.






redirect_to("../__view/view_signup.php");
?>

