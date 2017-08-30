<?php // require_once("../../private/includes/initializations.php");           ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");           ?>
<?php include("_layouts/header.php"); ?>
<?php //require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/my_user.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_signup_completion.php");    ?>




<?php
// TODO: LOG
//if (MyDebugMessenger::is_initialized()) {
//    MyDebugMessenger::show_debug_message();
//    MyDebugMessenger::clear_debug_message();
//}
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<?php
// Make sure the actual user is NOT logged-in.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>







<?php

// TODO: SECTION: Functions.
function show_welcome_msg() {
    global $session;
    echo "<h4>Welcome {$session->actual_user_name}</h4>";
    echo "<p>You've successfully created your account.</p>";
//    echo "<p>This account verification came from your email {$row['email']}</p>";    
}

function show_failure_msg() {
    echo "<h4>Sorry, but your account can't be verified.</h4>";
}


?>















<main id="middle_content">

    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a href="#">Sub-menu1</a>
    </nav>





    <div class="section">
        <?php
        if (isset($_GET['account_validated']) && $_GET['account_validated'] == "yes") {

            show_welcome_msg();

        }
        else {
            show_failure_msg();
        }
        ?>
    </div>
















    <?php
// TODO: SECTION: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>





<!--<link href="../_styles/header.css" media="all" rel="stylesheet" type="text/css" />-->
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

    .section {
        background-color: rgb(245, 245, 245);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);

    }    

    form h4 {
        font-size: 80%;
        /*display: block;*/
    }

    .debugMessage {
        color: red;
        font-size: 70%;
    }
</style>










<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>

<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>