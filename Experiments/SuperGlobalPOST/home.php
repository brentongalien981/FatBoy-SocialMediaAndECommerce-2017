<?php
if (isset($_POST["input1"])) {
   echo "input1: {$_POST['input1']}";
}

?>

<form action="home2.php" method="post">
    <input type="text" name="input1">
    <input type="submit" name="submit">
</form>

<a href="home2.php">go to home2.php</a>