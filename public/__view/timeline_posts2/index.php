<?php require_once("../../_layouts/master.php"); ?>




<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/timeline_posts/index.css"; ?>">



<?php if ($session->is_logged_in()) { ?>
    <div id="sub-menu" class="d-flex flex-row justify-content-center align-items-center">
        <a id="create_post_link" class="mx-3">+ Create Post</a>
        <a id="edit_post_link" class="mx-3">* Edit Post</a>
    </div>


    <?php require_once(PUBLIC_PATH . "/__view/timeline_posts/create.php"); ?>
    <?php require_once(PUBLIC_PATH . "/__view/timeline_posts/read.php"); ?>
<?php } ?>




<!--Templates-->
<?php require_once(PUBLIC_PATH . "/__view/rateable_items/templates/rate_bar.php"); ?>

<!--    Extentional -->
<?php require_once(PUBLIC_PATH . "/__view/timeline_posts/settings_pop_up_window.php"); ?>








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
<!--TODO: Uncomment the next line.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/Notification.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/tasks.js"; ?><!--"></script>-->







<?php // TODO:SECTION: Extentional scripts for rate-reaction notifications. ?>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_iteminstance_vars.js"; ?><!--"></script>-->
<!--TODO: Uncomment the next line.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_item/general_functions.js"; ?><!--"></script>-->
<!--TODO: Uncomment the next line.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_item/create.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemread.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemupdate.js"; ?><!--"></script>-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_itemdelete.js"; ?><!--"></script>-->
<!--TODO: Uncomment the next line.-->
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/notifications/rateable_item/NotificationRateableItem.js"; ?><!--"></script>-->
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

