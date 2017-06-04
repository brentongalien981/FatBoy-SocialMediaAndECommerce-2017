<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_work_experience.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>






<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

// TODO: SECTION: LOG.
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// TODO: SECTION: Functions.
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
    echo "<input type='text' id='company_name' name='' placeholder='Company Name'>";

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

function show_work_experience() {
    echo "<div class='section'>";
    echo "<h4 id='h4_work_experience'>Work Experience</h4>";
    display_button_add_work_experience();
    echo "<hr>";

//    display_button_add_work_experience();

    display_form_work_experience();


    //
    display_work_experience();

    echo "</div>";
}

function display_work_experience() {
    //
    global $session;
    $query = "SELECT * FROM WorkExperience ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
    $query .= "ORDER BY id DESC";

    $record_results = WorkExperience::read_by_query($query);
    
    
    // This is just a template work_experience_div, so that I can clone it
    // when adding a new work_experience record as parent.childNodes[4]...
    $test_row = array();
    $test_row['id'] = "-69";
    $test_row['company_name'] = "tae69";
    $test_row['place'] = "tae69";
    $test_row['position'] = "tae69";
    $test_row['time_frame'] = "tae69";
    
    display_a_work_experience($test_row);
    
    
    // These are the real work_experiences.
    global $database;
    while ($row = $database->fetch_array($record_results)) {
        display_a_work_experience($row);
    }
}

// @param $row: A work experience record.
function display_a_work_experience($row) {
    echo "<div id='{$row['id']}' class='a_work_experience' ";

    // I created this personal attributes for the div
    // so I can access the work experience details directly.
    echo "company_name='{$row['company_name']}' ";
    echo "place='{$row['place']}' ";
    echo "position='{$row['position']}' ";
    echo "time_frame='{$row['time_frame']}'";

    echo ">";


    global $session;
    if ($session->is_viewing_own_account()) {
        echo "<input id='form_button_edit{$row['id']}' type='button' class='form_button form_button_edit' name='' value='edit'>";
    } else {
        // This is just an invisible button so that the style is not messed up.
        echo "<input type='button' class='form_button form_button_edit' name='' value='edit'>";
    }

    echo "<table>";

//        echo "<tr>";
//        echo "<td colspan='2' id='td_edit'>";
//
//
//        echo "</td>";
//        echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "<h5>{$row['company_name']}</h5>";
    echo "</td>";

    echo "<td class='td_right_aligned'>";
    echo "<h5>{$row['place']}</h5>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "<h5>{$row['position']}</h5>";
    echo "</td>";

    echo "<td class='td_right_aligned'>";
    echo "<h5>{$row['time_frame']}</h5>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<ul>";

    display_work_experience_task($row['id']);


    echo "</ul>";
    echo "</td>";
    echo "</tr>";

    echo "</table>";

    echo "</div>";
}

function display_work_experience_task($work_experience_id) {

    //
    global $session;
    $query = "SELECT * FROM WorkTaskDescription ";
    $query .= "WHERE work_experience_id = {$work_experience_id}";

    $record_results = WorkExperience::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_results)) {
        if (empty($row['description']) || $row['description'] == "") {
            continue;
        }

        echo "<li>";
        echo "{$row['description']}";
        echo "</li>";
    }
}

function display_button_add_work_experience() {
    global $session;
    if ($session->is_viewing_own_account()) {
//        echo "<div id='container_button_add_work_experience'>";
        echo "<button id='button_add_work_experience' class='form_button'>+ add an experience</button>";
//        echo "</div>";
    }
}

function show_user_profile_summary() {
    echo "<div class='section'>";
    echo "<h4>About Me</h4>";

    echo "<div id='div_about_me'>";

    $profile_pic_src = get_profile_pic_src();
    echo "<img src='" . LOCAL . "{$profile_pic_src}'>";

    $profile_description = get_profile_description();
    echo "<p>";
    echo $profile_description;
    echo "</p>";

    echo "</div>";
    echo "</div>";
}

function get_profile_description() {
    global $session;
    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";

    $record_result = Profile::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        return $row["description"];
    }
}

