<?php
$an_array = array();

for ($i = 0; $i < 10; $i++) {
   $an_array[$i] = 0;
}

for ($i = 0; $i < 100; $i++) {
   $random_int = rand(0, 9); 
   $an_array[$random_int] = $an_array[$random_int] + 1;
}

echo "<pre>";
print_r($an_array);
echo "</pre>";
?>