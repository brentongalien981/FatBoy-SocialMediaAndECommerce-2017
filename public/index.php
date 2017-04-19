<?php // require_once("../private/includes/initializations.php");   ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");   ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");   ?>
<?php include("_layouts/header.php"); ?>




<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<!--sub-menus nav-->
<!--I'm currently adding this for my store page.-->
<a>sub-menu1</a>
<a>sub-menu2</a>
</nav>






<?php
echo "tae fatboy<br>";
if ($session->is_logged_in()) {
    echo "Mothehfuckeh is logged-in.";
    echo "<pre>";
    print_r($session);
    print_r($_SESSION);
    echo "</pre>";
} else {
    echo "Mothehfuckeh ain't logged-in.";
}
?>





<!--Meat-->
<?php
// TODO: Show timeline notifications.
// TODO: A lot yet to be done. Timeline post form, timeline notification, etc.



if ($session->is_logged_in()) {
//
    echo "<h3>Timeline";
    echo " {$session->currently_viewed_user_name}";
    echo "</h3><br>";


    // This file takes care of the query for getting all the timeline posts.
    require_once("__controller/controller_timeline_posts.php");

    //
    $completely_presented_timeline_notifications_array = get_completely_presented_timeline_notifications_array($session->currently_viewed_user_id);

    // Display the timeline posts of the current user being viewed.
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
<script src="_scripts/index.js"></script>
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<!--Footer-->
<?php // include_layout_template('footer.php');   ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
