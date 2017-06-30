<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>
<?php
if ($session->is_logged_in() && $session->is_viewing_own_account()) {
    // Start the notification notifier fetcher...
    require_once(PUBLIC_PATH . "/__controller/controller_notifications_notifier.php");
}
?>

<!doctype>
<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <!--<link href="<?php // echo LOCAL . '/public/_styles/header.css'                                                           ?>" rel="stylesheet" type="text/css" />-->
        <style>
            * {
                margin: 0;
                padding: 0;
                border: 0;
            }

            body {
                margin: 0;
                padding: 0;
                /*width: 1350px;*/
                /*                min-width: 1350px;*/
                /*background-color: rgb(150, 150, 150);*/
                /*width: 100%;*/
                /*min-width: 960px;*/

                font-family: sans-serif;
                font-size: 100%;
                color: rgb(255, 255, 255);
                /*background-color: white;*/
                background-image: url("<?php echo LOCAL . "/public/_photos/background5.jpg"; ?>");
                /*background-repeat:*/
            }

            div#wrapper {
                /*                width: 1350px;
                                min-width: 1350px;
                                margin: 0;
                                padding: 0;
                                margin-left: auto;
                                margin-right: auto;*/
            }





            a {
                text-decoration: none;

            }





            a:visited {
                color: cornflowerblue;
            }


            table a {
                color: orange;
            }

            table {
                margin-top: -15px;
                /*font-size: 80%;*/
                font-weight: 100;
            }

            #formProfile {
                width: 50%;
            }


            /*#formAdminCreation h4 {
                display: inline;
            }*/

            form h4 {
                display: inline;
            }

            #divBanner,
            footer {
                /*                width: 100%;*/
                width: 100%;
                min-width: 1390px;
                height: 60px;
                margin: 0;
                padding: 0;
                /*background-color: #AFEEEE;*/
                background-color: rgb(80, 80, 80);
            }

            table#header {
                width: 100%;
                min-width: 1390px;
            }

            #divStatus {
                /*width: 40%;*/
                /*background-color: pink;*/
                /*float: left;*/
                /*display: inline;*/
                /*font-size: 70%;*/
                /*font-weight: 100;*/
                /*color: white;*/
            }





            #divWebsite {
                /*width: 30%;*/
                /*background-color: yellow;*/
                /*float: right;*/
                /*margin-top: -25px;*/
                /*color: white;*/
                /*clear: none;*/
                /*display: inline;*/
            }



            #divBanner h4 {
                /*width: 40%;*/
                /*text-align: right;*/
                /*margin: 0;*/
                /*padding: 0;*/
                /*padding-top: 15px;*/
                /*padding-right: 20px;*/
                /*font-size: 110%;*/
                /*font-weight: 200;*/
                /*background-color: yellowgreen;*/
                /*float: right;*/
            }

            #divStatus h4 {
                /*                padding-top: 13px;
                                padding-left: 35px;
                                font-size: 90%;
                                background-color: red;*/
            }



            #divStatus a {
                /*display: block;*/
                /*padding-top: 5px;*/
                /*padding-left: 35px;*/

                /*width: fit-content;*/
                /*width: 7%;*/
                /*padding-left: 0;*/
                /*margin-left: 40px;*/
                /*margin-left: 3%;*/
                /*background-color: greenyellow;*/

                /*font-weight: 100;*/
                /*color: white;*/
            }



            .user_name {
                padding-top: 10px;
                font-size: 130%;
                /*                width: fit-content;*/
                /*width: 50%;*/
                /*background-color: #D4E6F4;*/
                /*background-color: red;*/
                color: white;
            }

            #link_actual_user_name {
                /*font-size: 110%;*/
                padding-top: 15px;
                color: black;
                font-weight: 300;
                font-size: 130%;
                color: black;
            }



            #divWebsite h4 {
                /*text-align: right;*/
                /*float: right;*/
                /*background-color: orange;*/
            }

            h2, h3, h4, h5, h6 {
                font-weight: 200;
            }

            h3 {
                font-weight: 500;
            }

            h4 {
                font-weight: 400;
            }


            footer {
                /*    float: left;*/
                clear: left;
                padding-top: 30px;
                /*background-color: bisque;*/
                text-align: center;
                font-size: 80%;
                font-weight: 100;
            }

            footer h6 {
                font-size: 90%;
            }

            footer a {
                text-decoration: none;
                margin: 10px;
            }

            main {
                /*                width: 47%;
                                margin-top: 0;
                                margin-left: 1%;
                                padding: 1%;
                                padding-top: 0;
                                padding-left: 35px;
                                background-color: #ffffe6;
                                float: left;*/
                margin-left: auto;
                margin-right: auto;
                min-width: 720px;
                /*background-color: yellow;*/
                width: 100%;

            }

            #container_for_nav_side {
                margin-left: 10px;
                background-color: white;
                border-radius: 5px;
            }

            #navSide {
                /*                width: 12%;
                                height: 250px;
                                padding: 1%;
                                padding-left: 35px;
                                font-size: 90%;
                                font-weight: 200;
                                background-color: #e6eeff;
                                float: left;*/
                margin: 0;
                padding: 0;
                width: 100%;
                /*height: 350px;*/
                /*background-color: rgb(244, 244, 244);*/
                background-color: rgba(221, 244, 159, 0.80);
                /*background-color: rgba(211, 242, 9, 0.7);*/
                /*                margin-left: 3%;*/
                margin-top: 0;
                /*padding-top: 15px;*/
                padding-bottom: 25px;
                border-radius: 5px;


            }

            .form_button {
                margin-bottom: 30px;
                margin-top: 20px;
                color: black;
                /*        background-color: rgb(200, 200, 200);*/
                /*background-color: rgba(255, 157, 45, 0.20);*/
                background-color: rgb(224, 255, 193);
                box-shadow: 3px 3px 3px rgb(130, 130, 130);
                /*border: 1px solid;*/
                font-size: 10px;
                font-weight: 100;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 5px;
                padding-bottom: 5px;
                border-radius: 3px;
                margin-right: 10px;
            }

            .form_button:hover {
                background-color: rgba(255, 157, 45, 0.50);
                cursor: pointer; cursor: hand;
            }

            .ad {
                margin: 0;
                padding: 0;
                /*width: 97%;*/
                width: 350px;
                height: 215px;
                /*background-color: rgba(178, 215, 247, 0.80);*/
                background-color: rgba(50, 50, 50, 0.0);
                /*margin-top: 20px;*/
                /*margin-bottom: 20px;*/
                /*margin-right: 3%;*/
                padding-top: 0;
                margin-left: auto;
                margin-right: auto;
            }

            .post {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 500px;
                background-color: yellowgreen;
                margin-top: 0;
                margin-bottom: 20px;
                padding-top: 0;
            }

            #navSide a {
                /*width: fit-content;*/
                text-decoration: none;
                margin-bottom: 5px;
                display: block;
                color: black;
                margin-left: 20px;
                margin-right: 40px;
                font-size: 90%;
                /*background-color: red;*/
                padding: 7px;
                padding-left: 10px;
                border-radius: 5px;
                /*padding-top: 5px;*/
                /*padding-bottom: 5px;*/
            }

            footer a, footer h6 {
                color: white;
            }

            #the_table {
                /*width: 100%;*/
                width: 1350px;
                min-width: 1350px;
                /*height: 1080px;*/
                min-height: 900px;
                /*background-color: pink;*/
                border-collapse: collapse;
                border-spacing: 0;
                /*margin-top: 20px;*/
            }

            td.main {
                vertical-align: top;
            }

            #left {
                /*background-color: red;*/
                width: 250px;
                min-width: 250px;
                padding-right: 20px;
            }

            #middle {
                /*background-color: greenyellow;*/
                /*width: 60%;*/
                width: 600px;
                min-width: 600px;
            }

            #right {
                /*background-color: darkgoldenrod;*/
                /*width: 20%;*/
                width: 380px;
                min-width: 380px;
                padding-left: 20px;
                border-radius: 5px;
            }

            #middle_content {
                /*height: 900px;*/

            }





            .div_error {
                color: red;
                font-size: 80%;
            }

            .debugMessage {
                color: red;
                font-size: 80%;
            }

            span {
                /*margin-left: 10px;*/
                padding: 1px;
                padding-left: 5px;
                padding-right: 5px;
                margin-left: 3px;
                margin-top: -5px;
                background-color: #ff471a;
                border-radius: 5px;
                color: white;
                font-size: 75%;
            }

            #sub_menus_nav {
                /*margin: 0;*/
                /*background-color: #EEE4B9;*/
                /*background-color: blue;*/
                color: black;
                width: 100%;
                height: 30px;
                /*margin-left: -35px;*/
                /*padding: 0;*/
                padding-top: 10px;

                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                /*background-color: rgba(252, 224, 121, 0.50);*/
                background-color: #EEE4B9;
                color: black;
            }

            #context_sensitive_nav {
                /*                margin: 0;
                                padding: 0;*/
                width: 100%;
                background-color: rgba(60, 60, 60, 1.0);
                height: 20px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                color: rgba(200, 200, 200, 1.0);
                font-size: 11px;
                font-weight: 100;
                padding-top: 8px;
                margin-bottom: 10px;
            }



            #context_sensitive_nav a.guide_nav {
                margin: 0;
                padding: 0;
                display: inline;
                /*background-color: gray;*/
                margin-left: 30px;
                /*        padding-top: 3px;
                        padding-bottom: 3px;*/
                color: rgba(200, 200, 200, 1.0);
            }

            #first_context_sensitive_a {
                /*margin-left: 50px;*/
            }


            #context_sensitive_nav a.guide_nav:hover {
                color: orange;
                background-color: rgba(60, 60, 60, 1.0);
                cursor: pointer; cursor: hand;

            }

            #sub_menus_nav a {
                font-size: 13px;
                font-weight: 100;
                /*padding-left: 35px;*/
                margin-left: 20px;
                margin-right: 20px;
                /*background-color: pink;*/
                padding: 10px;
                padding-top: 5px;
                padding-bottom: 5px;
                border-radius: 3px;
                color: black;
            }

            #sub_menus_nav a:hover {
                background-color: rgb(100, 100, 100);
                color: rgba(252, 224, 121, 0.80);
            }

            #span_num_of_notifications {
                /*margin-left: 10px;*/
                padding: 1px;
                padding-left: 5px;
                padding-right: 5px;
                margin-left: 3px;
                margin-top: -5px;
                background-color: #ff471a;
                border-radius: 5px;
                color: white;
                font-size: 75%;
            }

            #main {
                margin-top: 25px;
                width: 1390px;
                min-width: 1390px;
                margin-left: auto;
                margin-right: auto;
                /*padding-top: 10px;*/
            }

            #navSide a:hover {
                background-color: rgb(255, 235, 160);
                cursor: pointer; cursor: hand;
            }

            #pop_up_for_link_home {
                margin: 0;
                padding: 0;
                width: 100px;
                height: 70px;
                background-color: rgba(240, 252, 255, 0.70);
                /*background-color: pink;*/
                position: absolute;
                left: 55px;
                top: 7px;
                border-radius: 3px;
                display: none;
            }

            #pop_up_for_link_home a {
                width: 50px;
                margin-left: 20px;
                margin-top: 10px;
                color: black;

                /*background-color: pink;*/
                border-radius: 3px;
                font-size: 12px;
                font-weight: 100;
                padding: 3px;
                display: block;
            }

            #first_pop_up_link {
                margin-bottom: -25px;
            }

            #pop_up_for_link_home a:hover {
                background-color: white;
            }



        </style>
    </head>
    <body>
        <?php // TODO:REMINDER: Display this later. ?>
        <!--<div id="the_spinner_div">-->
            <!--<img id="the_spinner_mg" src="<?php // echo LOCAL . "/public/_photos/loading1.gif";  ?>">-->
        <!--</div>-->



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



               <div id="divBanner">


            <table id="header">
                <tr>
                    <td class="header" id="status">
                        <div id="divStatus">
                            <?php
                            $profile_pic_url = "/public/_photos/icon_home.png";

                            if ($session->is_logged_in()) {
//                                echo "<a class='user_name' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>Hello {$session->actual_user_name}!</a>";
//                                echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                                echo "<a id='link_home' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>";

                                //
                                global $session;
                                $query = "SELECT * FROM Profile ";
                                $query .= "WHERE user_id = {$session->actual_user_id}";

                                $record_result = Profile::read_by_query($query);


                                global $database;
                                while ($row = $database->fetch_array($record_result)) {
                                    $profile_pic_url = $row["pic_url"];

                                    if ($profile_pic_url == null || $profile_pic_url == "") {
                                        $profile_pic_url = "/public/_photos/icon_home.png";
                                    }

                                    break;
                                }

//                                echo "<img src='" . LOCAL . "/public/_photos/icon_home.png' class='header_icon'>";
                                echo "<img src='" . LOCAL . "{$profile_pic_url}' class='header_icon'>";
//                                echo "Hello {$session->actual_user_name}!";
                                echo "</a>";
                            } else {
                                $profile_pic_url = "/public/_photos/icon_home.png";

//                                echo "<a class='user_name'>zZzzZz</a>";
//                                echo "<a href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a>";
                                echo "<a id='link_home' href='#'>";
                                echo "<img src='" . LOCAL . "{$profile_pic_url}' class='header_icon'>";
                                echo "</a>";
                            }
                            ?>
                        </div>
                    </td>


                    <?php
