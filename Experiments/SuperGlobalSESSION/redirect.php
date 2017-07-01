<?php

session_start();

if (isset($_SESSION['index1'])) {
    echo "\$_SESSION['index1'] is set";
    echo "<pre>";
    echo $_SESSION['index1'];
    echo "<br>";
    echo $_SESSION['index2'];
//    echo "<br>";
//    echo $_SESSION['my_array']["indexb1"];
//    echo "<br>";
//    echo $_SESSION['my_array']["indexb2"];

//    foreach ($_SESSION['my_array'] as $key => $value) {
//        echo "<br>";
//        echo "\$_SESSION['my_array']['{$key}']: {$value}";
//    }
    
    for ($i=0; $i < count($_SESSION['my_array']); $i++) {
        echo "<br>";
        echo "\$_SESSION['my_array'][{$i}]: {$_SESSION['my_array'][$i]}";
    }    

    echo "</pre>";
}
echo "This is page redirect.php";
?>

