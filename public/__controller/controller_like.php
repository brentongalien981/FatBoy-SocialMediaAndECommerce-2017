<?php // TODO:REMINDER:Refactor the validation of forms using class:Validaor. ?>

<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_like.php"); ?>



<?php

//// Protected page.
////global $session;
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
use App\Publico\Model\MyValidationErrorLogger;
// TODO:SECTION: Functions.
function validate_inputs() {
    // Validation time.
    MyValidationErrorLogger::initialize();

    // Check if the fields are empty.
    $required_fields = array("a_new_like");
    validate_presences($required_fields);


    // Check the length of the input data.
    $fields_with_max_lengths = array("a_new_like" => 50);
    validate_max_lengths($fields_with_max_lengths);

// What you should be checking here is that,
// if the MyValidationErrorLogger is not empty, then ask again for credentials.
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS Like validation.");
    } else {
        //
        MyDebugMessenger::add_debug_message("FAIL Like validation.");

        //
        $validation_errors = MyValidationErrorLogger::get_log_array();

        //
        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        redirect_to("../__view/view_profile.php");
    }
}

function is_already_in_table_record($a_new_like) {
    // 
    $query = "SELECT * FROM Likes ";
    $query .= "WHERE name = '{$a_new_like}' LIMIT 1";

    // TODO: DEBUG
//    MyDebugMessenger::add_debug_message("QUERY: {$query}.");
    //
    $result_set = Like::read_by_query($query);

    // 
    global $database;
    $num_of_rows = $database->get_num_rows_of_result_set($result_set);

    //
    if ($num_of_rows < 1) {
        return false;
    } else {
        return true;
    }
}

function did_user_already_like($like_id) {
    //
    require_once("controller_users_and_likes.php");

    //
    global $session;
    return did_user_already_like_this($session->actual_user_id, $like_id);
}

function create_mapping_record($like_id) {
    //
    require_once("controller_users_and_likes.php");

    //
    global $session;
    $result_flag = create_mapping_record_bruh($session->actual_user_id, $like_id);

    //
    if ($result_flag) {
        MyDebugMessenger::add_debug_message("SUCCESS adding record to mapping table.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL adding record to mapping table.");
    }
}

// TODO:REMINDER: Delete this after you created the AJAX functionality of
//                deleting a user like.
function get_completely_presented_user_likes_array() {
    global $session;

    //
    $query = "SELECT * ";
    $query .= "FROM Likes ";
    $query .= "INNER JOIN UsersAndLikes ";
    $query .= "ON Likes.id = UsersAndLikes.like_id ";
    $query .= "WHERE UsersAndLikes.user_id = {$session->currently_viewed_user_id}";


    //
    $user_likes_records_result_set = Like::read_by_query($query);


    //
    $completely_presented_user_likes_array = array();


    //
    require_once("../__model/my_database.php");
    global $database;

    while ($row = $database->fetch_array($user_likes_records_result_set)) {
//    echo "<td>" . "{$row['Name']}" . "</td>";
//
//    // If the actual user is viewing her own account,
//    // then let her delete her likes.
//    if ($_SESSION["actual_username"] == $_SESSION["username"]) {
//        echo "<td>";
//        echo "<a href='a_like_deletion.php?like_id={$row["LikeId"]}'>delete</a>";
//        echo "</td>";
//    }        
        //
        $completely_presented_user_like = "<td><label class='like_name'>{$row['name']}</label></td>";

        // TODO: NOW
        if ($session->is_viewing_own_account()) {
//            $completely_presented_user_like .= "<td><a>delete</a></td>";
            $completely_presented_user_like .= "<td>";
            $completely_presented_user_like .= "<form class='form_delete_like' action='../__controller/controller_users_and_likes.php' method='post'>";
            $completely_presented_user_like .= "<input type='submit' class='form_button' name='delete_like_map' value='delete'>";
            $completely_presented_user_like .= "<input type='hidden' name='like_id' value='{$row['id']}'>";
            $completely_presented_user_like .= "</form>";
            $completely_presented_user_like .= "</td>";
        }


        //
        array_push($completely_presented_user_likes_array, $completely_presented_user_like);
    }


    // 
    return $completely_presented_user_likes_array;
}

