<?php // require_once("../private/includes/initializations.php");                                   ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");                                   ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");                                   ?>
<?php require_once("_layouts/header.php"); ?>
<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy");           ?>

<?php
// TODO: REMINDERS: 
//      - Edit the code so that long posts be truncated and not go past 
//        beyond the width of the 600px.
?>




<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>


<main id="middle_content">

    <nav id="sub_menus_nav">
        <a id="create_post_link">+ Create Post</a>
    </nav>


    <div id="main_content">
        <?php
        if ($session->is_logged_in()) {
            echo "<form id='create_post_form' class='animated'>";
//        echo get_csrf_token_tag();
            echo "<textarea id='message_post_textarea' rows='6' cols='100' placeholder='say em to us...'></textarea><br>";

            echo "<input id='create_post_button' type='button' class='form_buttons' value='post!'>";
            echo "<input id='cancel_create_post_button' type='button' class='form_buttons' value='cancel'>";
            echo "</form>";


            // This is just a refernce node for appending new post element...

            echo "<div id='div_tae'>";
            echo "</div>";
        }
        ?>


        <!--Meat-->
        <?php
        // TODO: Show timeline notifications.
        // TODO: A lot yet to be done. Timeline post form, timeline notification, etc.


        if ($session->is_logged_in()) {
//
//        echo "<h3>Timeline";
//        echo " {$session->currently_viewed_user_name}";
//        echo "</h3><br>";
            // This file takes care of the query for getting all the timeline posts.
            require_once("__controller/controller_timeline_posts.php");

            //
            $completely_presented_timeline_notifications_array = get_completely_presented_timeline_notifications_array($session->currently_viewed_user_id);

            // Display the timeline posts of the current user being viewed.
            foreach ($completely_presented_timeline_notifications_array as $post) {
                echo $post;
            }


            // TODO: DEBUG
            MyDebugMessenger::add_debug_message("So far so good.");
        }


        ////
        //if (isset($_GET["is_viewing_actual_user_again"])) {
        //    $session->reset_currently_viewed_user();
        //
        //    redirect_to(LOCAL . "/public/index.php");
        //}
        ?>








        <?php
        // TODO: LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>
    </div>
</main>


<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/index.css"; ?>">


<!--Scripts-->
<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>

<!--<script src="_scripts/index.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Wall / FatBoy";
</script>


<?php
// TODO: SECTION: Script for showing the reply form.
?>


<!--Scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/index.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/wall_tasks.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/wall_event_listeners.js"; ?>"></script>


<!--Footer-->
<?php // include_layout_template('footer.php');          ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
