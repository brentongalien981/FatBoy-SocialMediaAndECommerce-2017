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
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>




<main id="middle_content">



    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a href="index.php?store_content_page=1">MyStore</a>
        <a href="index.php?store_content_page=2">Add Item</a>
        <a href="index.php?store_content_page=3">Edit Item</a>
        <a href="#">Customer's Refund Requests</a>
    </nav>







    <!--Meat-->
    <?php
// Decide which main content to display based on the GET param.
    if (isset($_GET["store_content_page"])) {
        $store_content_page = $_GET["store_content_page"];

        if (($store_content_page > 0) && ($store_content_page < 4)) {
            require_once("sub_menu_content{$store_content_page}.php");
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
</main>







<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_my_store.css'; ?>" rel="stylesheet" type="text/css" />-->
<style>   
    #middle_content {
        background-color: rgb(255, 255, 255);
        /*background-color: beige;*/
        padding-bottom: 30px;
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_store.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "MyStore / FatBoy";
</script>

<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
