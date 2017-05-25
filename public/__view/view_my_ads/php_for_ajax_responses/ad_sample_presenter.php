<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice.php");          ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_ad.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php

// TODO: SECTION: Function.

?>




<?php

// TODO: SECTION: Meat.
if (isset($_GET["ad_id"])) {
//    echo $_GET["ad_id"];
    $ad_record_result = get_ad_record($_GET["ad_id"]);
    
    global $database;
    
    while ($row = $database->fetch_array($ad_record_result)) {
        echo "<div class='ad_sample'>";
        echo "<h3>{$row['ad_name']}</h3>";
        
        echo "<div id='ad_sample_container'>";
        echo "<iframe class='ad_iframe' src='{$row['photo_url_address']}'>";
        echo "</iframe>";
        echo "</div>";
        
        echo "<p>{$row['description']}</p>";
        
        echo "</div>";
    }
    
//    echo "<h2>Ad Details of Ad # {$_GET["ad_id"]}.</h2>";
}
?>

