<!--This page is for viewing my store.-->



<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<!--Meat-->
<?php
//
require_once(PUBLIC_PATH . "/__controller/controller_my_store.php");

//
show_user_store_items();


?>