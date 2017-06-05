<?php
session_start();

if (isset($_POST['set_session_user_name'])) {
    $_SESSION['user_name'] = $_POST['user_name'];
    echo "1";
}
?>