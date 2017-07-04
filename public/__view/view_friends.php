<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_friends.php"); ?>




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




<main id="middle_content">



    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <!--<a href="" id="sub_nav_chat_with">Sub-menu A</a>-->
    </nav>






    <div id="main_content">
        <!--Meat-->
        <?php
//
        if ($session->is_viewing_own_account()) {
            //
            echo "<div class='section'>";
            show_friend_request_for_me();
            echo "</div>";



            // Yes! She accepted my request.
            echo "<div class='section'>";
            show_friend_acceptance();
            echo "</div>";



            // Suggested friends.
            // TODO: REMINDER: Don't forget to do something about
            // one time users to not show up as suggested friends.
            echo "<div class='section'>";
            show_non_friends();
            echo "</div>";
        }


// 
        echo "<div class='section'>";
        show_user_friends();
        echo "</div>";
        ?>









        <!--Debug/Log-->
        <?php
// TODO: LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>        
    </div>






</main>






<!--Styles-->
<!--<link href="../_styles/view_friends.css" rel="stylesheet" type="text/css" />-->
<style>   

    #middle_content {
        background-color: rgb(250, 250, 250);
        /*padding-bottom: 30px;*/
        color: black;
    }

    #sub_menus_nav {
        background-color: rgb(60, 60, 60);
    }#sub_menus_nav a {
        color: rgb(220, 220, 220);
    }

    #menu_friends {
        /*background-color: rgb(60, 60, 60);*/
        background-color: rgb(250, 250, 250);
    }

    .section {
        background-color: rgba(240, 240, 240, 1.0);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);

    }

    .section table {
        margin-top: 30px;
    }

    .section table td {
        /*vertical-align: bottom;*/
        /*background-color: yellow;*/
        padding: 5px;
        padding-left: 0;
        vertical-align: middle;
        font-size: 13px;
        font-weight: 100;
        color: black;
    }

    #table_user_friends td,
    #table_suggested_friends td {
        padding-bottom: 50px;
        /*background-color: pink;*/
    }


    .form_button {
        margin: 0;  
        margin-top: 10px;
        margin-right: 10px;
    }

    .form_button:hover {
        background-color: rgba(255, 157, 45, 0.50);
        cursor: pointer; cursor: hand;
    }

    #ad_container {
        /*background-color: red;*/
        /*display: none;*/
        /*        visibility: hidden;*/
    }

    #table_suggested_friends img,
    #table_user_friends img {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        background-color: rgb(242, 252, 255);
    }

    #table_suggested_friends h4,
    #table_user_friends h4 {
        font-size: 13px;
        font-weight: 100;
        /*background-color: yellow;*/
    }




    #table_user_friends td {
        /*background-color: pink;*/
    }

    #table_suggested_friends form {
        /*padding: 0;*/
        /*margin: 0;*/
        /*margin-bottom: 30px;*/
        /*background-color: aqua;*/
        display: inline;
    }


    #table_user_friends form {
        display: inline;
        /*background-color: aqua;*/
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_friends.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Friends / FatBoy";
</script>











<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
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
