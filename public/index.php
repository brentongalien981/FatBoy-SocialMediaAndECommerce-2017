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

    <!--Templates-->
    <?php require_once(PUBLIC_PATH . "/__view/rateable_items/templates/rate_bar.php"); ?>

</main>


<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/index.css"; ?>">


<!--Scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/main_script2.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/index.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/wall_tasks.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/wall_event_listeners.js"; ?>"></script>


<!--Late-bind scripts-->
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
<script>document.getElementById("title").innerHTML = "Wall / FatBoy";</script>


<!--Extentional Scripts-->
<!--RateableItems-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/general_functions3.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/create.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/RateableItem.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/event_listeners2.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items/tasks.js"; ?>"></script>


<!--RateableItemsUsers-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/rateable_items/instance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items_users/general_functions.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/general_functions2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/rateable_items/create.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items_users/read.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items_users/update.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items_users/RateableItemUser.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/event_listeners2.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/rateable_items_users/tasks.js"; ?>"></script>






<?php // TODO:SECTION: Extentional scripts for notifications. ?>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/instance_vars.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/general_functions.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/Notification.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/tasks.js"; ?><!--"></script>-->







<?php // TODO:SECTION: Extentional scripts for TimelinePostRate reaction notifications. ?>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/instance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/timeline_post/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/timeline_post/create.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/timeline_post/NotificationPost.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/timeline_post/tasks.js"; ?><!--"></script>-->






<!--Footer-->
<?php // include_layout_template('footer.php');          ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
