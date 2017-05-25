<?php

// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_ad.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_user_hosted_ad.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item.php");              ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_invoice_item_status_record.php");              ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php

// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
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

function get_sum_airs_of_active_user_hosted_ads($currently_viewed_user_id) {
    $query = "SELECT SUM(UserHostedAd.num_air_hosted) ";
    $query .= "FROM UserHostedAd ";
    $query .= "WHERE UserHostedAd.user_id = {$currently_viewed_user_id}";

    $record_result = UserHostedAd::read_by_query($query);

    global $database;
    $sum_airs_of_active_user_hosted_ads = null;

    while ($row = $database->fetch_array($record_result)) {
        $sum_airs_of_active_user_hosted_ads = $row[0];
        break;
    }

    return $sum_airs_of_active_user_hosted_ads;
}

function get_initial_ad_id_for_airing() {
    global $session;
    $query = "SELECT ad_id, photo_url_address ";
    $query .= "FROM UserHostedAd ";
    $query .= "INNER JOIN Ad ON UserHostedAd.ad_id = Ad.id ";
    $query .= "WHERE UserHostedAd.user_id = {$session->currently_viewed_user_id} ";
    $query .= "AND UserHostedAd.status_id = 1 "; // 1 is active.
    $query .= "AND Ad.status_id = 1 "; // 1 is active.    
    $query .= "AND allotment_percentage > 0";


    $record_results = UserHostedAd::read_by_query($query);

    global $database;
    
    $num_record_results = $database->get_num_rows_of_result_set($record_results);
    
    if ($num_record_results == 0) {
        return -69;
    }

    while ($row = $database->fetch_array($record_results)) {
        // 
        return $row['ad_id'];
    }
}

function show_ad($currently_viewed_user_id) {
    // Query SUM the num_aired of all active user hosted ads.
    $sum_airs_of_active_user_hosted_ads = get_sum_airs_of_active_user_hosted_ads($currently_viewed_user_id);

    // TODO: REMINDER: If $sum_airs_of_active_user_hosted_ads is 0, just
    // show any user_hosted_ad that is active host-wise and market-wise, and has
    // allotment_percentage that is greater than 0.
    if ($sum_airs_of_active_user_hosted_ads == null) {
        return;
    }
    
    if ($sum_airs_of_active_user_hosted_ads == 0) {
//        echo "DEBUG: Just show the hosted ad that has\n the highest allotment_percentage...";
        $initial_ad_id_for_airing = get_initial_ad_id_for_airing();
        
        //
        if ($initial_ad_id_for_airing == -69) {
            return;
        }

        // Increment ad market airing.
        $is_update_ok = increment_general_num_aired_for_ad($initial_ad_id_for_airing);

        if (!$is_update_ok) {
            // Error could be query update or num_aired has reached the target limit.
            // But most likely, it's the target limit.
            // So just set that user_hosted_ad's allotment_rating to "undef" and
            // loop back to search for the ad to be shown.
//            echo "FAIL METHOD increment_general_num_aired_for_ad().";
            return;
        }

        //
        // Increment the num_air_hosted for table UserHostedAd.
        $is_update_ok = increment_num_aired_for_user_hosted_ad($initial_ad_id_for_airing);

        if ($is_update_ok) {
            //
            respond_with_ad_src($initial_ad_id_for_airing);
        } else {
//            echo "FAIL METHOD increment_num_aired_for_user_hosted_ad().";
        }



        //
        return;
    }


    // Calculate airing percentages of all active user hosted ads.
    // $airing_percentage = $ad_num_aired / $sum_airs_of_active_user_hosted_ads
    // NOTE: that if the $sum_airs_of_active_user_hosted_ads is 0, just put "undef" as the value...
    $hosted_ads_with_airing_percentages_arr = get_hosted_ads_with_airing_percentages_arr($sum_airs_of_active_user_hosted_ads);



    // Calculate how close the  [($hosted_ad_airing_percentage) / ($hosted_ad_allotment_percentage)] <== (**I will call this allotement_rating**)
    // to value 1.0000...
    // The hosted ad which has the least value will be shown.
    $hosted_ads_with_allotment_ratings_arr = get_hosted_ads_with_allotment_ratings_arr($hosted_ads_with_airing_percentages_arr);


    // TODO: MARK: This should be the start of the loop.
    while (true) {
        // Show the user_hosted_ad that has the lowest allotment_rating.
//    $least_rated_ad_id = show_least_rated_allotment($hosted_ads_with_allotment_ratings_arr);
        $least_rated_ad_id = get_least_rated_ad_id($hosted_ads_with_allotment_ratings_arr);



        // If there's no available ad to be shown..
        if ($least_rated_ad_id == -69) {
//        respond_with_ad_src($least_rated_ad_id);
//            echo "There'n no valid ad to be shown.";
            return;
        }


        // TODO: DEBUG
//    echo "\n\$least_rated_ad_id: {$least_rated_ad_id}\n";
        // Increment the num_aired for table Ad.
        $is_update_ok = increment_general_num_aired_for_ad($least_rated_ad_id);

        if (!$is_update_ok) {
            // Error could be query update or num_aired has reached the target limit.
            // But most likely, it's the target limit.
            // So just set that user_hosted_ad's allotment_rating to "undef" and
            // loop back to search for the ad to be shown.
//            echo "FAIL METHOD increment_general_num_aired_for_ad()";
            $hosted_ads_with_allotment_ratings_arr["{$least_rated_ad_id}"] = "undef";

            continue;
        } else {
            break;
        }
    }




    // Increment the num_air_hosted for table UserHostedAd.
    $is_update_ok = increment_num_aired_for_user_hosted_ad($least_rated_ad_id);

    if ($is_update_ok) {
        // 
        respond_with_ad_src($least_rated_ad_id);
    } else {
//        echo "FAIL METHOD increment_num_aired_for_user_hosted_ad()";
        return;
    }
}

