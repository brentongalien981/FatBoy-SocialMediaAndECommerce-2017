<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice.php");          ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php

// TODO: SECTION: Function.

?>




<?php

// TODO: SECTION: Meat.
if (isset($_GET["ad_id"])) {
//    echo $_GET["ad_id"];
    echo "<h2>Ad Details of Ad # {$_GET["ad_id"]}.</h2>";
}
?>

