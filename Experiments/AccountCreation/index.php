<?php
require_once("session.php");
?>




<?php
//global $session;
echo "<h4>Welcome";
if ($session->is_logged_in()) {
    echo " {$session->actual_user_name}";
}
echo "</h4>";
?>

<a href="signup.php">Sign-up here</a><br>
<a href="login.php">Sign-in here</a><br>
<a href="logout.php">Sign-out here</a>

<pre>
<?php
print_r($session);
?>
</pre>