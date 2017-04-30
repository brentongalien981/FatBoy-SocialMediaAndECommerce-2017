<?php
for ($i = 0; $i < 10; $i++) {
    $an_id = md5(uniqid(rand(), true));
    echo $an_id;
//    echo uniqid(rand(), true);
    echo "<br>";
}

?>