function get_like_objects_array() {
    global $session;

    // Query.
    $query = "SELECT * ";
    $query .= "FROM Likes ";
    $query .= "INNER JOIN UsersAndLikes ";
    $query .= "ON Likes.id = UsersAndLikes.like_id ";
    $query .= "WHERE UsersAndLikes.user_id = {$session->currently_viewed_user_id}";


    //
    $result_set = Like::read_by_query($query);

    global $database;

    //
    $like_objects_array = array();


    while ($row = $database->fetch_array($result_set)) {

        $a_like_object = array("id" => $row['id'], "name" => $row['name']);

        //
        array_push($like_objects_array, $a_like_object);
    }


    // 
    return $like_objects_array;
}

function show_add_a_like_button() {
    global $session;
    if ($session->is_viewing_own_account()) {
        echo "<button id='add_a_like_button' class='form_button'>+add a like</button>";
    }
}

function create_like_record($allowed_assoc_indexes_for_post) {
    $the_like_value = $_POST["the_like_value"];
    $the_like_object = null;

    // If it is, read and instantiate the_like_object.
    if (is_already_in_table_record($the_like_value)) {
        MyDebugMessenger::add_debug_message("The new like being added already exists in the table record.");
        MyValidationErrorLogger::log("log::: The new like being added already exists in the table record.");

        // Read and instantiaate.
        $query = "SELECT * FROM Likes ";
        $query .= "WHERE name = '{$the_like_value}' LIMIT 1";

        //
        $returned_like_objects = Like::read_by_query_and_instantiate($query);
        $the_like_object = $returned_like_objects[0];
    }
    // Else, create a new like record.
    else {
        MyDebugMessenger::add_debug_message("The new like being added is a new one.");

        // Create a record.
        $the_like_object = new Like();
        $the_like_object->id = null;
        $the_like_object->name = $the_like_value;

        // This method will create a new record in the db
        // and actually give a valid id attribute to the new object.
        $the_like_object->create_with_bool();
        MyDebugMessenger::add_debug_message("The new like has been created.");
        MyValidationErrorLogger::log("log::: The new like has been created.");
    }


    // Check if the like object was instantiated.
    if (isset($the_like_object)) {
        // Check if it's already in user's likes.
        if (did_user_already_like($the_like_object->id)) {
//            $can_proceed = false;
            MyDebugMessenger::add_debug_message("User already liked that.");
            MyValidationErrorLogger::log("log::: User already liked that.");
        } else {
//            $can_proceed = true;
            MyDebugMessenger::add_debug_message("User hasn't already liked that.");
            MyValidationErrorLogger::log("log::: User hasn't already liked that.");


            // Add mapping to table "UsersAndLikes".
            create_mapping_record($the_like_object->id);
            return true;
        }
    } else {
        return false;
    }
}
?>






<?php