// Pop-up when home icon is hovered.
                    if ($session->is_logged_in()) {
                        echo "<div id='pop_up_for_link_home'>";
//                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__view/view_log_in.php>Log-in</a><br>";
//                        echo "<a href='' class='pop_up_links'>Sign-up</a><br>";

                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                        echo "</div>";
                    } else {
                        echo "<div id='pop_up_for_link_home'>";
                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a><br>";
                        echo "<a href='" . LOCAL . "/public/__view/view_signup.php' class='pop_up_links'>Sign-up</a><br>";
                        echo "</div>";
                    }
                    ?>






                    <td class="header" id="search">
                        <?php require_once(PUBLIC_PATH . "/__view/search/create.php");?>
                    </td>

                    <td class="header" id="site_logo">
                        <h4 id="logo_fatboy">FatBoy &reg;</h4>
                        <!--                        <div id="divWebsite">
                                                    <h4 id="h4Website">FatBoy &reg;</h4>
                                                </div>-->
                    </td>
                </tr>
            </table>

        </div>



















               <!--uki-->
        <div id="main">
            <table id="the_table">
                <tr>
                    <td id="left" class="main">
                        <div id="container_for_nav_side">

                            <nav id="navSide">


                                <!--Context-sensitive navigation-->
                                <div id="context_sensitive_nav">
                                    <a id="first_context_sensitive_a" class="guide_nav" href="#">MyVideos</a>
                                    <a class="guide_nav">&gt;</a>
                                    <a class="guide_nav" href="#">Edit Videos</a>
                                </div>




                                <?php
