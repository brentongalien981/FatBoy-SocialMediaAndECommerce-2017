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
        <a href="index.php?content_page=1">My Videos</a>
        <a href="#">Add Video</a>
    </nav>









    <!--Meat-->
    <?php
// Decide which main content to display based on the GET param.
    if (isset($_GET["content_page"])) {
        $content_page = $_GET["content_page"];

        if (($content_page > 0) && ($content_page < 4)) {
            require_once("sub_menu_content{$content_page}.php");
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

<style>   
/*    #middle_content {
        background-color: beige;
        padding: 30px;
        border-radius: 5px;
        margin-top: 20px;
        padding-bottom: 30px;
    }*/
    #middle_content {
        background-color: rgba(230, 230, 230, 0.8);
        padding-bottom: 30px;
    }



    #sub_menus_nav {
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_store.js"></script>-->
<script>
//    document.getElementById("title").innerHTML = "FatBoy / ";
</script>










<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
