<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/timeline_post_replies.php"); ?>






<?php

function get_completely_presented_timeline_post_replies_array($row_id) {
    $query = "SELECT * ";
    $query .= "FROM TimelinePostReplies INNER JOIN Users ON TimelinePostReplies.poster_user_id = Users.user_id ";
    $query .= "WHERE parent_post_id = {$row_id} ";
    $query .= "ORDER BY date_posted ASC";

    //
    $timeline_post_replies_records_result_set = TimelinePostReply::read_by_query($query);


    // This will be the return.
    $completely_presented_timeline_post_replies_array = array();


    //
    require_once(PUBLIC_PATH . "/__model/my_database.php");
    global $database;
    
    while ($row = $database->fetch_array($timeline_post_replies_records_result_set)) {
        // TODO: Complete the HTML parts.
        $completely_presented_timeline_reply = "<br>";
        $completely_presented_timeline_reply .= "<div id='{$row['id']}' class='replies'>";
        $completely_presented_timeline_reply .= "<h4>" . "{$row['user_name']}" . "</h4>";
        $completely_presented_timeline_reply .= "<h5>" . "{$row['date_posted']}" . "</h5>";
        $completely_presented_timeline_reply .= "<p>" . "{$row['message']}" . "</p>";
        $completely_presented_timeline_reply .= "</div><br>";

        // Put that one specific post to the array of user's posts.
        array_push($completely_presented_timeline_post_replies_array, $completely_presented_timeline_reply);
    }



    return $completely_presented_timeline_post_replies_array;
}
?>