// For the timeline icon.
//
                                if ($session->is_logged_in()) {
                                    global $session;
                                    $query = "SELECT * FROM Profile ";
//                                $query .= "WHERE user_id = {$session->currently_viewed_user_id}";
                                    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";

                                    $record_result = Profile::read_by_query($query);

                                    $timeline_pic_url = "/public/_photos/icon_wall_pin.png";

                                    global $database;
                                    while ($row = $database->fetch_array($record_result)) {
                                        $timeline_pic_url = $row["pic_url"];

                                        // If there's no valid image.
                                        if ($timeline_pic_url == null || $timeline_pic_url == "") {
                                            $timeline_pic_url = "/public/_photos/icon_wall_pin.png";
                                        }
                                        break;
                                    }

                                    echo "<a id='menu_wall' href='";
                                    if ($session->is_logged_in()) {
                                        echo LOCAL . "/public/index.php' class=''>";
                                    } else {
                                        echo "#' class=''>";
                                    }
                                    echo "<img src='" . LOCAL . "{$timeline_pic_url}' class='icon'>";


                                    echo "{$session->currently_viewed_user_name}";


                                    echo "</a>";
                                }
                                ?>



                                <!--<a href="<?php // echo LOCAL . '/public/index.php';                            ?>" class="">-->
                                    <!--<img src="<?php // echo LOCAL . '{$timeline_pic_url}';                            ?>" class="icon">Timeline-->
                                <?php
