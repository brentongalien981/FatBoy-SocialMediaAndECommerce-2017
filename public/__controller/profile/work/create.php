<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_profile.php");   ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_address.php");   ?>
<?php require_once(PUBLIC_PATH . "/__model/model_work_experience.php");   ?>






<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

if (isset($_POST["xxx"])) {
//    sleep(1);
//
//    if (!are_required_fields_filled()) {
//        // 0 means it's not all filled.
//        echo "0";
//        return;
//    }




    // This array will contain all the details
    // of the work experience including the descriptions.
    $work_details_array = array();

    // Because PHP is weird and doesn't accept a reference param, but just copies it, set the var again..
    $work_details_array = add_work_experience_record($work_details_array);

    if ($work_details_array != 0) {
        echo json_encode($work_details_array);
    } else {
        echo "0";
    }

    //
}
?>





<?php

use App\Privado\HelperClasses\Validation\Validator;






// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["add_work_experience"]) && $_POST["add_work_experience"] == "yes") {
    sleep(2);
    //
    $allowed_assoc_indexes_for_post = array("company_name", "place", "position", "time_frame", "work_experience_description1", "work_experience_description2", "work_experience_description3");

    $validator = get_validator_obj($allowed_assoc_indexes_for_post);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok && add_work_experience_record()) {

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
    return;
}
?>





<?php

function get_validator_obj(&$allowed_assoc_indexes_for_post) {
    //
    $required_post_vars_length_array = array("company_name" => ["min" => 2, "max" => 200],
                                            "place" => ["min" => 2, "max" => 100], 
                                            "position" => ["min" => 2, "max" => 100], 
                                            "time_frame" => ["min" => 2, "max" => 50], 
                                            "work_experience_description1" => ["min" => 2, "max" => 500], 
                                            "work_experience_description2" => ["min" => 0, "max" => 500], 
                                            "work_experience_description3" => ["min" => 0, "max" => 500]);    

//
    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);
    
    $validator->set_exempted_white_space_field_array(array("work_experience_description2", "work_experience_description3"));

    return $validator;
}

// @return: true/false based on the creation.
function add_work_experience_record() {
    global $session;
    $new_work_experience_obj = new WorkExperience();
    $new_work_experience_obj->id = null;
    $new_work_experience_obj->user_id = $session->actual_user_id;
    $new_work_experience_obj->company_name = $_POST['company_name'];
    $new_work_experience_obj->position = $_POST['position'];
    $new_work_experience_obj->place = $_POST['place'];
    $new_work_experience_obj->time_frame = $_POST['time_frame'];

    $is_creation_ok = $new_work_experience_obj->create_with_bool();

    if ($is_creation_ok === true) {

        return add_work_experience_description_record($new_work_experience_obj->id);
    } else {
        return false;
    }
}

// NOTE: 1 wrong/invalid work description alone will return false.
function add_work_experience_description_record($work_experience_id) {
    // Max # of Work Task Descriptions per Work(id)...
    $max = 3;


    // This @var $x will be used as an index for the work_description json.
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
    $x = 0;
    for ($i = 1; $i <= $max; $i++) {

        //
        $description_index = "work_experience_description{$i}";
//        echo "DEBUG: \$description_index = {$description_index}\n";

        $the_description = $_POST[$description_index];

        // For JSON.
        // The description for what I'm doing here is above...
        $json_index = $i - $x;
        $json_description_index = "work_experience_description{$json_index}";

        if (empty($_POST[$description_index]) ||
                is_null($_POST[$description_index]) ||
                $_POST[$description_index] == "") {
            ++$x;
            continue;
        }


//        // TODO:REMINDER:Probably delete this later.
//        // I don't need JSON now here cause I'm using AJAX.
//        // For JSON.
//        $work_details_array[$json_description_index] = $the_description;


        if (!add_a_work_experience_description_record($work_experience_id, $the_description)) {
            return false;
        }
    }


    // Everything is ok.
    return true;
}

function add_a_work_experience_description_record($work_experience_id, $the_description) {
    $query = "INSERT INTO WorkTaskDescription ";
    $query .= "VALUES (NULL, {$work_experience_id}, '{$the_description}')";

    $is_creation_ok = WorkExperience::create_by_query($query);

    return $is_creation_ok;
}
?>