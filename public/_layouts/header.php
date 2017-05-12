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
        <!--<link href="<?php // echo LOCAL . '/public/_styles/header.css'      ?>" rel="stylesheet" type="text/css" />-->
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
            }



            a {
                text-decoration: none;
            }
            
            

            a:hover {
                color: red;
            }

            table a {
                color: orange;
            }

            table {
                margin-top: -15px;
                font-size: 80%;
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

            #divBanner {
                width: 100%;
                height: 60px;
                margin: 0;
                padding: 0;
                background-color: #AFEEEE;
            }

            #divStatus {
                /*width: 40%;*/
                background-color: pink;
                /*float: left;*/
                display: inline;
                font-size: 70%;
                font-weight: 100;
                color: black;
            }





            #divWebsite {
                width: 30%;
                /*background-color: yellow;*/
                float: right;
                margin-top: -25px;
                /*clear: none;*/
                /*display: inline;*/
            }



            #divBanner h4 {
                width: 40%;
                /*text-align: right;*/
                margin: 0;
                padding: 0;
                /*padding-top: 15px;*/
                /*padding-right: 20px;*/
                font-size: 110%;
                font-weight: 200;
                /*background-color: yellowgreen;*/
                /*float: right;*/
            }

            #divStatus h4 {
                padding-top: 13px;
                padding-left: 35px;
                font-size: 90%;
                background-color: red;
            }



            #divStatus a {
                display: block;
                /*padding-top: 5px;*/
                /*padding-left: 35px;*/

                /*width: fit-content;*/
                width: 7%;
                padding-left: 0;
                margin-left: 35px;
                /*background-color: greenyellow;*/

                /*font-weight: 100;*/
            }

            .user_name {
                padding-top: 10px;
                font-size: 130%;
                /*                width: fit-content;*/
                /*width: 50%;*/
                /*background-color: #D4E6F4;*/
                /*background-color: red;*/
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
                float: right;
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
                width: 47%;
                margin-top: 0;
                /*margin-left: 1%;*/
                padding: 1%;
                padding-top: 0;
                padding-left: 35px;
                background-color: #ffffe6;
                float: left;

            }

            #navSide {
                width: 12%;
                height: 250px;
                padding: 1%;
                padding-left: 35px;
                font-size: 90%;
                font-weight: 200;
                background-color: #e6eeff;
                float: left;
            }

            .ad {
                width: 400px;
                height: 247px;
                margin: 0;
                padding: 0;
                /*background-color: yellowgreen;*/
                float: right;
                display: none;
            }

            #navSide a {
                text-decoration: none;
                margin-bottom: 5px;
                display: block;
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
                margin-left: -35px;
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

        </style>
    </head>
    <body>
        <div id="divBanner">



            <div id="divStatus">
                <?php
                if ($session->is_logged_in()) {
                    echo "<a class='user_name' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>Hello {$session->actual_user_name}!</a>";
                    echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                } else {
                    echo "<a class='user_name'>zZzzZz</a>";
                    echo "<a href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a>";
                }
                ?>
            </div>





            <div id="divWebsite">
                <h4 id="h4Website">FatBoy &reg;</h4>
            </div>
        </div>




        <nav id="navSide">
            <a href="<?php echo LOCAL . '/public/index.php'; ?>" class="">Timeline
                <?php
                if ($session->is_logged_in()) {
                    echo " of {$session->currently_viewed_user_name}";
                }
                ?>
            </a>


            <?php
            // Notifications.
            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                echo "<a href='" . LOCAL . "/public/__view/view_notifications.php'>Notifications";

                if ($session->num_of_notifications > 0) {
                    echo "<span id='span_num_of_notifications' style='display: inline;'>{$session->num_of_notifications}</span>";
//                    echo "<span id='span_num_of_notifications'>5</span>";
                } else {
                    echo "<span id='span_num_of_notifications' style='display: none;'></span>";
                }

                echo "</a>";
            }
            ?>

            <a href="<?php echo LOCAL . '/public/__view/view_profile.php'; ?>" class="">Profile</a>

            <a href="<?php echo LOCAL . '/public/__view/view_friends.php'; ?>" class="">Friends</a>

            <a href="<?php echo LOCAL . '/public/__view/view_my_videos'; ?>" class="">MyVideos</a>


            <a href="<?php echo LOCAL . '/public/__view/view_my_ads'; ?>">MyAds</a>


            <a href="<?php echo LOCAL . '/public/__view/view_my_store'; ?>">MyStore</a>

            <?php
            // MyCart
            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                echo "<a href='" . LOCAL . "/public/__view/view_store_cart'>MyCart</a>";
            }
            ?>



            <?php
            // MySales
            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                echo "<a href='" . LOCAL . "/public/__view/view_my_sales'>MySales</a>";
            }
            ?>


            <?php
            // MyRefund
            if ($session->is_logged_in() && $session->is_viewing_own_account()) {
                echo "<a href='" . LOCAL . "/public/__view/view_refund'>MyRefund</a>";
            }
            ?>



            <?php
            // Sign-up
            if (!$session->is_logged_in()) {
                echo "<a href='" . LOCAL . "/public/__view/view_signup.php'>Sign-up</a>";
            }
            ?>
        </nav>









        <iframe class="ad">
            ad
        </iframe>











        <main id="main">

            <!--Sub-menus-->
            <nav id="sub_menus_nav">

