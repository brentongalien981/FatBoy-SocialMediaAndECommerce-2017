<?php
require_once("my_user.php");
?>

<?php
$user_name = "";
$password = "";
?>





<?php
// TODO: This is temporary. Implement the PHP mailer system.
if (isset($_POST["sign_up"])) {

    $password = $_POST["password"];
    $user_name = $_POST["user_name"];
    
    // @@@method password_hash() is built-in.
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

//    $do_passwords_match = password_verify($password, $hashed_password);
    
    $new_user = new User();
    
    $user_type_id_for_regular_user = 1;
    
    $new_user->user_name = null;
    $new_user->user_name = $user_name;
    $new_user->hashed_password = $hashed_password;
    $new_user->user_type_id = $user_type_id_for_regular_user;
    
    $user_creation_result = $new_user->create_with_bool();
    
    if ($user_creation_result) {
        echo "We sent you an email at {$user_name}.<br>";
        echo "Check it to complete your account creation.<br>";
    }
    else {
        echo "FAILURE User creation.";
    }
}
?>






<form action="signup.php" method="post">
    <h4>Sign-up</h4>

    <label>Username</label>
    <input type="text" name="user_name" value="<?php echo $user_name ?>"><br>

    <label>Password</label>
    <input type="text" name="password"><br>

    <input type="submit" name="sign_up" value="sign-up"><br>
</form>
