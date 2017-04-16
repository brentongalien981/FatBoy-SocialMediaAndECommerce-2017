<?php // require_once("../private/includes/initializations.php");  ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");  ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");  ?>
<?php include("_layouts/header.php"); ?>




<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php
echo "tae fatboy<br>";
if ($session->is_logged_in()) {
    echo "Mothehfuckeh is logged-in.";
} else {
    echo "Mothehfuckeh ain't logged-in.";
}
?>






<?php
// Main Content.
if ($session->is_logged_in()) {
    // This file takes care of the query for getting all the timeline posts.
    require_once("__controller/controller_timeline_posts.php");

    //
    $completely_presented_timeline_notifications_array = get_completely_presented_timeline_notifications_array($session->actual_user_id);

    //
    foreach ($completely_presented_timeline_notifications_array as $post) {
        echo $post;
    }
    

    // TODO: DEBUG
    MyDebugMessenger::add_debug_message("So far so good.");
}
?>






<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="_styles/header.css" rel="stylesheet" type="text/css" />
<link href="_styles/index.css" rel="stylesheet" type="text/css">





<!--Scripts-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<!--Footer-->
<?php // include_layout_template('footer.php');  ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
