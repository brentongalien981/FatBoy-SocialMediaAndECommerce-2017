<nav id="navSide">


    <!--Context-sensitive navigation-->
    <div id="context_sensitive_nav">
        <a id="first_context_sensitive_a" class="guide_nav" href="#">MyVideos</a>
        <a class="guide_nav">&gt;</a>
        <a class="guide_nav" href="#">Edit Videos</a>
    </div>


    <?php
    // For the timeline icon.
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

        echo "<a id='menu_wall' class='menus' menu_name='wall' href='";
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




    <?php
    // Notifications.
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_notifications' class='menus' href='" . LOCAL . "/public/__view/notifications'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_notification_bell.png' class='icon'>";
        echo "Notifications";
        echo "<span id='span_num_of_notifications' style='display: none;'></span>";
        echo "</a>";
    }
    ?>


    <!--    Profile-->
    <a id="menu_profile" class='menus' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/profile';
    } else {
        echo "#";
    }
    ?>" class="">
        <img src="<?php echo LOCAL . '/public/_photos/icon_profile.png'; ?>" class="icon">Profile
    </a>


    <!--    Friends-->
    <a id="menu_friends" class='menus' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/friends';
    } else {
        echo "#";
    }
    ?>" class="">
        <img src="<?php echo LOCAL . '/public/_photos/icon_friends.png'; ?>" class="icon">Friends
    </a>


    <!--    Videos-->
    <a id="menu_my_videos" class='menus' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/my_videos';
    } else {
        echo "#";
    }
    ?>" class="">
        <img src="<?php echo LOCAL . '/public/_photos/icon_video.png'; ?>" class="icon">MyVideos</a>


    <!--    Chat-->
    <?php
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_chat' class='menus' href='" . LOCAL . "/public/__view/view_chat'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_chat.png' class='icon'>";
        echo "Chat</a>";
    }
    ?>


    <!--    Ads-->
    <?php
    // TODO: REMINDER: Remove this once you publish it.
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_my_ads' class='menus' href='" . LOCAL . "/public/__view/view_my_ads'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_ad.png' class='icon'>";
        echo "MyAds</a>";
    }
    ?>


    <!--    Store-->
    <a id="menu_my_store" class='menus menus_with_sub_menus' menu_name='store' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/view_my_store';
    } else {
        echo "#";
    }
    ?>">
        <img src="<?php echo LOCAL . '/public/_photos/icon_store.png'; ?>" class="icon">MyStore</a>


    <?php require_once(PUBLIC_PATH . "/_layouts/sub_menus/store.php"); ?>




    <!--    Cart-->
    <?php
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_my_cart' class='menus' href='" . LOCAL . "/public/__view/view_store_cart'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_cart.png' class='icon'>";
        echo "MyCart</a>";
    }
    ?>


    <!--    Sales-->
    <?php
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_my_sales' class='menus' href='" . LOCAL . "/public/__view/view_my_sales'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_sales.png' class='icon'>";
        echo "MySales</a>";
    }
    ?>


    <!--    Refund-->
    <?php
    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
        echo "<a id='menu_my_refund' class='menus' href='" . LOCAL . "/public/__view/view_refund'>";
        echo "<img src='" . LOCAL . "/public/_photos/icon_refund.png' class='icon'>";
        echo "MyRefund</a>";
    }
    ?>




<!--    Admin Tools-->
    <?php if ($session->is_logged_in() && $session->is_viewing_own_account() && $session->is_admin()) { ?>
        <a id="menu_admin_tools" class="menus menus_with_sub_menus" menu_name="admin_tools" href="<?php echo LOCAL . "/public/__view/admin_tools/index.php"; ?>">Admin Tools</a>
        <?php require_once(PUBLIC_PATH . "/_layouts/sub_menus/admin_tools.php"); ?>
    <?php } ?>

</nav>





<!--Script-->
<?php if ($session->is_logged_in() && $session->is_viewing_own_account() && $session->is_admin()) { ?>
    <script src="<?php echo LOCAL . "/public/_scripts/layouts/sub_menus/displayer.js"; ?>"></script>
<?php } ?>





<!--Styles-->
<style>
    div.sub_menus {
        display: none;
        /*margin: 0;*/
        /*padding: 0;*/
        /*background-color: pink;*/
        margin-left: 25px;
    }
</style>