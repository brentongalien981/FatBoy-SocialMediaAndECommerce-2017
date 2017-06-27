<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_my_videos.php"); ?>






<?php
// Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php
// Functions.
function get_completely_presented_user_videos_array() {
    global $session;
    
    //
    $query = "SELECT * FROM MyVideos ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
    $query .= "ORDER BY id DESC";
    
    
    //
    $user_videos_records_result_set = MyVideo::read_by_query($query);    
    
    
    //
    $completely_presented_user_videos_array = array();    
    

    //
    require_once(PUBLIC_PATH . "/__model/my_database.php");
    global $database;
    
    while ($row = $database->fetch_array($user_videos_records_result_set)) {
        //
        $completely_presented_user_video = "<tr>";
            $completely_presented_user_video .= "<td>";
                $completely_presented_user_video .= "<div class='timeline_iframe_video_div section'>";
                    $completely_presented_user_video .= "<h4>{$row['title']}</h4>";
                    $completely_presented_user_video .= "{$row['embed_code']}";
                    $completely_presented_user_video .= "<a id='lupetness_a' href='#'>lupetness</a>";
                $completely_presented_user_video .= "</div>";
            $completely_presented_user_video .= "</td>";
        $completely_presented_user_video .= "</tr>";
        
        //
        array_push($completely_presented_user_videos_array, $completely_presented_user_video);
    }
    
    
    // 
    return $completely_presented_user_videos_array;
}
?>