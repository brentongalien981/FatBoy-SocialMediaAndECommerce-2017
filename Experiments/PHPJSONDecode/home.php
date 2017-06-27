<?php

$json_raw = array("index1" => "value1");
$json_encoded = json_encode($json_raw);
$json_decoded = json_decode($json_encoded);

echo "\$json_encoded: {$json_encoded}<br>";
//echo "\$json_decoded['index1']: {$json_decoded['index1']}<br>";

echo "\$json_decoded->{'index1'}: {$json_decoded->{'index1'}}<br>";
