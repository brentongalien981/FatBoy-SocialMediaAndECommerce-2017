<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/country.php"); ?>






<?php

function get_countries_objects_array() {
    //
    $countries_objects_array = Country::read_all();
    
    //
    return $countries_objects_array;
}
?>