function increment_general_num_aired_for_ad($least_rated_ad_id) {
    // Check first if num_aired is less than target_airings.
    $query = "SELECT * FROM Ad ";
    $query .= "WHERE id = {$least_rated_ad_id} LIMIT 1";

    $record_result = Ad::read_by_query($query);

    global $database;

    $is_num_aired_less_than_target = false;

    while ($row = $database->fetch_array($record_result)) {
        // 
        if ($row['num_aired'] < $row['target_num_airings']) {
            $is_num_aired_less_than_target = true;
        }
    }


    if (!$is_num_aired_less_than_target) {
//        echo "\nNumber of airings has now reached the target limit.\n";
        return false;
    }

    // If the code goes here, that means airing is still less than target.
    // Update.
    $query = "UPDATE Ad ";
    $query .= "SET num_aired = (num_aired + 1) ";
    $query .= "WHERE id = {$least_rated_ad_id}";

    $is_update_ok = Ad::update_by_query($query);

    return $is_update_ok;
}

function increment_num_aired_for_user_hosted_ad($least_rated_ad_id) {
    global $session;
    $query = "UPDATE UserHostedAd ";
    $query .= "SET UserHostedAd.num_air_hosted = (UserHostedAd.num_air_hosted + 1) ";
    $query .= "WHERE ad_id = {$least_rated_ad_id} ";
    $query .= "AND user_id = {$session->currently_viewed_user_id}";

    $is_update_ok = UserHostedAd::update_by_query($query);

    return $is_update_ok;
}

function get_least_rated_ad_id($hosted_ads_with_allotment_ratings_arr) {

    $least_rated_ad_id = -69;

    $least_alloted_rating = -69;

    // Just do this to have an initial value for the
    // vars to test.
    foreach ($hosted_ads_with_allotment_ratings_arr as $key => $value) {
        if ($value === "undef") {
            continue;
        } else {
            $least_alloted_rating = $value;
        }
    }


    //
    if ($least_alloted_rating == -69) {
//        echo "There'n no valid ad to be shown.";
        return $least_rated_ad_id;
    }



    // Figure the least_rated ad.
    foreach ($hosted_ads_with_allotment_ratings_arr as $key => $value) {
        // If $value is undef, that means the user_host hasn't
        // alloted a percentage yet.. Meaning it has 0 allotment percentage.
        // So just skip that ad.
        if ($value === "undef") {
//            echo "\nvalue is equal to undef...\n";
            continue;
        }


        //
        if ($value <= $least_alloted_rating) {
//            echo "\nvalue is less than or equal to least_alloted_rating...\n";
            $least_rated_ad_id = $key;
            $least_alloted_rating = $value;
        }
    }


    return $least_rated_ad_id;


//    if ($least_rated_ad_id != -69) {
//        respond_with_ad_src($least_rated_ad_id);
//
//        return $least_rated_ad_id;
//    } else {
//        echo "There'n no valid ad to be shown.";
//    }
}

