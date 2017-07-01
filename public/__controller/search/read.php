<?php

use App\Privado\HelperClasses\Search; ?>

<?php

// TODO:SECTION: AJAX Event-handler.
if (isset($_GET["show_all_search_suggestions"]) && $_GET["show_all_search_suggestions"] == "yes") {
    redirect_to(LOCAL . "/public/__view/search");
    echo json_encode(array("is_result_ok" => false));
}


if (isset($_GET["fetch_all_search_suggestions"]) && $_GET["fetch_all_search_suggestions"] == "yes") {
    $json = array();
    $suggested_objs_array = array();

    
    foreach (Search::get_searchable_class_names() as $current_class_index => $class) {
        $table = Search::get_searchable_table_names()[$current_class_index];
        $category_num_of_suggestions = 0;
        $query = Search::get_session_search_query()[$table];
        
        // Remove the part " LIMIT n" from the query.
        $index_of_waste_query = strpos($query, " LIMIT");
        $query = substr($query, 0, $index_of_waste_query);
        
        
        $suggested_objs_array[$table . "_objs_array"] = Search::get_an_array_of_objs($table, $current_class_index, $query, $category_num_of_suggestions);
        
        
        
        // TODO:LOG
        $json["class" . $current_class_index] = $class;
        $json["table" . $current_class_index] = $table;
        $json["query_" . $table] = $query;
    }
    
    $json["suggested_objs_array"] = $suggested_objs_array;

    $json["is_result_ok"] = true;
    echo json_encode($json);
}
?>





<?php

// TODO:SECTION: Functions
?>