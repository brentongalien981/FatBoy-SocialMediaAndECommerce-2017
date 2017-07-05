<?php // require_once("../__main.php"); ?>
<?php require_once(PUBLIC_PATH . "/_scripts/friends/suggestions/ajax_create.php"); ?>

<script>
    // Functions
    
    // Sort of like a create_friendsip_recrod().
    function bridge_create_follow_record(friend_id) {
        console.log("Inside METHOD: bridge_create_follow_record().");
        
        create_follow_record(friend_id);
    }
</script>