function get_profile_pic_src($user_id = -69) {
    global $session;

    // If there's no provided user_id as an argument...
    if ($user_id == -69) {
        $user_id = $session->currently_viewed_user_id;
    }

    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$user_id}";

    $record_result = Profile::read_by_query($query);

    global $database;

    // Default pic_url.
    $pic_url = "/public/_photos/icon_profile.png";

    $num_of_results = $database->get_num_rows_of_result_set($record_result);

    if ($num_of_results == 0) {
        return $pic_url;
    }



    while ($row = $database->fetch_array($record_result)) {

        if (empty($row["pic_url"]) || is_null($row["pic_url"])) {
            return $pic_url;
        } else {
            return $row["pic_url"];
        }
    }
}

function update_work_experience_description_record($work_details_array) {
    // Max # of Work Task Descriptions per Work(id)...
    $max = 3;

    // Query to get all the ids of the existing descriptions
    // for that one particular work_experience_id.
    $query = "SELECT * FROM WorkTaskDescription ";
    $query .= "WHERE work_experience_id = {$_POST['work_experience_id']} ";
    $query .= "ORDER BY id ASC";

//    echo "QUERY: {$query}";

    $record_results = WorkExperience::read_by_query($query);

    // This array contains the ids of the work descriptions
    // before the edit/update.
    $work_experience_descriptions_array = array();

    $j = 0;
    global $database;
    while ($row = $database->fetch_array($record_results)) {
        $work_experience_descriptions_array[$j] = $row['id'];
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
//        echo "DEBUG: \$description_index = {$description_index}\n";
        //
        $the_description = $_POST[$description_index];

        // For JSON.
        // The description for what I'm doing here is above...
        $json_index = $i - $x;
        $json_description_index = "work_experience_description{$json_index}";

        if (is_null($_POST[$description_index]) ||
                empty($_POST[$description_index]) ||
                $_POST[$description_index] == "") {

            ++$x;
            continue;
        }


        // For JSON.
        $work_details_array[$json_description_index] = $the_description;


        // If there's still a previously existing work experience description,
        // use the id of that for the update query.
//        if (isset($work_experience_descriptions_array[$i - 1])) {
        if (isset($work_experience_descriptions_array[$json_index - 1])) {

            // If update is ok..
            if (update_a_work_experience_description_record($work_experience_descriptions_array[$json_index - 1], $the_description)) {
//                echo "SUCCESS update_a_work_experience_description_record for: {$the_description}";
            } else {
//                echo "No change on update_a_work_experience_description_record for: {$the_description}";
            }
        } else {
            // Meaning, there's a new task description added.
            if (add_a_work_experience_description_record($_POST['work_experience_id'], $the_description)) {
//                echo "SUCCESS UPDATE Adding a_work_experience_description_record: {$the_description}";
            } else {
//                echo "FAIL UPDATE Adding a_work_experience_description_record: {$the_description}";
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
        if (!isset($work_experience_descriptions_array[$z])) {
            break;
        }

        //
        $query = "DELETE FROM WorkTaskDescription ";
        $query .= "WHERE id = {$work_experience_descriptions_array[$z]}";

        //
//        echo "QUERY: {$query}\n";
        //
        $is_deletion_ok = WorkExperience::delete_by_query($query);
    }


    // Everything is ok.
    // This is JSON.
    return $work_details_array;
//    echo "1";
}

function update_a_work_experience_description_record($id, $the_description) {
    $query = "UPDATE WorkTaskDescription SET ";
    $query .= "description = '{$the_description}' ";
    $query .= "WHERE id = {$id}";

    $is_update_ok = WorkExperience::update_by_query($query);

    return $is_update_ok;
}

function add_work_experience_description_record($work_experience_id, $work_details_array) {
    // Max # of Work Task Descriptions per Work(id)...
    $max = 3;


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


//        //
//        $the_description = $_POST[$description_index];
        // For JSON.
        $work_details_array[$json_description_index] = $the_description;


        if (!add_a_work_experience_description_record($work_experience_id, $the_description)) {
//            echo "0";
            return 0;
        }
    }


//    // Everything is ok.
//    echo "1";
    // This is JSON.
    return $work_details_array;
}

function add_a_work_experience_description_record($work_experience_id, $the_description) {
    //
//    $the_description = $_POST[$description_index];
//    echo "DEBUG: \$the_description = {$the_description}\n";

    $query = "INSERT INTO WorkTaskDescription ";
    $query .= "VALUES (NULL, {$work_experience_id}, '{$the_description}')";

//    echo "DEBUG: \$query = {$query}\n";

    $is_creation_ok = WorkExperience::create_by_query($query);

    return $is_creation_ok;
}

function update_work_experience_record($work_details_array) {
    //
    $query = "UPDATE WorkExperience SET ";
    $query .= "company_name = '{$_POST['company_name']}', ";
    $query .= "position = '{$_POST['position']}', ";
    $query .= "place = '{$_POST['place']}', ";
    $query .= "time_frame = '{$_POST['time_frame']}' ";
    $query .= "WHERE id = {$_POST['work_experience_id']}";

    $is_update_ok = WorkExperience::update_by_query($query);

    if ($is_update_ok) {
//        echo "SUCCESS update.";
    } else {
//        echo "No changes made.\n";
//        echo "QUERY: {$query}\n";
    }


    //
    $work_details_array['company_name'] = $_POST['company_name'];

    $work_details_array['position'] = $_POST['position'];
    $work_details_array['place'] = $_POST['place'];
    $work_details_array['time_frame'] = $_POST['time_frame'];

    return $work_details_array;
}

function add_work_experience_record($work_details_array) {
    global $session;
    $new_work_experience_obj = new WorkExperience();
    $new_work_experience_obj->id = null;
    $new_work_experience_obj->user_id = $session->actual_user_id;
    $new_work_experience_obj->company_name = $_POST['company_name'];
    $new_work_experience_obj->position = $_POST['position'];
    $new_work_experience_obj->place = $_POST['place'];
    $new_work_experience_obj->time_frame = $_POST['time_frame'];

    $is_creation_ok = $new_work_experience_obj->create_with_bool();

    if ($is_creation_ok) {
        //
        $work_details_array['id'] = $new_work_experience_obj->id;
        $work_details_array['company_name'] = $_POST['company_name'];

        $work_details_array['position'] = $_POST['position'];
        $work_details_array['place'] = $_POST['place'];
        $work_details_array['time_frame'] = $_POST['time_frame'];

        return add_work_experience_description_record($new_work_experience_obj->id, $work_details_array);
    } else {
//        echo "0";

        return 0;
    }
}

function are_required_fields_filled() {
    //
    MyValidationErrorLogger::initialize();


//    //
//    $video_title = $_POST["video_title"];
//    $embedded_video_code = $_POST["embedded_video_code"];
    // validations
    $required_fields = array("company_name", "place", "position", "time_frame", "work_experience_description1");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("company_name" => 200, "place" => 100, "position" => 100, "time_frame" => 50, "work_experience_description1" => 500);
    validate_max_lengths($fields_with_max_lengths);


    //
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS work experience validation.");

        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL work experience validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        return false;
    }
}
?>





<?php

// TODO: SECTION: Meat.
if (isset($_POST["add_work_experience"])) {
    sleep(1);
    if (!are_required_fields_filled()) {
        // 0 means it's not all filled.
        echo "0";
        return;
    }




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

if (isset($_POST["update_work_experience"])) {
    sleep(1);

    if (!are_required_fields_filled()) {
        // 0 means it's not all filled.
        echo "0";
        return;
    }

//    echo "REQUIRED FIELDS ARE OK";
    // This array will contain all the details
    // of the work experience including the descriptions.
    $work_details_array = array();

    // Because PHP is weird and doesn't accept a reference param, but just copies it, set the var again..
    $work_details_array = update_work_experience_record($work_details_array);

    $work_details_array = update_work_experience_description_record($work_details_array);

    //
    echo json_encode($work_details_array);
//    echo 'SHITE';
//    echo "POST[work_experience_id]: {$_POST['work_experience_id']}\n";
//    echo "POST[company_name]: {$_POST['company_name']}\n";
//    echo "POST[work_experience_description1]: {$_POST['work_experience_description1']}\n";
}
?>