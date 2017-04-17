<?php
if (isset($_POST["input1"])) {
   echo "input1: {$_POST['input1']}";
   
    header("Location: home.php");
    exit;
}

?>

<a href="home.php">go to home.php</a>
