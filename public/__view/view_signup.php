<?php // require_once("../../private/includes/initializations.php");       ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");       ?>
<?php include("../_layouts/header.php"); ?>




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
if ($session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>






<main id="middle_content">

    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <!--I'm currently adding this for my store page.-->
        <a href="#">Sub-menu1</a>
        <a href="#">Sub-menu2</a>
    </nav>





    <div class="section">
        <h4>Sign-up</h4>

        <form id="formAdminCreation" action="../__controller/controller_signup.php" method="post">
            <?php echo get_csrf_token_tag(); ?>
            <h4>Email</h4>
            <input type="text" name="email"><br>            
            <h4>Username</h4>
            <input type="text" name="user_name"><br>
            <h4>Password</h4>
            <input type="password" name="password"><br>

            <!--<h4>User Type</h4>
            <select name="userTypeId">
                <option value="1">owner</option>
                <option value="2">admin</option>
                <option value="3">user</option>
            </select><br><br>-->

            <input type="submit" name="sign_up" value="sign-up">
        </form>
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