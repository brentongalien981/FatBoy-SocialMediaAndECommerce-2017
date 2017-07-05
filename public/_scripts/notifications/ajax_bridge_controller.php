<?php // require_once("../__main.php");   ?>
<?php require_once(PUBLIC_PATH . "/_scripts/friends/suggestions/ajax_create.php"); ?>

<script>
    // Functions
    function sleep(ms = 1) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    // Sort of like a create_friendsip_recrod().
    function bridge_create_follow_record(friend_id) {
        console.log("Inside METHOD: bridge_create_follow_record().");

        create_follow_record(friend_id);
    }

//    function bridge_accept_follow_request(friend_id, notification_id) {
//        return;
//        // Sort of like a create_friendsip_recrod().
//        bridge_create_follow_record(friend_id, notification_id);
//        return;
//        
//        // uki
//        // Delete the follow notification record.
//        delete_follow_notification_record(notification_id);
//        
//        //
//        create_follow_acceptance_notification_record();
//    }    
</script>