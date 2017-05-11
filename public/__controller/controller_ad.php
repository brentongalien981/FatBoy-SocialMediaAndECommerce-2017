<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_ad.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php");     ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php");     ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php

// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<?php

// TODO: SECTION: Functions.
function create_ad_record() {

    //
    global $session;

    $new_ad_obj = new Ad();
    $new_ad_obj->id = null;
    $new_ad_obj->producer_user_id = $session->actual_user_id;
    $new_ad_obj->ad_name = $session->ad_name;
    $new_ad_obj->description = $session->ad_description;
    $new_ad_obj->photo_url_address = $session->ad_photo_url_address;
    $new_ad_obj->num_aired = 0; // Default number.
    $new_ad_obj->target_num_airings = $session->ad_target_num_airings;
    $new_ad_obj->budget = $session->ad_budget;
    $new_ad_obj->air_time = $session->ad_air_time;
    $new_ad_obj->status_id = $session->ad_status_id;

    $is_creation_ok = $new_ad_obj->create_with_bool();

    return $is_creation_ok;
}

function show_produced_ads() {
    show_table_header();
    
    show_ad_items();
}

function show_table_header() {
    //
    echo "<table id='table_ad_market'>";
    
    echo "<thead>";
    
    echo "<td>";
    echo "Producer";
    echo "</td>";
    
    echo "<td>";
    echo "Ad Title";
    echo "</td>";  
    
    echo "<td>";
    echo "Budget";
    echo "</td>";      
    
    echo "<td>";
    echo "Pays";
    echo "</td>";     
    
    echo "<td>";
    echo "Aired";
    echo "</td>"; 
    
    echo "<td>";
    echo "Target";
    echo "</td>";  
    
    echo "<td>";
    echo "Completion";
    echo "</td>";  

    echo "<td>";
    echo "Air Time";
    echo "</td>";  
    
    echo "<td>";
    echo "Sample";
    echo "</td>"; 
    
    echo "<td>";
    echo "Action";
    echo "</td>";     
    
//    echo "<td>";
//    echo "Sample Ad Photo";
//    echo "</td>";    
    
    echo "</thead>";
}

function show_ad_items() {
    //
    $query = "SELECT * FROM Ad a ";
    $query .= "INNER JOIN Users u ON a.producer_user_id = u.user_id ";
    $query .= "WHERE status_id = 1";

    $record_results = Ad::read_by_query($query);


    //
    global $database;
    while ($row = $database->fetch_array($record_results)) {
        echo "<tr id='tr_{$row['id']}' class='ad_market_trs'>";
        
        echo "<td>";
        echo "{$row['user_name']}";
        echo "</td>";        

        echo "<td>";
        echo "{$row['ad_name']}";
        echo "</td>";
        
        echo "<td>";
        echo "\${$row['budget']}";
        echo "</td>";        
        
        echo "<td>";
        $pays = $row['budget'] / $row['target_num_airings'];
        $pays *= 100.00;
        echo "&cent;{$pays} per view";
        echo "</td>";        
        
        echo "<td>";
        echo "{$row['num_aired']} times";
        echo "</td>"; 
        
        echo "<td>";
        echo "{$row['target_num_airings']} airings";
        echo "</td>";    
        
        
        //
        $completion = $row['num_aired'] / $row['target_num_airings'];
        $completion *= 100;
        
        echo "<td>";
        echo "{$completion}%";
        echo "</td>";  
        
        
        
        
        echo "<td>";
        echo "{$row['air_time']} sec";
        echo "</td>"; 
        


        echo "<td>";
        echo "<button id='button_show_ad_{$row['id']}' onclick='show_ad_sample({$row['id']})'>view ad</button>";
        echo "</td>"; 



        // Form.
        echo "<td>";
        echo "<form>";
        echo "<input type='submit' name='host_ad' value='host ad'>";
        echo "</form>";
        echo "</td>";         
        


//        echo "<td>";
////        echo "<img src='{$row['photo_url_address']}'>";
//        echo "<iframe src='{$row['photo_url_address']}'>";
//        echo "</iframe>";
//        echo "</td>";


        echo "</tr>";
    }


    echo "</table>";
}

function validate_produce_ad_fields() {
    // Fuckin need 
    MyValidationErrorLogger::initialize();


    // Validations
    $required_fields = array("ad_name", "ad_photo_url_address", "ad_description", "ad_target_num_airings", "ad_budget", "ad_air_time");
    validate_presences($required_fields);


    $fields_with_max_lengths = array("ad_name" => 150, "ad_photo_url_address" => 500, "ad_description" => 3000, "ad_target_num_airings" => 14, "ad_budget" => 14, "ad_air_time" => 3);
    validate_max_lengths($fields_with_max_lengths);


    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS new produce ad item validation.");

        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL new produce ad item validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }


        // 
        return false;
    }
}

function unset_session_ad_vars() {
    global $session;
    $session->set_ad_name(null);


    $session->set_ad_description(null);


    $session->set_ad_photo_url_address(null);


    $session->set_ad_target_num_airings(null);


    $session->set_ad_budget(null);


    $session->set_ad_air_time(null);


    // 2 is the AdStatus.id for inactive.
    $session->set_ad_status_id(null);
}

function set_session_ad_vars() {
    global $session;
    $session->set_ad_name($_POST["ad_name"]);


    $session->set_ad_description($_POST["ad_description"]);


    $session->set_ad_photo_url_address($_POST["ad_photo_url_address"]);


    $session->set_ad_target_num_airings($_POST["ad_target_num_airings"]);


    $session->set_ad_budget($_POST["ad_budget"]);


    $session->set_ad_air_time($_POST["ad_air_time"]);


    // 2 is the AdStatus.id for inactive.
    $session->set_ad_status_id(2);
}
?>











<?php

// TODO: SECTION: Meat.
if (isset($_POST["produce_ad"])) {
    // Keep the values of the fields to session ad vars.
    set_session_ad_vars();



    // Validate produce ad fields.
    $is_validation_ok = validate_produce_ad_fields();

    //
    if ($is_validation_ok) {
        //
        $is_creation_ok = create_ad_record();

        //
        if ($is_creation_ok) {
            //
            MyDebugMessenger::add_debug_message("SUCCESS producing ad.");

            //
            unset_session_ad_vars();
        } else {
            //
            MyDebugMessenger::add_debug_message("FAIL producing ad.");
        }

        //
        redirect_to(LOCAL . "/public/__view/view_my_ads");
    } else {
        //
        MyDebugMessenger::add_debug_message("Validation of fields didn't pass.");

        redirect_to(LOCAL . "/public/__view/view_my_ads");
    }
}
?>