//function show_least_rated_allotment($hosted_ads_with_allotment_ratings_arr) {
//
//    $least_rated_ad_id = -69;
//
//    $least_alloted_rating = -69;
//
//    // Just do this to have an initial value for the
//    // vars to test.
//    foreach ($hosted_ads_with_allotment_ratings_arr as $key => $value) {
//        if ($value === "undef") {
//            continue;
//        } else {
//            $least_alloted_rating = $value;
//        }
//    }
//
//
//    //
//    if ($least_alloted_rating == -69) {
//        echo "There'n no valid ad to be shown.";
//        return;
//    }
//
//
//
//    // Figure the least_rated ad.
//    foreach ($hosted_ads_with_allotment_ratings_arr as $key => $value) {
//        // If $value is undef, that means the user_host hasn't
//        // alloted a percentage yet.. Meaning it has 0 allotment percentage.
//        // So just skip that ad.
//        if ($value === "undef") {
////            echo "\nvalue is equal to undef...\n";
//            continue;
//        }
//
//
//        //
//        if ($value <= $least_alloted_rating) {
////            echo "\nvalue is less than or equal to least_alloted_rating...\n";
//            $least_rated_ad_id = $key;
//            $least_alloted_rating = $value;
//        }
//    }
//
//
//
////    echo "\n\$least_rated_ad_id: {$least_rated_ad_id}\n";
////    echo "\n\$least_alloted_rating: {$least_alloted_rating}\n";
//    //
//    if ($least_rated_ad_id != -69) {
//        respond_with_ad_src($least_rated_ad_id);
//
//        return $least_rated_ad_id;
//    } else {
//        echo "There'n no valid ad to be shown.";
//    }
//}

function respond_with_ad_src($least_rated_ad_id) {
    //
    $query = "SELECT * FROM Ad ";
    $query .= "WHERE id = {$least_rated_ad_id}";

    $record_result = UserHostedAd::read_by_query($query);

    global $database;

    while ($row = $database->fetch_array($record_result)) {

        // 
        echo "{$row['photo_url_address']}";
    }
}

function get_hosted_ads_with_allotment_ratings_arr($hosted_ads_with_airing_percentages_arr) {
    global $session;
    $query = "SELECT ad_id, allotment_percentage ";
    $query .= "FROM UserHostedAd ";
    $query .= "INNER JOIN Ad ON UserHostedAd.ad_id = Ad.id ";
    $query .= "WHERE UserHostedAd.user_id = {$session->currently_viewed_user_id} ";
    $query .= "AND UserHostedAd.status_id = 1 "; // 1 is active.
    $query .= "AND Ad.status_id = 1"; // 1 is active.

    $record_results = UserHostedAd::read_by_query($query);

    global $database;

    $hosted_ads_with_allotment_ratings_arr = array();

    while ($row = $database->fetch_array($record_results)) {
        // This is to avoid the division of zero.
        if ($row['allotment_percentage'] == 0) {
            $hosted_ads_with_allotment_ratings_arr["{$row['ad_id']}"] = "undef";
        } else {
            $hosted_ads_with_allotment_ratings_arr["{$row['ad_id']}"] = $hosted_ads_with_airing_percentages_arr["{$row['ad_id']}"] / ($row['allotment_percentage'] / 100);
        }
    }

    return $hosted_ads_with_allotment_ratings_arr;
}

