<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/my_user.php"); ?>

<?php //define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php
// If the user is already logged-in, just redirect to home page.
//global $session;
if ($session->is_logged_in()) {
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
// TODO: This is temporary. Implement the PHP mailer system.
if (isset($_POST["log_in"])) {

    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    
//    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
//    $logging_user = User::authenticate_with_user_object_return($user_name, $hashed_password);
    $logging_user = User::authenticate_with_user_object_return($user_name);
    
    
    
    if ($logging_user) {
        //
        $do_passwords_match = password_verify($password, $logging_user->hashed_password);
        
        if ($do_passwords_match) {
            $session->login($logging_user);
            echo "<br>{$logging_user->user_name} is now logged-in.<br>";
            
            // TODO: DEBUG
            echo "<pre>";
            print_r($logging_user);
            echo "</pre>";
            
            echo "<pre>";
            print_r($session);
            echo "</pre>";            
            
            // TODO: DEBUG
//            MyDebugMessenger::add_debug_message("Log-in authenticated.");
//            MyDebugMessenger::add_debug_message("<pre>");
//            MyDebugMessenger::add_debug_message($logging_user->);
//            MyDebugMessenger::add_debug_message("</pre>");
            redirect_to("../index.php");
        }
        else {
            MyDebugMessenger::add_debug_message("Username/password can not be authenticated.");
        }
    }
    else {
        MyDebugMessenger::add_debug_message("Username/password can not be found.");
    }
}
?>





<?php
redirect_to("../__view/view_log_in.php");
?>