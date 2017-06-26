<?php

// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["update_work_experience"]) && $_POST["update_work_experience"] == "yes") {
    //
    $allowed_assoc_indexes_for_post = array("company_name", "place", "position", "time_frame", "work_experience_description1", "work_experience_description2", "work_experience_description3");

    $validator = get_validator_obj($allowed_assoc_indexes_for_post);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // TODO:REMINDER
    // Try to edit record from db.
    if ($is_validation_ok) {
        //
        if (update_work_experience_record()) {
            $json_errors_array["update_record"] = "ok";
        } else {
            $json_errors_array["update_record"] = "no change or error";
        }


        if (update_work_experience_description_record($json_errors_array)) {
            $json_errors_array["update_descriptions"] = "ok";
        } else {
            $json_errors_array["update_descriptions"] = "no change or error";
        }

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
    return;
}
?>





<?php

// @return $is_update_ok = true/false.
function update_work_experience_record() {
    //
    $query = "UPDATE WorkExperience SET ";
    $query .= "company_name = '{$_POST['company_name']}', ";
    $query .= "position = '{$_POST['position']}', ";
    $query .= "place = '{$_POST['place']}', ";
    $query .= "time_frame = '{$_POST['time_frame']}' ";
    $query .= "WHERE id = {$_POST['work_experience_id']}";

    $is_update_ok = WorkExperience::update_by_query($query);

    return $is_update_ok;
}

function update_work_experience_description_record(&$json_errors_array) {
    // Max # of Work Task Descriptions per Work(id)...
    $max = 3;

    // Query to get all the ids of the existing descriptions
    // for that one particular work_experience_id.
    $query = "SELECT * FROM WorkTaskDescription ";
    $query .= "WHERE work_experience_id = {$_POST['work_experience_id']} ";
    $query .= "ORDER BY id ASC";

    $record_results = WorkExperience::read_by_query($query);

    /* Figure out the existing work experience descriptions
     * linked to the current work_experience_id.
     */
    // This array contains the ids of the work descriptions
    // before the edit/update.
    $work_experience_description_ids_array = array();

    $j = 0;
    global $database;
    while ($row = $database->fetch_array($record_results)) {
        $work_experience_description_ids_array[$j] = $row['id'];
        ++$j;
    }



    // This var will be used as an index for the work_description json.
    // Like this: let's say this is the form submitted for update..
    //      ...
    //      work_description1: klsjfad lksadjf lksajdf
    //      work_description2: 
    //      work_description3: klsjfad lksadjf lksajdf
    // Now, the code I have here for the db update will be fine.
    // But the returned json will also display these in the form. And I don't 
    // want that. What I want after the re-population of the work_experience_div is this...
    //      ...
    //      work_description1: klsjfad lksadjf lksajdf
    //      work_description2: klsjfad lksadjf lksajdf   
    // The work_description3 is moved up to the empty 2nd <li>...
    // Thus I'll use this var $x.
    $i = 1;
    $x = 0;

    for (; $i <= $max; $i++) {

        //
        $description_index = "work_experience_description{$i}";
        //
        $the_description = $_POST[$description_index];

        // The description for what I'm doing here is above...
        $properly_adjusted_index = $i - $x;

        if (is_null($_POST[$description_index]) ||
                empty($_POST[$description_index]) ||
                $_POST[$description_index] == "") {

            ++$x;
            continue;
        }


        // If there's still a previously existing work experience description,
        // use the id of that for the update query.
        if (isset($work_experience_description_ids_array[$properly_adjusted_index - 1])) {

            // If update is ok..
            if (update_a_work_experience_description_record($work_experience_description_ids_array[$properly_adjusted_index - 1], $the_description)) {
                $json_errors_array["update_a_description"] = "ok";
            } else {
                $json_errors_array["update_a_description"] = "no change or error";
            }
        } else {
            // Meaning, there's a new task description added.
            if (add_a_work_experience_description_record($_POST['work_experience_id'], $the_description)) {
                $json_errors_array["add_a_description"] = "ok";
            } else {
                $json_errors_array["add_a_description"] = "shit";
                // There's an error adding so..
                return false;
            }
        }
    }


    /* Delete the excess records in the db table WorkTaskDescription. */
    // This is the indexes of the ids of the records to be deleted.
    $z = ($i - 1) - $x;
    // This is the # of records to be deleted.
    $y = $x;
    for (; $y > 0; $z++, $y--) {
        // If there's no more previously existing records
        // before the update, then break off the loop.
        if (!isset($work_experience_description_ids_array[$z])) {
            break;
        }

        //
        $query = "DELETE FROM WorkTaskDescription ";
        $query .= "WHERE id = {$work_experience_description_ids_array[$z]}";

        //
        $is_deletion_ok = WorkExperience::delete_by_query($query);
    }


    return true;
}

function update_a_work_experience_description_record($id, $the_description) {
    $query = "UPDATE WorkTaskDescription SET ";
    $query .= "description = '{$the_description}' ";
    $query .= "WHERE id = {$id}";

    $is_update_ok = WorkExperience::update_by_query($query);

    return $is_update_ok;
}
?>