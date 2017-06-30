<?php

namespace App\Privado\HelperClasses;

require_once(PUBLIC_PATH . "/__model/my_user.php");
require_once(PUBLIC_PATH . "/__model/model_my_store_items.php");

use User;
use MyStoreItems;

class Search {

    // TODO:REMINDER: Change this to null.
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

            foreach ($this->class_names[$index]::$searchable_fields as $current_searchable_table_field_key => $current_searchable_table_field) {
                if ($current_searchable_table_field_key == 0) {
                    $query .= " WHERE";
                } else {
                    $query .= " OR";
                }

                $query .= " " . $current_searchable_table_field . " LIKE '%{$search_value}%'";
            }

            // Instantiate the object
            $class_objs_array = $this->class_names[$index]::read_by_query_and_instantiate($query);

            //
            $this->num_of_suggestions += count($class_objs_array);

            // TODO:LOG
            $this->the_query[$index] = $query;

            // Put object in the array
            // Set the array.
            $this->suggested_objs_array[$table . "_objs_array"] = $class_objs_array;
        }
    }

    public function get_suggested_objs_array() {
        return $this->suggested_objs_array;
    }

    // TODO:REMINDER: Delete this.
    public function xxx($allowed_post_vars_array) {
        
    }

    public function set_num_of_suggestions($num_of_suggestions) {
        $this->num_of_suggestions = $num_of_suggestions;
    }

    public function get_num_of_suggestions() {
        return $this->num_of_suggestions;
    }

}

?>
