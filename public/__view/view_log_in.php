<?php // require_once("../../private/includes/initializations.php");     ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");     ?>
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
            <!--<a href="#">Sub-menu1</a>-->
            <!--<a href="#">Sub-menu2</a>-->
        </nav>


        <form id="formAdminCreation" action="../__controller/controller_log_in.php" method="post" class="section">
            <h4>Log-in</h4>
            <?php echo get_csrf_token_tag(); ?>
            <h5>Username</h5>
            <input id="user_name" type="text" name="user_name" class="form_text_input"><br>
            <h5>Password</h5>
            <input id="password" type="password" name="password" class="form_text_input"><br>

            <!--<h4>User Type</h4>
            <select name="userTypeId">
                <option value="1">owner</option>
                <option value="2">admin</option>
                <option value="3">user</option>
            </select><br><br>-->

            <input type="submit" name="log_in" value="log-in" class="form_button">
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
        #middle_content {
            background-color: rgb(250, 250, 250);
            padding-bottom: 30px;
            color: black;
        }

        #sub_menus_nav {
            background-color: rgb(60, 60, 60);
        }

        #sub_menus_nav a {
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

    <!--Scripts-->
    <script src="<?php echo LOCAL . "/public/_scripts/login/tasks.js"; ?>"></script>


<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>