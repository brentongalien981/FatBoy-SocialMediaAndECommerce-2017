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





<main id="middle_content">


    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a id="tae" href="#">Sub-menu1</a>
        <a href="#">Sub-menu2</a>
    </nav>

    <div id="main_div">
        <div id="context_sensitive_nav">
            <a href="#">Address</a>
            <a>&gt;</a>
            <a href="#">Edit Address</a>
        </div>






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



            //
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
<link href="../_styles/view_friends.css" rel="stylesheet" type="text/css" />
<style>   
    #main_div {
        background-color: beige;
        /*padding: 30px;*/
        border-radius: 5px;
        margin-top: 20px;
        padding-bottom: 30px;
    }

    #context_sensitive_nav {
        width: 100%;
        background-color: rgba(50, 50, 50, 1.0);
        height: 20px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        color: rgba(200, 200, 200, 1.0);
        font-size: 11px;
        font-weight: 100;
        padding-top: 8px;
    }

    #context_sensitive_nav a {
        /*background-color: gray;*/
        margin-left: 30px;
        /*        padding-top: 3px;
                padding-bottom: 3px;*/
        color: rgba(200, 200, 200, 1.0);
    }

    #context_sensitive_nav a:hover {
        color: orange;

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

    .form_button {
        /*margin-bottom: 30px;*/
        /*margin-top: 20px;*/
        color: black;
        /*        background-color: rgb(200, 200, 200);*/
        background-color: rgba(255, 157, 45, 0.20);
        box-shadow: 3px 3px 3px rgb(130, 130, 130);
        border: 1px solid;
        font-size: 10px;
        font-weight: 100;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
        margin-right: 5px;        
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
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_friends.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += "Friends / FatBoy";
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
