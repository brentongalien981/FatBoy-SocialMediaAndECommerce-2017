<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_like.php"); ?>




<?php
//// Protected page.
////global $session;
if (!$session->is_logged_in()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<!--Functions-->
<?php

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
    }
    else {
        MyDebugMessenger::add_debug_message("FAIL adding record to mapping table.");
    }
}

function get_completely_presented_user_likes_array() {
    global $session;
    
    //
    $query = "SELECT * ";
    $query .= "FROM Likes ";
    $query .= "INNER JOIN UsersAndLikes ";
    $query .= "ON Likes.id = UsersAndLikes.like_id ";
    $query .= "WHERE UsersAndLikes.user_id = {$session->actual_user_id}";
    
    
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
        $completely_presented_user_like = "<td>{$row['name']}</td>";
        
        // TODO: NOW
        if ($session->is_viewing_own_account()) {
//            $completely_presented_user_like .= "<td><a>delete</a></td>";
            $completely_presented_user_like .= "<td>";
            $completely_presented_user_like .= "<form class='form_delete_like' action='../__controller/controller_users_and_likes.php' method='post'>";
            $completely_presented_user_like .= "<input type='submit' name='delete_like_map' value='delete'>";
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
?>





<!--Meat-->
<?php
// For like addition.
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
?>





<?php
//redirect_to("../__view/view_profile.php");
?>