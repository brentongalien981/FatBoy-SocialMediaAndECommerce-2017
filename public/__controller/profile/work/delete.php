<?php

if (is_request_post() && isset($_POST["delete_work_experience"]) && $_POST["delete_work_experience"] == "yes") {

    if (delete_a_work_experience_description_record($_POST['work_experience_id']) &&
            delete_a_work_experience_record($_POST['work_experience_id'])) {
        echo json_encode(array("is_result_ok" => true));
        
    }
    else {
        echo json_encode(array("is_result_ok" => false));
    }
}
?>





<?php

function delete_a_work_experience_description_record($work_experience_id) {
    $query = "DELETE FROM WorkTaskDescription WHERE work_experience_id = {$work_experience_id}";

    $is_deletion_ok = WorkExperience::delete_by_query($query);

    return $is_deletion_ok;
}

function delete_a_work_experience_record($work_experience_id) {
    $query = "DELETE FROM WorkExperience WHERE id = {$work_experience_id}";

    $is_deletion_ok = WorkExperience::delete_by_query($query);

    return $is_deletion_ok;
}
?>