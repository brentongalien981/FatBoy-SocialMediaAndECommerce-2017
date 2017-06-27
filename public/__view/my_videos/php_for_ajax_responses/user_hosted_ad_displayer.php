<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice.php");          ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_ad.php"); ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php

// TODO: SECTION: Function.

?>




<?php

// TODO: SECTION: Meat.
if (isset($_POST["currently_viewed_user_id"])) {
    //
    show_ad($_POST["currently_viewed_user_id"]);
    
    //
//    echo "ajax is ok";
}
?>

