<?php // require_once("../../private/includes/initializations.php");    ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");    ?>
<?php include("../_layouts/header.php"); ?>








<?php
// If the user is already logged-in, just redirect to home page.
//global $session;
if ($session->is_logged_in()) {
    redirect_to("../index.php");
}
?>





<main id="middle_content">

    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <!--I'm currently adding this for my store page.-->
        <a href="#">Sub-menu1</a>
        <a href="#">Sub-menu2</a>
    </nav>





    <h4>Log-in</h4>

    <form id="formAdminCreation" action="../__controller/controller_log_in.php" method="post">
        <?php echo get_csrf_token_tag(); ?>
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

        <input type="submit" name="log_in" value="log-in">
    </form>





    <?php
// TODO: LOG
    if (MyDebugMessenger::is_initialized()) {
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
    }
    ?>

</main>





<!--<link href="../_styles/header.css" media="all" rel="stylesheet" type="text/css" />-->
<style>
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