//                                    if ($session->is_logged_in()) {
//                                        echo " of {$session->currently_viewed_user_name}";
//                                    }
                                ?>
                                <!--</a>-->


                                <?php
// Notifications.
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_notifications' href='" . LOCAL . "/public/__view/view_notifications.php'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_notification_bell.png' class='icon'>";
                                    echo "Notifications";

                                    if ($session->num_of_notifications > 0) {
                                        echo "<span id='span_num_of_notifications' style='display: inline;'>{$session->num_of_notifications}</span>";
//                    echo "<span id='span_num_of_notifications'>5</span>";
                                    } else {
                                        echo "<span id='span_num_of_notifications' style='display: none;'></span>";
                                    }

                                    echo "</a>";
                                }
                                ?>

                                <a id="menu_profile" href="
                                <?php
                                if ($session->is_logged_in()) {
//                                    echo LOCAL . '/public/__view/view_profile.php';
                                    echo LOCAL . '/public/__view/profile';
                                } else {
                                    echo "#";
                                }
                                ?>" class="">
                                    <img src="<?php echo LOCAL . '/public/_photos/icon_profile.png'; ?>" class="icon">Profile
                                </a>



                                <a id="menu_friends" href="
                                <?php
                                if ($session->is_logged_in()) {
                                    echo LOCAL . '/public/__view/view_friends.php';
                                } else {
                                    echo "#";
                                }
                                ?>" class="">
                                    <img src="<?php echo LOCAL . '/public/_photos/icon_friends.png'; ?>" class="icon">Friends
                                </a>



                                <a id="menu_my_videos" href="
                                <?php
                                if ($session->is_logged_in()) {
                                    echo LOCAL . '/public/__view/my_videos';
                                } else {
                                    echo "#";
                                }
                                ?>" class="">
                                    <img src="<?php echo LOCAL . '/public/_photos/icon_video.png'; ?>" class="icon">MyVideos</a>


                                <?php
