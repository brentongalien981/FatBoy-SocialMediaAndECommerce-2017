<?php // require_once("../private/includes/initializations.php");   ?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");   ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // include("_layouts/header.php"); ?>
<?php //define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>







<?php
//global $session;
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/log_in.php");
}
?>





<!--Meat-->
<?php
//
if (isset($_GET["is_viewing_actual_user_again"])) {
    $session->reset_currently_viewed_user();
    
    redirect_to(LOCAL . "/public/index.php");
}
?>
