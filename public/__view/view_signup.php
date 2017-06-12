<?php // require_once("../../private/includes/initializations.php");           ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");           ?>
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
        <!--<a href="#">Sub-menu1</a>-->
        <!--<a href="#">Sub-menu2</a>-->
    </nav>








    <form id="formAdminCreation" action="../__controller/controller_signup.php" method="post"  class="section">
        <h4>Sign-up</h4>            

        <?php echo get_csrf_token_tag(); ?>
        <h5>Email</h5>
        <input type="text" name="email" class="form_text_input"><br>            
        <h5>Username</h5>
        <input type="text" name="user_name" class="form_text_input"><br>
        <h5>Password</h5>
        <input type="password" name="password" class="form_text_input"><br>

        <!--<h4>User Type</h4>
        <select name="userTypeId">
            <option value="1">owner</option>
            <option value="2">admin</option>
            <option value="3">user</option>
        </select><br><br>-->

        <input type="submit" name="sign_up" value="sign-up" class="form_button">
    </form>

















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
        /*background-color: rgb(245, 245, 245);*/
        background-color: rgb(240, 252, 255);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);

    }    



    form {
        /*margin: 30px;*/
        /*        padding: 20px;
                border-radius: 5px;
                background-color: beige;
                color: black;*/
    }

    form h5 {

        font-size: 12px;
        font-weight: 100;
        margin-top: 20px;
        margin-bottom: 7px;
    }

    form h4 {
        font-size: 14px;
        font-weight: 400;
    }

    input.form_text_input {
        width: 200px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
        border: 1px solid rgb(230, 230, 230);
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