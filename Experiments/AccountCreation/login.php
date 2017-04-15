<?php
require_once("session.php");
require_once("my_user.php");
require_once("functions_general.php");
?>

<?php
$user_name = "";
$password = "";
?>





<?php
// If the user is already logged-in, just redirect to home page.
//global $session;
if ($session->is_logged_in()) {
    redirect_to("index.php");
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
            print_r($session);
            print_r($logging_user);
            echo "</pre>";
            redirect_to("index.php");
        }
        else {
            echo "<br>Username/password can not be authenticated.<br>";
        }
    }
    else {
        echo "<br>Username/password can not be found.<br>";
    }
}
?>






<form action="login.php" method="post">
    <h4>Log-in</h4>

    <label>Username</label>
    <input type="text" name="user_name" value="<?php echo $user_name ?>"><br>

    <label>Password</label>
    <input type="password" name="password"><br>

    <input type="submit" name="log_in" value="log-in"><br>
</form>
