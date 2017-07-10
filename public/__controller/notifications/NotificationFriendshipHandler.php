<?php
namespace App\Publico\Controller\Notifications;

require_once("NotificationFriendshipController.php");
require_once("NotificationFetcher.php");

use App\Publico\Controller\Notifications\NotificationFriendshipController;
use App\Publico\Controller\Notifications\NotificationFetcher;
?>





<?php
// AJAX Handler.
if (isset($_GET['read']) && $_GET['read'] == "yes") {
    // Instance
    $notification_friendship = new NotificationFriendshipController();


    // Validate
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);
    $notification_friendship->validator->set_request_type("get");
    $notification_friendship->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $notification_friendship->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $notification_friendship->validator->validate();
    $json_errors_array = $notification_friendship->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
        $section = $_GET['section'];
        $json_errors_array['notifications'] = $notification_friendship->read($section);
    }


    //
    echo json_encode($json_errors_array);
}


if (isset($_GET["get_all_notifications_count"]) &&
    ($_GET["get_all_notifications_count"] == "yes")) {

    //
    require_once(PUBLIC_PATH . "/__model/NotificationMyShopping.php");
    require_once(PUBLIC_PATH . "/__model/NotificationFriendship.php");

    $notification_count = NotificationFetcher::get_all_notification_count();

    echo json_encode(array("is_result_ok" => true, "notification_count" => $notification_count));

}
?>