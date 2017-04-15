<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php
require_once("../__model/session.php");
?>




<?php
//global $session;
if ($session->is_logged_in()) {
    $session->logout();
}
redirect_to("../index.php");
?>