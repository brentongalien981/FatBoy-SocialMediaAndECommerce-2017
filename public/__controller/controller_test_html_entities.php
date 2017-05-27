<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_test_html_entities.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php
//// Protected page.
////global $session;
//if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
//    redirect_to("../index.php");
//}
?>





<?php
// TODO: LOG
//if (!MyDebugMessenger::is_initialized()) {
//    MyDebugMessenger::initialize();
//}
?>






<?php

function z() {
    
}

;
?>






<?php
// For like addition.
if (isset($_POST["chat_msg"])) {
//    echo $_POST["chat_msg"];

    $query = "INSERT INTO TestHtmlEntities VALUES(NULL, '{$_POST['chat_msg']}')";
    $is_creation_ok = TestHtmlEntities::create_by_query($query);

    if ($is_creation_ok) {
        echo "SUCCESS posting chat to db.";
    } else {
        echo "FAIL posting chat to db.";
    }
}

if (isset($_POST["decode"])) {
//    echo $_POST["decode"];

    $query = "SELECT * FROM TestHtmlEntities WHERE id = 2";
    $result_set = TestHtmlEntities::read_by_query($query);


    global $database;
    while ($row = $database->fetch_array($result_set)) {
        echo $row['value'];
    }
}
?>