// Chat
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_chat' href='" . LOCAL . "/public/__view/view_chat'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_chat.png' class='icon'>";
                                    echo "Chat</a>";
                                }
                                ?>





                                <?php
// MyAds.
// TODO: REMINDER: Remove this once you publish it.
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_my_ads' href='" . LOCAL . "/public/__view/view_my_ads'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_ad.png' class='icon'>";
                                    echo "MyAds</a>";
                                }
                                ?>





                                <a id="menu_my_store" href="
                                <?php
                                if ($session->is_logged_in()) {
                                    echo LOCAL . '/public/__view/view_my_store';
                                } else {
                                    echo "#";
                                }
                                ?>">
                                    <img src="<?php echo LOCAL . '/public/_photos/icon_store.png'; ?>" class="icon">MyStore</a>

                                <?php
// MyCart
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_my_cart' href='" . LOCAL . "/public/__view/view_store_cart'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_cart.png' class='icon'>";
                                    echo "MyCart</a>";
                                }
                                ?>



                                <?php
// MySales
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_my_sales' href='" . LOCAL . "/public/__view/view_my_sales'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_sales.png' class='icon'>";
                                    echo "MySales</a>";
                                }
                                ?>


                                <?php
// MyRefund
                                if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                    echo "<a id='menu_my_refund' href='" . LOCAL . "/public/__view/view_refund'>";
                                    echo "<img src='" . LOCAL . "/public/_photos/icon_refund.png' class='icon'>";
                                    echo "MyRefund</a>";
                                }
                                ?>




                            </nav>
                        </div>
                    </td>

                    <td id="middle" class="main">
                    </td>

                    <td id="right" class="main">
                        <div id="ad_container">
                            <iframe id="the_ad" class="ad" frameborder="0" allowfullscreen="false" mozallowfullscreen="false" scrolling="no" seamless=""></iframe>
                        </div>
                    </td>
                </tr>
            </table>
        </div>









        <!--<main id="main">-->

        <!--Sub-menus-->
        <!--<nav id="sub_menus_nav">-->



        <style>
            td.main {
                /*background-color: white;*/
            }

            .icon {
                width: 22px;
                height: 22px;
                /*padding-top: 20px;*/
                margin-right: 10px;
                /*background-color: yellow;*/
                margin-bottom: -5px;
                border-radius: 3px;
            }

            #divStatus a {
                /*background-color: red;*/
                margin-left: 20px;

                /*padding: 5px;*/
            }

            img.header_icon {
                width: 30px;
                height: 30px;
                background-color: rgb(90, 90, 90);
                margin-top: 17px;
                padding: 2px;
                padding-top: 1px;
                border-radius: 5px;

                /*padding-top: 20px;*/
                /*margin-right: 10px;*/
                /*background-color: yellow;*/
                /*margin-bottom: -5px;*/
            }

            img.header_icon:hover {
                background-color: rgb(200, 200, 200);
            }





            #divBanner table {
                border-collapse: collapse;
                /*width: 100%;*/
                min-width: 1390px;
                height: 100%;
            }

            td.header {
                /*            width: 200px;*/
                /*height: 50px;*/
                /*background-color: red;*/
            }

            #status {
                /*background-color: blue;*/
                width: 20%;
            }

            #search {
                /*background-color: yellow;*/
                width: 60%;
            }

            #search div {
                width: 500px;
                height: 100%;
                /*background-color: pink;*/
                margin: 0;
                padding: 0;
                margin-left: auto;
                margin-right: auto;
                /*vertical-align: middle;*/
            }

            #search_input {
                font-size: 10px;
                font-weight: 100;
                margin: 0;
                padding: 0;
                margin-top: 18px;
                width: 430px;
                height: 36px;
                /*background-color: gray;*/
                vertical-align: top;
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
                padding-left: 10px;
                margin-right: -5px;
            }

            #search_a {
                /*background-color: green;*/
                margin-bottom: 0;
                padding-bottom: 0;

            }

            #search_img {
                /*uki*/
                /*background-color: orange;*/
                background-color: rgb(150, 150, 150);
                border-top-left-radius: 0px;
                border-bottom-left-radius: 0px;
                margin-left: 0;
                margin-top: 18px;
                height: 30px;
                padding: 3px;
                /*padding-top: 1px;*/
            }

            #search_img:hover {
                background-color: rgb(200, 200, 200);
            }



            #site_logo {
                /*background-color: green;*/
                width: 20%;
                color: white;
                /*                padding-left: 2%;*/
            }

            #site_logo h4 {
                margin-top: 10px;
                text-align: right;
                /*background-color: pink;*/
                /*margin-left: 30px;*/
                margin-right: 20px;
                /*color: red;*/
                font-size: 14px;
                font-weight: 100;
                color: rgb(240, 240, 240);
            }





            main {
                border-radius: 5px;
                /*background-color: rgb(220, 220, 220);*/
                color: black;
            }

            /*            #sub_menus_nav {
                            border-radius: 5px;
                            background-color: rgba(252, 224, 121, 0.80);
                            color: black;
                        }

                        #sub_menus_nav a {
                            color: black;
                        }
            */

            #ad_container {
                background-color: rgba(50, 50, 50, 0.6);
                width: 370px;
                border-radius: 5px;
                margin-right: 10px;
                /*padding-top: 10px;*/
                /*padding-bottom: 10px;*/
                /*height: 250px;*/
                visibility: visible;
            }

            footer nav a {
                color: rgb(240, 240, 240);
            }

            footer nav a:visited {
                color: rgb(240, 240, 240);
            }

            footer h6 {
                color: rgb(240, 240, 240);
                /*color: red;*/
            }

            div#the_spinner_div {
                width: 100%;
                height: 150%;
                margin: 0;
                padding: 0;
                background-color: rgb(26, 26, 26);
                position: absolute;
                left: 0px;
                top: 0px;
            }

            #the_spinner_mg {
                display: block;
                width: 200px;
                height: 150px;
                background-color: rgb(26, 26, 26);
                margin-left: auto;
                margin-right: auto;
                padding-top: 200px;;
            }            

            label.error_msg {
                font-size: 12px;
                font-weight: 100;
                color: red;
            }       
            
            div#main_content {
                margin: 0;
                padding: 0;
                min-height: 50px;
                max-height: 900px;
                overflow-y: auto;
                /*background-color: pink;*/
            }
        </style>










        <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
        </script>        

        <?php
