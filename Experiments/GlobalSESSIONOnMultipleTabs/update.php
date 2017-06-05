<?php

session_start();

if (isset($_GET['user_name'])) {
    $_SESSION['user_name'] = $_GET['user_name'];
    redirect_to("home.php");
}
?>


<?php
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}
?>