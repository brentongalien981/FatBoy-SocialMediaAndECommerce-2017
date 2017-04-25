<?php // require_once("../private/includes/initializations.php");    ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");    ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");    ?>
<?php include("_layouts/header.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




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


////
//if (isset($_GET["is_viewing_actual_user_again"])) {
//    $session->reset_currently_viewed_user();
//    
//    redirect_to(LOCAL . "/public/index.php");
//}
?>






<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/header.css';  ?>" rel="stylesheet" type="text/css">-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/index.css';  ?>" rel="stylesheet" type="text/css">-->
<style>
    textarea {
        border-radius: 4px;
    }

    .message_post {
        background-color: rgba(153, 255, 153, 0.1);
        width: 70%;
        padding: 10px;
        border-radius: 7px;
    }

    .message_post h4 {
        margin: 0;
        padding: 0;
        font-weight: 300;        
    }

    .message_post h5 {
        margin: 0;
        padding: 0;
        font-size: 60%;
        font-weight: 100;
        font-style: italic;
    }


    .message_post p {
        font-size: 90%;
        font-weight: 100;    
        margin-top: 20px;
    }

    .link_reply {
        color: blue;
        font-size: 70%;
        font-weight: 100;
    }

    .replyForm {
        /*margin-left: 8%;*/
    }


    .replies {
        background-color: white;
        font-size: 75%;
        margin-left: 8%;
        padding: 7px;
    }
</style>






<!--Scripts-->
<script src="_scripts/index.js"></script>
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<!--Footer-->
<?php // include_layout_template('footer.php');   ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
