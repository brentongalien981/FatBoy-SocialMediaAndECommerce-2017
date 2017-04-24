<?php
$adr = "";

//$_SESSION["adr"] = null;

//$adr = $_SESSION["adr"];

if (isset($_SESSION["adr"])) {
    echo "set";
}
else {
    echo "not set";
}

echo "<br>{$_SESSION['adr']}";
?>

