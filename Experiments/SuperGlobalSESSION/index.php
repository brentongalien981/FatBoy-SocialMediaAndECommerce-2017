<?php
session_start();


if (isset($_GET['my_array'])) {
    $_SESSION['my_array'] = array("q1" => "SELECT * FROM Tae", "indexb2" => "SELECT * FROM Shit");
    $_SESSION['index1'] = "value1";
    $_SESSION['index2'] = "value2";
    header("Location: http://localhost/myPersonalProjects/FatBoy/Experiments/SuperGlobalSESSION/redirect.php");
}

?>