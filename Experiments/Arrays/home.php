<?php
//$an_array = array("a" => 1, "b" => 2, "c" => ["x", "y", "z"]);
$an_array = array();

//$an_array[2] = array("start_date" => "2017-05-02 08:04:53");
//$an_array[3] = array("start_date" => "2017-05-02 07:04:53");

//foreach ($an_array as $key => $value) {
//    echo "key: {$key} <=====> value: {$value}";
//}

//$myJSON = json_encode($an_array);

//echo $myJSON;

for ($i = 0; $i < 3; $i++) {
    $an_array[$i] = array("start_date" => "2017-05-02 08:04:53");
}

$an_array[4] = $an_array[2];

//echo "<pre>";
//print_r($an_array);
//echo "</pre>";
//
//echo "<br>";
//echo ($an_array[2]["start_date"] <= $an_array[3]["start_date"]) ? "truey" : "falsey";
//foreach ($an_array as $value) {
//    echo "{$value['start_date']}<br>";
//}
echo "BEFORE<br>";
echo "an_array[2]";
echo "<pre>";
print_r($an_array[2]);
echo "</pre>";

echo "an_array[4]";
echo "<pre>";
print_r($an_array[4]);
echo "</pre>";




$an_array[2]['start_date'] = "tae tae";
echo "AFTER<br>";
echo "an_array[2]";
echo "<pre>";
print_r($an_array[2]);
echo "</pre>";

echo "an_array[4]";
echo "<pre>";
print_r($an_array[4]);
echo "</pre>";






//$an_array[2]['start_date'] = "tae tae";
$an_array[4] = $an_array[2];
echo "AFTER AFTER<br>";
echo "an_array[2]";
echo "<pre>";
print_r($an_array[2]);
echo "</pre>";

echo "an_array[4]";
echo "<pre>";
print_r($an_array[4]);
echo "</pre>";
?>
