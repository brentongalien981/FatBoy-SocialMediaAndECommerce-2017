<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once("../__controller/controller_friends.php"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>






<!--Meat-->
<?php
//
if ($session->is_viewing_own_account()) {
    //
    show_friend_request_for_me();
    
    // Yes! She accepted my request.
    show_friend_acceptance();
    
    //
    show_non_friends();
}


// 
show_user_friends();
?>



<?php
?>








<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="../_styles/view_friends.css" rel="stylesheet" type="text/css" />
<style>   
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_friends.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / Friends";
</script>







<?php
// Alert.
if (isset($_SESSION["alert_message"])) {
    echo $_SESSION["alert_message"];
    $_SESSION["alert_message"] = null;
}
?>





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
