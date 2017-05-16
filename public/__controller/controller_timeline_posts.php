<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/timeline_posts.php"); ?>






<?php

if (!$session->is_logged_in()) {
    redirect_to("../index.php"); 
}
?>





<?php

function get_completely_presented_timeline_notifications_array($currently_viewed_user_id) {
//    global $connection;

    $query = "SELECT * ";
    $query .= "FROM TimelinePosts INNER JOIN Users ON TimelinePosts.poster_user_id = Users.user_id ";
    $query .= "WHERE owner_user_id = {$currently_viewed_user_id} ";
    $query .= "ORDER BY date_posted DESC";

    //
    $timeline_notifications_records_result_set = TimelinePost::read_by_query($query);


    //
    $completely_presented_timeline_notifications_array = array();


    //
    require_once(PUBLIC_PATH . "/__model/my_database.php");
    global $database;
    
    while ($row = $database->fetch_array($timeline_notifications_records_result_set)) {
        // TODO: Complete the HTML parts.
        $completely_presented_timeline_notification = "<br>";
        $completely_presented_timeline_notification .= "<div id='{$row['id']}' class='message_post'>";
        $completely_presented_timeline_notification .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_timeline_notification .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_timeline_notification .= "<p>" . "{$row['message']}" . "</p>";


        // Attach all the replies on this specific post.
        require_once("controller_timeline_post_replies.php");
        $completely_presented_timeline_post_replies_array = get_completely_presented_timeline_post_replies_array($row["id"]);
        foreach ($completely_presented_timeline_post_replies_array as $reply) {
            $completely_presented_timeline_notification .= $reply;
        }

        
        $completely_presented_timeline_notification .= "<button id='replyButton{$row['id']}' onclick='createForm({$row['id']})' class='link_reply'>reply</button>";
        $completely_presented_timeline_notification .= "</div><br>";

        // Put that one specific post to the array of user's posts.
        array_push($completely_presented_timeline_notifications_array, $completely_presented_timeline_notification);
    }



    return $completely_presented_timeline_notifications_array;
}
?>
