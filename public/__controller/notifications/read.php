<?php

if (isset($_GET["get_all_notifications"]) &&
        ($_GET["get_all_notifications"] == "yes")) {
    
    echo json_encode(array("is_result_ok" => false));
}
?>