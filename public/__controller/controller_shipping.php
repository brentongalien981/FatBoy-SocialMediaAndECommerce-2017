<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_store_cart.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function show_shipping_form() {
    
}
?>




<!--Meat-->
<?php

?>