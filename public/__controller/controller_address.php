<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_address.php"); ?>

<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php

// Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>





<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php

// TODO: NOW
$can_procced = false;

if (isset($_POST["save_address"])) {
    // Kind of encode the vars in a form that is
    // harmless to db. Avoid SQL injection.    
    $street1 = $_POST["street1"];
    $street2 = $_POST["street2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $country_code = $_POST["country_code"];
    $address_type_code = $_POST["address_type_code"];


    // Validation time.
    MyValidationErrorLogger::initialize();

    // Check if the fields are empty.
    $required_fields = array("street1", "city", "state", "zip", "country_code", "address_type_code");
    validate_presences($required_fields);


    // Check the length of the input data.
    $fields_with_max_lengths = array("street1" => 500, "street2" => 500, "city" => 100, "state" => 50, "zip" => 10, "country_code" => 50);
    validate_max_lengths($fields_with_max_lengths);

// What you should be checking here is that,
// if the MyValidationErrorLogger is not empty, then ask again for credentials.
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS Address validation.");

        $can_procced = true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL Address validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        redirect_to("../__view/view_profile.php");
    }
}


if ($can_procced) {
    $new_address = new Address();


    $new_address->id = null;
    $new_address->user_id = $session->actual_user_id;
    $new_address->street1 = $street1;
    $new_address->street2 = $street2;
    $new_address->city = $city;
    $new_address->state = $state;
    $new_address->zip = $zip;
    $new_address->address_type_code = $address_type_code;
    $new_address->country_code = $country_code;
    $new_address->phone = null;

    $address_creation_result_flag = $new_address->create_with_bool();


    if ($address_creation_result_flag) {
        MyDebugMessenger::add_debug_message("SUCCESS creation and insertion of an address record.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL creation and insertion of an address record.");
    }


    redirect_to("../__view/view_profile.php");
}
?>






<?php

function f() {
    
}
?>





<?php

//redirect_to("../__view/view_log_in.php");
?>