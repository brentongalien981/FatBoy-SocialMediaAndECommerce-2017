<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title id="title">&copy; FatBoy</title>


    <!-- Bootstrap -->


    <!--        Font Awesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--    Google Material Icons-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->


    <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/_layouts/header.css"; ?>">


    <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
    </script>

    <?php
    // TODO:SECTION: General js scripts that needs <php> tags.
    ?>
    <script>
        function get_csrf_token() {
            return "<?php echo sessionize_csrf_token(); ?>";
        }

        function get_local_url() {
            return "http://localhost/myPersonalProjects/FatBoy";
        }
    </script>


    <script src="<?php echo LOCAL . "/public/_scripts/general.js"; ?>">
    </script>

    <script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/main_script2.js"; ?>"></script>

    <script src="<?php echo LOCAL . "/public/_scripts/main_script_part2.js"; ?>"></script>
</head>
<body id="the_body">
<?php // TODO:REMINDER: Display this later. ?>
<!--<div id="the_spinner_div">-->
<!--<img id="the_spinner_mg" src="<?php // echo LOCAL . "/public/_photos/loading1.gif";     ?>">-->
<!--</div>-->


<!-- TODO:REMINDER: Put this chunk in a separate file. -->
<input id="input_currently_viewed_user_id" type="hidden"
<?php
global $session;
echo " value='";

if (isset($session->currently_viewed_user_id)) {
    echo $session->currently_viewed_user_id;
}

echo "'>";
?>


<input id="input_currently_viewed_user_name" type="hidden"
<?php
// This input is used to control the currently_viewed_user_id
// on multiple tabs.
echo " value='";

if (isset($session->currently_viewed_user_name)) {
    echo $session->currently_viewed_user_name;
}

echo "'>";
?>




<?php require_once(PUBLIC_PATH . "/_layouts/banner.php"); ?>


<div id="main">
    <table id="the_table">
        <tr>
            <td id="left" class="main">
                <div id="container_for_nav_side">
                    <?php require_once(PUBLIC_PATH . "/_layouts/`.php"); ?>
                </div>
            </td>

            <td id="middle" class="main">
            </td>

            <td id="right" class="main">
                <div id="ad_container">
                    <iframe id="the_ad" class="ad" frameborder="0" allowfullscreen="false" mozallowfullscreen="false"
                            scrolling="no" seamless=""></iframe>
                </div>

                <?php include(PUBLIC_PATH . "/__view/chat/index.php"); ?>
            </td>
        </tr>
    </table>
</div>


<!--<main id="main">-->

<!--Sub-menus-->
<!--<nav id="sub_menus_nav">-->


<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/_layouts/header2.css"; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/animate.css"; ?>">


<?php
// TODO: SECTION: Script for popping-in and
// popping out of the sign-in, sign-up links.
?>


<script>

    window.onfocus = function () {
        //                window.alert("main content loaded");
        console.log("this tab is now focused and active: " + document.getElementById("title").innerHTML);
        set_session_currently_viewed_user_id();

    };

    function set_session_currently_viewed_user_id() {
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . "/public/__controller/controller_session.php"; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    console.log("SUCCESS AJAX for method: set_session_currently_viewed_user_id().");
                }

            }


        }

        //uki
        var post_key_value_pairs = "input_currently_viewed_user_id=" + document.getElementById("input_currently_viewed_user_id").value;
        post_key_value_pairs += "&input_currently_viewed_user_name=" + document.getElementById("input_currently_viewed_user_name").value;
        xhr.send(post_key_value_pairs);
    }
</script>

<script src="<?php echo LOCAL . "/public/_scripts/user_home_menus_displayer.js"; ?>"></script>


<?php // TODO:SECTION: AJAX script for search. ?>
<?php require_once(PUBLIC_PATH . "/_scripts/search/ajax_create.php"); ?>
<?php require_once(PUBLIC_PATH . "/_scripts/notifications/count_displayer.php"); ?>



<!--mcn-loader-el-->
<?php require_once(PUBLIC_PATH . "/general_loader_el.php"); ?>


<!--Widgets-->
<?php require_once(PUBLIC_PATH . "/__view/widgets/index.php"); ?>


<!--App Settings-->
<?php require_once(PUBLIC_PATH . "/__view/app_settings/index.php"); ?>
