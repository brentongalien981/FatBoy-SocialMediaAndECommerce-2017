<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <link href="_styles/header.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="divBanner">
            
            
            
            <div id="divStatus">
                <?php
                // TODO
                if (isset($_SESSION["actual_username"])) {
                    echo "<a href='user_authentication.php' id='link_actual_user_name' title='Go back to my profile...'>Hello {$_SESSION['actual_username']}!</a>";
                    echo "<a href=\"account_logout.php\">Log-out</a>";
                } else {
                    echo "<h4>zZzzZz</h4>";
                    echo "<a href=\"account_login.php\">Log-in</a>";
                }
                ?>
            </div>
            
            
            
            <div id="divWebsite">
                <h4 id="h4Website">FatBoy &reg;</h4>
            </div>
        </div>


        <nav id="navSide">    
            <a href="index.php" class="">Timeline
                <?php
                if (isset($_SESSION["username"])) {
                    echo " of {$_SESSION["username"]}";
                }


                // Show the timeline notification badge.
                // If the user is signed-in and the actual account being viewed
                // is the actual user's account, then show the timeline notification badge.
                if ((isset($_SESSION["actual_username"])) &&
                        ($_SESSION["actual_username"] == $_SESSION["username"])) {
                    $number_of_timeline_notifications = get_number_of_timeline_notifications($_SESSION["user_id"]);

                    if ($number_of_timeline_notifications > 0) {
                        echo "<span>{$number_of_timeline_notifications}</span>";
                    }
                }
                ?>
            </a>
            <a href="profile.php" class="">Profile</a>  
            <a href="friends.php" class="">Friends
                <?php
                // Show the friendship notification badge.
                // If the user is signed-in and the actual account being viewed
                // is the actual user's account, then show the friendship notification badge.
                if ((isset($_SESSION["actual_username"])) &&
                        ($_SESSION["actual_username"] == $_SESSION["username"])) {
                    $friend_notification_flag = 2;
                    $number_of_friend_notifications = get_number_of_notifications($friend_notification_flag, $_SESSION["user_id"]);

                    if ($number_of_friend_notifications > 0) {
                        echo "<span>{$number_of_friend_notifications}</span>";
                    }
                }
                ?>
            </a>

            <a href="my_videos.php" class="">MyVideos</a> 
            <a href="my_store.php">MyStore</a>




<?php
// Make sure that the actual user is viewing her own account,
// so she won't see someone's cart.
if ((isset($_SESSION["actual_username"])) &&
        ($_SESSION["actual_username"] == $_SESSION["username"]) &&
        (isset($_SESSION["my_cart_items"]))) {
    echo "<a href='my_cart.php'>MyCart";

    // If there's at least one item on her cart,
    // notify her with a badge.
    $num_of_cart_items = count($_SESSION["my_cart_items"]);
    if ($num_of_cart_items > 0) {
        echo "<span>" . count($_SESSION["my_cart_items"]) . "</span>";
    }

    echo "</a>";
}
?>         



<?php
//
if ((isset($_SESSION["actual_username"])) && ($_SESSION["actual_username"] == $_SESSION["username"])) {
    echo "<a href='my_settings.php'>MySettings</a>";
}
?>





<?php
// If the user is signed-in and not a regular user..
$regular_user_type_id = 3;
if ((isset($_SESSION["actual_user_type_id"])) &&
        ($_SESSION["actual_user_type_id"] != $regular_user_type_id) &&
        ($_SESSION["actual_username"] == $_SESSION["username"])) {
    echo "<a href='admin_creation.php'>Admin Creation</a>";
    echo "<a href=''>User Management</a>";
}
?>

        </nav>  
        <main id="main">