// TODO:SECTION: General js scripts that needs <php> tags.
        ?>
        <script>
            function get_csrf_token() {
                return "<?php echo sessionize_csrf_token(); ?>";
            }
        </script>


        <script src="<?php echo LOCAL . "/public/_scripts/general.js"; ?>">
        </script>        

        <?php
// TODO: SECTION: Script for popping-in and
// popping out of the sign-in, sign-up links.
        ?>

        <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
        </script>

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

        <script>
            // Vars.
            var timeout_handler;
            //            clearTimeout(myVar);


            function close_pop_up_in_sec() {
                document.getElementById("pop_up_for_link_home").style.display = "none";
                //                window.alert("onmouseout");
            }

            document.getElementById("link_home").onmouseover = function () {
                //                window.alert("howver");
                clearTimeout(timeout_handler);
                document.getElementById("pop_up_for_link_home").style.display = "block";

            };

            document.getElementById("link_home").onmouseout = function () {
                timeout_handler = setTimeout(close_pop_up_in_sec, 500);

            };

            document.getElementById("pop_up_for_link_home").onmouseover = function () {
                //                window.alert("howver");
                clearTimeout(timeout_handler);
                document.getElementById("pop_up_for_link_home").style.display = "block";

            };


            document.getElementById("pop_up_for_link_home").onmouseout = function () {
                //                window.alert("howver");
                //                document.getElementById("pop_up_for_link_home").style.display = "block";
                timeout_handler = setTimeout(close_pop_up_in_sec, 500);


            };

            for (var i = 0; i < 2; i++) {
                if (document.getElementsByClassName("pop_up_links")[i] != null) {
                    document.getElementsByClassName("pop_up_links")[i].onmouseover = function () {
                        clearTimeout(timeout_handler);
                        document.getElementById("pop_up_for_link_home").style.display = "block";
                    };

                }


            }



            document.getElementById("pop_up_for_link_home").onmouseover = function () {
                //                window.alert("howver");
                clearTimeout(timeout_handler);
                document.getElementById("pop_up_for_link_home").style.display = "block";
                //                this.style.display = "block";
            };
        </script>
        
        
        <?php // TODO:SECTION: AJAX script for search. ?>
        <?php require_once(PUBLIC_PATH . "/_scripts/search/ajax_create.php"); ?>











