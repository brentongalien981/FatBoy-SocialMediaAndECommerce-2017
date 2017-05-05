<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../../_layouts/header.php"); ?>
<?php // require_once("../__controller/controller_my_videos.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>





<!--sub-menus nav-->
<!--I'm currently adding this for my store page.-->
<a href="#">MySales</a>
<a href="#">MySales Graph</a>
</nav>






<!--Meat-->
<?php
// Decide which main content to display based on the GET param.
if (isset($_GET["transaction_content_page"])) {
    $transaction_content_page = $_GET["transaction_content_page"];

    if (($transaction_content_page > 0) && ($transaction_content_page < 4)) {
        require_once("sub_menu_content{$transaction_content_page}.php");
    } else {
        require_once("sub_menu_content1.php");
    }
} else {
    require_once("sub_menu_content1.php");
}
?>








<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_my_store.css';  ?>" rel="stylesheet" type="text/css" />-->
<style>   
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_store.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MySales";
</script>







<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
