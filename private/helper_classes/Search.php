<?php

namespace App\Privado\HelperClasses;

require_once(PUBLIC_PATH . "/__model/my_user.php");
require_once(PUBLIC_PATH . "/__model/model_my_store_items.php");

//use User;
//use MyStoreItems;

class Search {

    private $num_of_suggestions = 0;
    private $table_names = array("Users", "MyStoreItems");
    private $class_names = array("User", "MyStoreItems");
    private $suggested_objs_array = array();
    public $the_query = array();

    function __construct($search_value) {
        $this->set_suggested_objs_array($search_value);
    }

    private function set_suggested_objs_array($search_value) {
        $query = null;

        foreach ($this->table_names as $index => $table) {
            // Query
            $query = "SELECT * FROM {$table}";

            if ($table == "MyStoreItems") {
                $query .= " INNER JOIN Users ON MyStoreItems.user_id = Users.user_id";
            }

            foreach ($this->class_names[$index]::$searchable_fields as $current_searchable_table_field_key => $current_searchable_table_field) {
                if ($current_searchable_table_field_key == 0) {
                    $query .= " WHERE";
                } else {
                    $query .= " OR";
                }

                $query .= " " . $current_searchable_table_field . " LIKE '%{$search_value}%'";
            }

            $query .= " LIMIT 3";



            $class_objs_array = null;

            if ($table == "MyStoreItems") {
                // Instantiate the object
                $result_set = $this->class_names[$index]::read_by_query($query);


                global $database;


                $num_of_results = $database->get_num_rows_of_result_set($result_set);
                if ($num_of_results > 0) {
                    $class_objs_array = array();

                    //
                    $this->num_of_suggestions += $num_of_results;
                }

                while ($row = $database->fetch_array($result_set)) {
                    $MyStoreItems_pseudo_obj = array("id" => $row['id'],
                        "name" => $row['name'],
                        "description" => $row['description'],
                        "user_id" => $row['user_id'],
                        "user_name" => $row['user_name'],);

                    array_push($class_objs_array, $MyStoreItems_pseudo_obj);
                }
            } else {
                // Instantiate the object
                $class_objs_array = $this->class_names[$index]::read_by_query_and_instantiate($query);

                //
                $this->num_of_suggestions += count($class_objs_array);
            }




            // TODO:LOG
            $this->the_query[$index] = $query;

            // Put object in the array
            // Set the array.
            if ($class_objs_array != null) {
                $this->suggested_objs_array[$table . "_objs_array"] = $class_objs_array;
            }
        }
    }

    public function get_suggested_objs_array() {
        return $this->suggested_objs_array;
    }

    public function set_num_of_suggestions($num_of_suggestions) {
        $this->num_of_suggestions = $num_of_suggestions;
    }

    public function get_num_of_suggestions() {
        return $this->num_of_suggestions;
    }

}

?>
