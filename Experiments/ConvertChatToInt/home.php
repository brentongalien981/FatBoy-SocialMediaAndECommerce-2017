<?php
//$str = "tae";
//echo $str[2];

$str = "ABCDabcd";

for ($i = 0; $i < 255; $i++) {
    echo ord($str[$i]) . "<br>";
//    echo "{$i}: " . chr($i) . "<br>";
}


?>