function get_hosted_ads_with_airing_percentages_arr($sum_airs_of_active_user_hosted_ads) {
    global $session;
    $query = "SELECT ad_id,  num_air_hosted ";
    $query .= "FROM UserHostedAd ";
    $query .= "INNER JOIN Ad ON UserHostedAd.ad_id = Ad.id ";
    $query .= "WHERE UserHostedAd.user_id = {$session->currently_viewed_user_id} ";
    $query .= "AND UserHostedAd.status_id = 1 "; // 1 is active.
    $query .= "AND Ad.status_id = 1"; // 1 is active.

    $record_results = UserHostedAd::read_by_query($query);

    global $database;

    $hosted_ads_with_airing_percentages_arr = array();

    while ($row = $database->fetch_array($record_results)) {
        $hosted_ads_with_airing_percentages_arr["{$row['ad_id']}"] = $row['num_air_hosted'] / $sum_airs_of_active_user_hosted_ads;
    }

    return $hosted_ads_with_airing_percentages_arr;
}

function show_user_hosted_ads_table_header() {
    //
    echo "<div id='container_for_table_hosted_ads'>";
    echo "<table id='table_hosted_ads'>";

    echo "<thead>";

    echo "<td class='header_cells'>";
    echo "Producer";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Ad Title";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Budget";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Pays";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Aired by Me";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Aired by Public";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Target";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Completion";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Air Time";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Sample";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Hosted Date";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Allotment";
    echo "</td>";

    echo "<td class='header_cells'>";
    echo "Allotment Percentage";
    echo "</td>";

//    echo "<td class='header_cells'>";
//    echo "Sample Ad Photo";
//    echo "</td>";    

    echo "</thead>";
}

function show_table_header() {
    //
    echo "<div id='container_table_ad_market'>";
    echo "<table id='table_ad_market'>";

    echo "<thead id='thead_ad_market'>";

    echo "<td class='header_cells'>";
    echo "Producer";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Ad Title";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Budget";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Pays";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Aired";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Target";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Completion";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Air Time";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Sample";
    echo "</td class='header_cells'>";

    echo "<td class='header_cells'>";
    echo "Action";
    echo "</td class='header_cells'>";

//    echo "<td>";
//    echo "Sample Ad Photo";
//    echo "</td>";    

    echo "</thead>";
}

