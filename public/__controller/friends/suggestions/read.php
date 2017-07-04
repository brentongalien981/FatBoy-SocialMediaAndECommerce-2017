<?php
if (isset($_GET["get_all_friend_suggestions"]) && ($_GET["get_all_friend_suggestions"] == "yes")) {
    
//    $notification_count = NotificationFetcher::get_all_notification_count();
    
    echo json_encode(array("is_result_ok" => true));
    
}
?>






<?php
function get_work_experiences_array() {
    //
    global $session;
    $query = "SELECT * FROM WorkExperience ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
    $query .= "ORDER BY id DESC";

    $record_results = WorkExperience::read_by_query($query);

    

    //
    global $database;
    $work_experiences_array = array();


    while ($row = $database->fetch_array($record_results)) {

        $a_work_experience = array("id" => $row['id'],
                                   "company_name" => $row['company_name'],
                                   "position" => $row['position'],
                                   "place" => $row['place'],
                                   "time_frame" => $row['time_frame']);
        
        set_work_experience_tasks($row['id'], $a_work_experience);

        //
        array_push($work_experiences_array, $a_work_experience);
    }


    // 
    return $work_experiences_array;
}

function set_work_experience_tasks($work_experience_id, &$a_work_experience) {

    //
    global $session;
    $query = "SELECT * FROM WorkTaskDescription ";
    $query .= "WHERE work_experience_id = {$work_experience_id}";

    $record_results = WorkExperience::read_by_query($query);

    global $database;
    
    $work_descriptions = array();
    
    while ($row = $database->fetch_array($record_results)) {
        if (empty($row['description']) || $row['description'] == "") {
            continue;
        }

        array_push($work_descriptions, $row['description']);
    }
    
    $a_work_experience["work_descriptions"] = $work_descriptions;
}


?>