// TODO:SECTION: Meat.
// For like addition.
if (is_request_post() && isset($_POST["add_the_like"]) && $_POST["add_the_like"] == "yes") {
    //
    $allowed_assoc_indexes_for_post = array('the_like_value');

// These value are for error logs.
    $json_errors_array = array("error_the_like_value" => "", "is_result_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "");



    $can_proceed = false;

    MyValidationErrorLogger::initialize();


    // Check csrf_token.
    if (is_csrf_token_legit()) {
        $can_proceed = true;

        // TODO:REMINDER: Delete this on production.
        $json_errors_array['POST_csrf_token'] = $_POST['csrf_token'];
        $json_errors_array['SESSION_csrf_token'] = $_SESSION['csrf_token'];
    } else {
        $can_proceed = false;
    }


    // White listing POST vars.
//    $dirty_array = are_post_vars_valid($allowed_assoc_indexes_for_post);
    if ($can_proceed && are_post_vars_valid($allowed_assoc_indexes_for_post)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }



    // Validate inputs.
    $var_lengts_arr = array("the_like_value" => ["min" => 2, "max" => 50]);

    if ($can_proceed && validate_vars_lengths($var_lengts_arr)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }






    /* Here's I'll know if there's an error overall or not. */
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }

    /* Log the errors. */
    // Put to the JSON array the first error for each error type.
    // Here, basically, one $log_error_msg is like:
    //      csrf_token::: not valid
    // So the returned json_error_array will have:
    //      json.error_csrf_token => "* not valid"
    foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
        MyDebugMessenger::add_debug_message($log_error_msg);
        // Find which field that error is based on "field::: is bad" log_error_msg.
        // $pos = position of :::
        $pos = strpos($log_error_msg, ":::");

        $error_field = "error_" . substr($log_error_msg, 0, $pos);

        // If the error_field in the $json_errors_array doesn't have value yet,
        // add the log_error_msg.
        if ($json_errors_array[$error_field] == "") {
            $json_errors_array[$error_field] = "* " . substr($log_error_msg, $pos + 4);
        }
    }


    MyValidationErrorLogger::reset();



    // Try to add record to db.
    if ($can_proceed && create_like_record($allowed_assoc_indexes_for_post)) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }

    echo json_encode($json_errors_array);
}


// TODO:REMINDER: Delete this after you've implemented the AJAX handler if (isset($_POST["add_a_like"])) {}
if (isset($_POST["add_like"])) {
//    echo "controller_like.php";
    $can_proceed = false;

    // Validate the new like.
    validate_inputs();
    // If the code goes up to here, that means the validation passed.
    $a_new_like = $_POST["a_new_like"];


    // Check if it's already in table likes.
    $a_new_like_id;
    $the_like_object;

    // If it is, read and instantiate the_like_object.
    if (is_already_in_table_record($a_new_like)) {
        MyDebugMessenger::add_debug_message("The new like being added already exists in the table record.");

        // Read and instantiaate.
        $query = "SELECT * FROM Likes ";
        $query .= "WHERE name = '{$a_new_like}' LIMIT 1";

        //
        $returned_like_objects = Like::read_by_query_and_instantiate($query);
        $the_like_object = $returned_like_objects[0];
    }
    // Else, create a new like record.
    else {
        MyDebugMessenger::add_debug_message("The new like being added is a new one.");

        // Create a record.
        $the_like_object = new Like();
        $the_like_object->id = null;
        $the_like_object->name = $a_new_like;

        // This method will create a new record in the db
        // and actually give a valid id attribute to the new object.
        $the_like_object->create_with_bool();
        MyDebugMessenger::add_debug_message("The new like has been created.");
    }


    // Check if it's already in user's likes.
    if (did_user_already_like($the_like_object->id)) {
        $can_proceed = false;
        MyDebugMessenger::add_debug_message("User already liked that.");
    } else {
        $can_proceed = true;
        MyDebugMessenger::add_debug_message("User hasn't already liked that.");
    }



    // Add/deny the addition of like to table "Likes".
    if ($can_proceed) {
        // Add mapping to table "UsersAndLikes".
        create_mapping_record($the_like_object->id);
    }

    redirect_to("../__view/view_profile.php");
}


// For likes population.
if (isset($_POST["populate_likes"]) && $_POST["populate_likes"] == "yes") {
    $result_array = array("is_result_ok" => true, "like_objects_array" => get_like_objects_array());


    if ($session->is_viewing_own_account()) {
        $result_array["is_viewing_own_account"] = true;
    } 
    else {
        $result_array["is_viewing_own_account"] = false;
    }


    echo json_encode($result_array);
}
?>
