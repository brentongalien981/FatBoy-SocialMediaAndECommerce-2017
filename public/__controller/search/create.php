<?php

use App\Privado\HelperClasses\Validation\Validator;
use App\Privado\HelperClasses\Search;

// TODO:SECTION: AJAX Event-handler.
if (isset($_GET["search"]) && $_GET["search"] == "yes") {
    //
    $allowed_assoc_indexes_for_get = array("search_value");

    $validator = get_validator_obj($allowed_assoc_indexes_for_get);

    $is_validation_ok = $validator->validate();





    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok) {
        $search_obj = new Search($_GET["search_value"]);
        
        // TODO:LOG
        $json_errors_array['num_of_suggestions'] = $search_obj->get_num_of_suggestions();
        $json_errors_array['the_query'] = $search_obj->the_query;

        if ($search_obj->get_num_of_suggestions() > 0) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
            $json_errors_array['suggested_objs_array'] = $search_obj->get_suggested_objs_array();
        }
    }


    //
    echo json_encode($json_errors_array);
}
?>





<?php

// TODO:SECTION: Functions
function get_validator_obj(&$allowed_assoc_indexes) {
    //
    $required_vars_length_array = array("search_value" => ["min" => 1, "max" => 100]);

//
    $validator = new Validator();
    $validator->set_request_type("get");
    $validator->set_allowed_post_vars($allowed_assoc_indexes);
    $validator->set_required_post_vars_length_array($required_vars_length_array);

    return $validator;
}
?>