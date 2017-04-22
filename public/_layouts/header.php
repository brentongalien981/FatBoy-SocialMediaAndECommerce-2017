<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>


<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<!doctype>
<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <link href="<?php echo LOCAL . '/public/_styles/header.css' ?>" media="all" rel="stylesheet" type="text/css" />
        <style>
            #divStatus {
                color: black;
            }

            #divStatus h4 {
                width: fit-content;
                background-color: red;
            }



            #divStatus a {
                width: fit-content;
                background-color: greenyellow;
            }

            #divStatus #user_name {
                padding-top: 10px;
                font-size: 130%;
                width: fit-content;
                background-color: #D4E6F4;
            }

            #divWebsite h4 {
                background-color: orange;
            }
        </style>
    </head>
    <body>
        <div id="divBanner">



            <div id="divStatus">
                <?php
                if ($session->is_logged_in()) {
                    echo "<a id='user_name' href='" . LOCAL . "/public/index.php?is_viewing_actual_user_again=1'>{$session->actual_user_name}</a>";
                    echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                } else {
                    echo "<h4>zZzzZz</h4>";
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

            <a href="<?php echo LOCAL . '/public/__view/view_profile.php'; ?>" class="">Profile</a>

            <a href="<?php echo LOCAL . '/public/__view/view_friends.php'; ?>" class="">Friends</a>

            <a href="<?php echo LOCAL . '/public/__view/view_my_videos.php'; ?>" class="">MyVideos</a>


            <a href="<?php echo LOCAL . '/public/__view/view_my_store'; ?>">MyStore</a>

            <!--Sign-up-->
            <?php
            if (!$session->is_logged_in()) {
                echo "<a href='" . LOCAL . "/public/__view/view_signup.php'>Sign-up</a>";
            }
            ?>
        </nav>
        <main id="main">

            <!--Sub-menus-->
            <nav id="sub_menus_nav">

