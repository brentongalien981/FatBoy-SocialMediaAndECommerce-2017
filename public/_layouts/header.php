<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php
if ($session->is_logged_in() && $session->is_viewing_own_account()) {
    require_once(PUBLIC_PATH . "/__controller/controller_notifications_notifier.php");
}
?>



<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<!doctype>
<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <!--<link href="<?php // echo LOCAL . '/public/_styles/header.css'                    ?>" rel="stylesheet" type="text/css" />-->
        <style>
            * {
                margin: 0;
                padding: 0;
                border: 0;
            }

            body {
                margin: 0;
                padding: 0;
                /*background-color: rgb(150, 150, 150);*/
                width: 100%;
                font-family: sans-serif;
                font-size: 100%;
                color: gray;
                background-image: url("_photos/background5.jpg");
                /*background-repeat:*/
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

            #divBanner, footer {
                width: 100%;
                height: 60px;
                margin: 0;
                padding: 0;
                /*                background-color: #AFEEEE;*/
                background-color: rgb(80, 80, 80);
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
                width: 97%;
                /*height: 350px;*/
                /*background-color: rgb(244, 244, 244);*/
                background-color: rgba(221, 244, 159, 0.80);
                margin-left: 3%;
                margin-top: 0;
                padding-top: 15px;
                padding-bottom: 25px;
                border-radius: 5px;


            }

            .ad {
                <?php
                // TODO: REMINDER: Make the display: none here.
                ?>
                /*                width: 350px;
                                height: 220px;
                                margin: 0;
                                padding: 0;
                                background-color: yellowgreen;
                                float: right;
                                display: none;*/
                margin: 0;
                padding: 0;
                width: 97%;
                height: 250px;
                background-color: rgba(178, 215, 247, 0.80);
                margin-top: 0;
                margin-right: 3%;
                padding-top: 0;
                border-radius: 5px;



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
                width: 100%;
                /*height: 1080px;*/
                min-height: 720px;
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
                width: 20%;
                padding-right: 20px;
            }

            #middle {
                /*background-color: greenyellow;*/
                width: 60%;
            }

            #right {
                /*background-color: darkgoldenrod;*/
                width: 20%;
                padding-left: 20px;
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
                background-color: #EEE4B9;
                color: red;
                width: 100%;
                height: 30px;
                /*margin-left: -35px;*/
                padding: 0;
                padding-top: 10px;
            }

            #sub_menus_nav a {
                font-size: 85%;
                font-weight: 100;
                padding-left: 35px;
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
                margin-top: 35px;
                /*padding-top: 10px;*/
            }

            #navSide a:hover {
                background-color: white;
            }

        </style>
    </head>
    <body>
        <div id="divBanner">




            <table>
                <tr>
                    <td class="header" id="status">
                        <div id="divStatus">
                            <?php
                            if ($session->is_logged_in()) {
//                                echo "<a class='user_name' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>Hello {$session->actual_user_name}!</a>";
//                                echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                                echo "<a href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>";
                                echo "<img src='" . LOCAL . "/public/_photos/icon_home.png' class='header_icon'>";
//                                echo "Hello {$session->actual_user_name}!";
                                echo "</a>";
                            } else {
//                                echo "<a class='user_name'>zZzzZz</a>";
//                                echo "<a href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a>";
                            }
                            ?>
                        </div>
                    </td>

                    <td class="header" id="search">
                        <div>
                            <input id="search_input" placeholder="Search...">
                            <a id="search_a" href="">
                                <img id="search_img" src="<?php echo LOCAL . '/public/_photos/icon_search.png'; ?>" class="header_icon">
                            </a>
                        </div>
                    </td>

                    <td class="header" id="site_logo">
                        <h4 id="">FatBoy &reg;</h4>
                        <!--                        <div id="divWebsite">
                                                    <h4 id="h4Website">FatBoy &reg;</h4>
                                                </div>-->
                    </td>
                </tr>
            </table>

        </div>








<!--        <iframe id="the_ad" class="ad" frameborder="0" allowfullscreen="false" mozallowfullscreen="false" scrolling="no" seamless="">
            ad
        </iframe>-->











        <div id="main">
            <table id="the_table">
                <tr>
                    <td id="left" class="main">
                        <nav id="navSide">
                            <a href="<?php echo LOCAL . '/public/index.php'; ?>" class="">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_wall_pin.png'; ?>" class="icon">Timeline
                                <?php
                                if ($session->is_logged_in()) {
                                    echo " of {$session->currently_viewed_user_name}";
                                }
                                ?>
                            </a>


                            <?php
                            // Notifications.
                            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                echo "<a href='" . LOCAL . "/public/__view/view_notifications.php'>";
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

                            <a href="<?php echo LOCAL . '/public/__view/view_profile.php'; ?>" class="">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_profile.png'; ?>" class="icon">Profile
                            </a>

                            <a href="<?php echo LOCAL . '/public/__view/view_friends.php'; ?>" class="">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_friends.png'; ?>" class="icon">Friends
                            </a>

                            <a href="<?php echo LOCAL . '/public/__view/view_my_videos'; ?>" class="">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_video.png'; ?>" class="icon">MyVideos</a>


                            <a href="<?php echo LOCAL . '/public/__view/view_my_ads'; ?>">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_ad.png'; ?>" class="icon">MyAds</a>


                            <a href="<?php echo LOCAL . '/public/__view/view_my_store'; ?>">
                                <img src="<?php echo LOCAL . '/public/_photos/icon_store.png'; ?>" class="icon">MyStore</a>

                            <?php
                            // MyCart
                            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                echo "<a href='" . LOCAL . "/public/__view/view_store_cart'>";
                                echo "<img src='" . LOCAL . "/public/_photos/icon_cart.png' class='icon'>";
                                echo "MyCart</a>";
                            }
                            ?>



                            <?php
                            // MySales
                            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                echo "<a href='" . LOCAL . "/public/__view/view_my_sales'>";
                                echo "<img src='" . LOCAL . "/public/_photos/icon_sales.png' class='icon'>";
                                echo "MySales</a>";
                            }
                            ?>


                            <?php
                            // MyRefund
                            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                                echo "<a href='" . LOCAL . "/public/__view/view_refund'>";
                                echo "<img src='" . LOCAL . "/public/_photos/icon_refund.png' class='icon'>";
                                echo "MyRefund</a>";
                            }
                            ?>



                            <?php
                            // Sign-up
                            if (!$session->is_logged_in()) {
                                echo "<a href='" . LOCAL . "/public/__view/view_signup.php'>Sign-up</a>";
                            }
                            ?>
                        </nav>
                    </td>

                    <td id="middle" class="main">
                    </td>

                    <td id="right" class="main">
                        <iframe id="the_ad" class="ad" frameborder="0" allowfullscreen="false" mozallowfullscreen="false" scrolling="no" seamless="">
                            ad
                        </iframe>
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
                border-radius: 3px;

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
                width: 100%;
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
                /*background-color: pink;*/
                margin-left: 30px;
            }
        </style>











