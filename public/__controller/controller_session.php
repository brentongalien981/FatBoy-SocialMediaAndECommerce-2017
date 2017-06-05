<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php

// Protected page.
//global $session;
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php
// TODO: SECTION: Functions.
if (isset($_POST['input_currently_viewed_user_id'])) {
    global $session;
    
//    $session->currently_viewed_user_id = ;        
    $session->set_currently_viewed_user($_POST['input_currently_viewed_user_id'], $_POST['input_currently_viewed_user_name']);
//    $_SESSION['user_name'] = $_POST['user_name'];
    echo "1";
}
?>
