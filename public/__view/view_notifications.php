<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_notifications.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php");   ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_my_store_items.php");   ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>











<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<main id="middle_content">

    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <!--<a id="tae" href="#">Sub-menu1</a>-->
    </nav>












    <?php
// TODO: SECTION: Functions.
    ?>












    <?php
// TODO: SECTION: Meat.
    show_sales_notifications();
    ?>










    <?php
// TODO: SECTION: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>






<?php
// TODO: SECTION: Styles.
?>
<!--<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />-->
<style>   
    #middle_content {
        background-color: rgb(250, 250, 250);
        padding-bottom: 30px;
        color: black;
    }

    #sub_menus_nav {
        background-color: rgb(60, 60, 60);
    }#sub_menus_nav a {
        color: rgb(220, 220, 220);
    }

    #menu_notifications {
        /*background-color: rgb(60, 60, 60);*/
        background-color: rgb(250, 250, 250);
    }

    .section {
        background-color: rgb(245, 245, 245);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);


    }    

    /*    div#sales_notifications table td {
            color: black;
        }*/

    div#sales_notifications table {
        padding: 0;
        margin: 0;
        margin-top: 15px;
        /*background-color: pink;*/
        color: black;
        font-size: 12px;
        font-weight: 100;
    }
</style>






<script>document.getElementById("title").innerHTML = "Notifications / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>