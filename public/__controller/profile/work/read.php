<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_address.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_work_experience.php"); ?>





<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php
if (is_request_post() && isset($_POST["read_work_experiences"]) && $_POST["read_work_experiences"] == "yes") {
    $work_experiences_array = get_work_experiences_array();
    $result_array = array("is_result_ok" => true, "work_experiences_array" => $work_experiences_array);


    if ($session->is_viewing_own_account()) {
        $result_array["is_viewing_own_account"] = true;
    } 
    else {
        $result_array["is_viewing_own_account"] = false;
    }


    echo json_encode($result_array);    
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

//function display_work_experience() {
//    //
//    global $session;
//    $query = "SELECT * FROM WorkExperience ";
//    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
//    $query .= "ORDER BY id DESC";
//
//    $record_results = WorkExperience::read_by_query($query);
//
//
//    // This is just a template work_experience_div, so that I can clone it
//    // when adding a new work_experience record as parent.childNodes[4]...
//    $test_row = array();
//    $test_row['id'] = "-69";
//    $test_row['company_name'] = "tae69";
//    $test_row['place'] = "tae69";
//    $test_row['position'] = "tae69";
//    $test_row['time_frame'] = "tae69";
//
//    display_a_work_experience($test_row);
//
//
//    // These are the real work_experiences.
//    global $database;
//    while ($row = $database->fetch_array($record_results)) {
//        display_a_work_experience($row);
//    }
//}

//// @param $row: A work experience record.
//function display_a_work_experience($row) {
//    echo "<div class='a_work_experience' ";
//
//    // I created this personal attributes for the div
//    // so I can access the work experience details directly.
//    echo "company_name='{$row['company_name']}' ";
//    echo "place='{$row['place']}' ";
//    echo "position='{$row['position']}' ";
//    echo "time_frame='{$row['time_frame']}'";
//
//    echo ">";
//
//
//    global $session;
//    if ($session->is_viewing_own_account()) {
//        echo "<div class='work_exp_action_div user_work_exp_action_div'>";
//        echo "<input id='form_button_delete{$row['id']}' type='button' class='form_button form_button_actions form_button_delete' name='' value='delete'>";
//        echo "<input id='form_button_edit{$row['id']}' type='button' class='form_button form_button_actions form_button_edit' name='' value='edit'>";
//        echo "</div>";
//    } else {
//        // This is just an invisible button so that the style is not messed up.
//        // This won't show because the id is not set which is used to loop and attach mouseover listeners...
//        echo "<div class='work_exp_action_div'>";
//        echo "<input type='button' class='form_button form_button_actions form_button_delete' name='' value='delete'>";
//        echo "<input type='button' class='form_button form_button_actions form_button_edit' name='' value='edit'>";
//        echo "</div>";
//    }
//
//    echo "<table>";
//
//
//    echo "<tr>";
//    echo "<td>";
//    echo "<h5>{$row['company_name']}</h5>";
//    echo "</td>";
//
//    echo "<td class='td_right_aligned'>";
//    echo "<h5>{$row['place']}</h5>";
//    echo "</td>";
//    echo "</tr>";
//
//    echo "<tr>";
//    echo "<td>";
//    echo "<h5>{$row['position']}</h5>";
//    echo "</td>";
//
//    echo "<td class='td_right_aligned'>";
//    echo "<h5>{$row['time_frame']}</h5>";
//    echo "</td>";
//    echo "</tr>";
//
//    echo "<tr>";
//    echo "<td colspan='2'>";
//    echo "<ul>";
//
//    display_work_experience_task($row['id']);
//
//
//    echo "</ul>";
//    echo "</td>";
//    echo "</tr>";
//
//    echo "</table>";
//
//    echo "</div>";
//}

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

function display_form_work_experience() {
    echo "<form id='form_add_work_experience' class='form_work_experience'>";
    echo "<table>";

    echo "<tr>";
    echo "<td>";
    echo "<h5>Additional Work Experience</h5>";
//    echo "<input id='form_button_edit' type='button' class='form_button' name='' value='edit'>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";

    echo "<td colspan='2'>";
//    echo "<label class='error_msg' id='error_company_name'>error</label><br>";
    echo "<input type='text' id='company_name' name='' placeholder='Company Name'>";

//    echo "<label class='error_msg' id='error_company_name'>error</label><br>";
    echo "<input type='text' id='place' name='' placeholder='City, State/Country' class='right_aligned'>";
    echo "</td>";


//    echo "<td>";
//    echo "<input type='text' name='' placeholder='City, State/Country'>";
//    echo "</td>";

    echo "</tr>";

    echo "<tr>";

    echo "<td colspan='2'>";
    echo "<input type='text' id='position' name='' placeholder='Position'>";
    echo "<input type='text' id='time_frame' name='' placeholder='from - to' class='right_aligned'>";
    echo "</td>";


//    echo "<td>";
//    echo "<input type='text' name='' placeholder='from - to'>";
//    echo "</td>";

    echo "</tr>";

    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<textarea type='text' id='work_experience_description1' class='work_experience_description' name='' placeholder='Experience description 1'></textarea>";
    echo "</td>";
    echo "</tr>";


    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<textarea type='text' id='work_experience_description2' class='work_experience_description' name='' placeholder='Experience description 2'></textarea>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<textarea type='text' id='work_experience_description3' class='work_experience_description' name='' placeholder='Experience description 3'></textarea>";
    echo "</td>";
    echo "</tr>";


    echo "<tr>";
    echo "<td>";
    echo "<input id='button_ok_add_work_experience' type='button' class='form_button' name='' value='ok'>";
    echo "<input id='button_cancel_add_work_experience' type='button' class='form_button' name='' value='cancel'>";
    echo "</td>";
    echo "</tr>";

    echo "</table>";
    echo "</form>";
}
?>