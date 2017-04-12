<?php
session_start();
require_once 'functions_csrf_request_type.php';
require_once 'functions_csrf_token.php';

if (is_request_post()) {
    if (is_csrf_token_valid()) {
        $message = "VALID FORM SUBMISSION";
        if (is_csrf_token_recent()) {
            $message .= " (recent)";
        } else {
            $message .= " (not recent)";
        }
    } else {
        $message = "CSRF TOKEN MISSING OR MISMATCHED";
    }
} else {
    // form not submitted or was GET request
    $message = "Please login.";
}
?>
<html>
    <head>
        <title>CSRF Demo</title>
    </head>
    <body>
        <?php echo $message; ?><br />
        <form action="" method="post">
            <?php echo get_csrf_token_tag(); ?>
            Username: <input type="text" name="username" /><br />
            Password: <input type="password" name="password"><br />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