function get_ad_record($ad_id) {
    return Ad::read_by_id($ad_id);
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
        echo "<button id='button_show_ad_{$row['id']}' class='form_button' onclick='show_ad_sample({$row['id']})'>view ad</button>";
        echo "</td>";



        // Form.
        echo "<td>";
        echo "<form action='" . LOCAL . "/public/__controller/controller_ad.php' method='post'>";
        echo "<input type='hidden' name='ad_id' value='{$row['id']}'>";
        echo "<input type='submit' name='host_ad' class='form_button' value='host ad'>";
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
    echo "</div>";
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

function is_user_already_hosting_ad($ad_id) {
    //
    global $session;

    $query = "SELECT * FROM UserHostedAd ";
    $query .= "WHERE user_id = {$session->actual_user_id} ";
    $query .= "AND ad_id = {$ad_id}";

    $record_results = UserHostedAd::read_by_query($query);

    global $database;
    $num_existing_record = $database->get_num_rows_of_result_set($record_results);

    if ($num_existing_record > 0) {
        return true;
    } else {
        return false;
    }
}

function create_user_hosted_ad_record_bruh($ad_id) {
    global $session;

    $new_hosted_ad_obj = new UserHostedAd();
    $new_hosted_ad_obj->id = null;
    $new_hosted_ad_obj->user_id = $session->actual_user_id;
    $new_hosted_ad_obj->ad_id = $ad_id;
    $new_hosted_ad_obj->num_air_hosted = 0; // Default
    $new_hosted_ad_obj->allotment_percentage = 0.0; // Default
    $new_hosted_ad_obj->status_id = 1; // Default: 1 for active.

    $is_creation_ok = $new_hosted_ad_obj->create_with_bool();

    return $is_creation_ok;
}

function show_user_hosted_ads() {
    //
    show_user_hosted_ads_table_header();


    // 
    global $session;
    $query = "SELECT uha.ad_id, uha.num_air_hosted, uha.allotment_percentage, uha.status_id AS hosting_status_id, uha.hosted_date, ";
    $query .= "a.ad_name, a.num_aired, a.target_num_airings, a.budget, a.air_time, ";
    $query .= "u.user_name ";
    $query .= "FROM UserHostedAd uha ";
    $query .= "INNER JOIN Ad a ON uha.ad_id = a.id ";
    $query .= "INNER JOIN Users u ON a.producer_user_id = u.user_id ";
    $query .= "WHERE uha.user_id = {$session->actual_user_id}";

    $record_results = UserHostedAd::read_by_query($query);

    global $database;

    while ($row = $database->fetch_array($record_results)) {
        echo "<tr id='tr_{$row['ad_id']}' class='hosted_ads_trs'>";

        echo "<td>";
        echo "{$row['user_name']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['ad_name']}";
        echo "</td>";

        echo "<td>";
        echo "{$row['budget']}";
        echo "</td>";


        $pays = $row['budget'] / $row['target_num_airings'];
        $pays *= 100.00;
        echo "<td>";
        echo "&cent;{$pays} per view";
        echo "</td>";



        echo "<td>";
        echo "{$row['num_air_hosted']} times";
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
        echo "<button id='button_show_ad_{$row['ad_id']}' class='form_button' onclick='show_ad_sample({$row['ad_id']})'>view</button>";
        echo "</td>";


        echo "<td>";
        echo "{$row['hosted_date']}";
        echo "</td>";


        //
        echo "<td>";
//        echo "{$row['allotment_percentage']}%";
        echo "<input type='range' id='allotment_range_{$row['ad_id']}' step='0.01' min='0' max='100' value='{$row['allotment_percentage']}' onchange='update_allotment_via_range({$row['ad_id']}, {$row['allotment_percentage']})'>";
        echo "</td>";

        echo "<td>";
        echo "<input type='number' id='allotment_percentage_{$row['ad_id']}' step='0.01' min='0' max='100' value='{$row['allotment_percentage']}' onchange='update_allotment_via_percentage({$row['ad_id']}, {$row['allotment_percentage']})'>%";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

function update_allotment_percentage($ad_id, $update_allotment_percentage) {
    $query = "UPDATE UserHostedAd SET allotment_percentage = {$update_allotment_percentage} ";
    $query .= "WHERE ad_id = {$ad_id}";

    $is_update_ok = UserHostedAd::update_by_query($query);

    if ($is_update_ok) {
        echo "update is ok";
    } else {
        // This should be the only echo value as a responseText for
        // AJAX so that the html percentage and range will revert back
        // to it's old value.
        echo "failed_update_allotment_percentage";
    }

    echo "update is ok";
}

function create_user_hosted_ad_record($ad_id) {
    // Check if the ad is not yet already being 
    // hosted by the user.
    // If
    if (is_user_already_hosting_ad($ad_id)) {
        //
        MyDebugMessenger::add_debug_message("NOTE User is already hosting that ad.");

        // Redirect to the same page.
        redirect_to(LOCAL . "/public/__view/view_my_ads/index.php?content_page=2");
    } else {
        // Create an actual UserHostedAd record.
        $is_creation_ok = create_user_hosted_ad_record_bruh($ad_id);

        //
        if ($is_creation_ok) {
            //
            MyDebugMessenger::add_debug_message("SUCCEESS UserHosted record creation.");

            // Redirect and highlight the row for that hosted ad table.
            redirect_to(LOCAL . "/public/__view/view_my_ads/index.php?content_page=3&newly_hosted_ad_id={$ad_id}");
        } else {
            //
            MyDebugMessenger::add_debug_message("FAIL UserHosted record creation.");
            //
            redirect_to(LOCAL . "/public/__view/view_my_ads/index.php?content_page=2");
        }
    }
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



if (isset($_POST["host_ad"])) {
    //
    create_user_hosted_ad_record($_POST["ad_id"]);
}
?>