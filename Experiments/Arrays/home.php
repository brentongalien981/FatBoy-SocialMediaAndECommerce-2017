<?php
$an_array = array("a" => 1, "b" => 2, "c" => ["x", "y", "z"]);

//foreach ($an_array as $key => $value) {
//    echo "key: {$key} <=====> value: {$value}";
//}

$myJSON = json_encode($an_array);

echo $myJSON;
?>
