<?php
require_once("session.php");
require_once("functions_general.php");
?>




<?php
//global $session;
if ($session->is_logged_in()) {
    $session->logout();
}
redirect_to("index.php");
?>