<?php // require_once("../private/includes/initializations.php");                                   ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");                                   ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");                                   ?>
<?php //require_once("_layouts/header.php"); ?>
<?php require_once("../../_layouts/header.php"); ?>
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
        <?php if ($session->is_logged_in()) { ?>
            <a id="create_post_link">+ Create Post</a>
        <?php } ?>
    </nav>


    <div id="main_content">
        <?php if ($session->is_logged_in()) { ?>
            <?php require_once(PUBLIC_PATH . "/__view/timeline_posts/create.php"); ?>
        <?php } ?>
    </div>

    <!--Templates-->
    <?php require_once(PUBLIC_PATH . "/__view/rateable_items/templates/rate_bar.php"); ?>

    <!--    Extentional -->
    <?php require_once(PUBLIC_PATH . "/__view/timeline_posts/settings_pop_up_window.php"); ?>

</main>


<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/index.css"; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/timeline_posts/index.css"; ?>">


<!--Scripts-->
<!--Extentional scripts for timeline-post-replies.-->
<?php require_once(PUBLIC_PATH . "/__view/timeline_post_replies/index.php"); ?>



<!--Maybe delete this on production. The functionality of these scripts are already replaced-->
<!--by the next chunk of scripts.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/main_script.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/main_script2.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/index.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/wall_tasks.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/wall_event_listeners.js"; ?><!--"></script>-->

<!--Main scripts for timeline-posts-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/general_functions2.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_posts/general_functions3.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/create.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/read.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_posts/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_posts/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/fetch.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/TimelinePost.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/event_handlers.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/event_listeners.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_posts/event_listeners2.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_posts/tasks.js"; ?>"></script>


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







<?php // TODO:SECTION: Extentional scripts for rate-reaction notifications. ?>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_iteminstance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/rateable_item/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/notifications/rateable_item/create.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemread.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemupdate.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemdelete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/notifications/rateable_item/NotificationRateableItem.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemevent_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemtasks.js"; ?><!--"></script>-->




<!--Extentional scripts for timeline-post-subscriptions.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/instance_vars.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_subscriptions/general_functions.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_subscriptions/create.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/read.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/update.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/delete.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/timeline_post_subscriptions/TimelinePostSubscription.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/event_listeners.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/timeline_post_subscriptions/tasks.js"; ?><!--"></script>-->






<!--Footer-->
<?php // include_layout_template('footer.php');          ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
