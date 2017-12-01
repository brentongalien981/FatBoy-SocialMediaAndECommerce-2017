<nav id="navSide">


    <!--Context-sensitive navigation-->
    <div id="context_sensitive_nav">
        <a id="first_context_sensitive_a" class="guide_nav" href="#">MyVideos</a>
        <a class="guide_nav">&gt;</a>
        <a class="guide_nav" href="#">Edit Videos</a>
    </div>


    <!--    For the timeline icon.-->
    <?php if ($session->is_logged_in()) { ?>

        <a id="menu_wall" class='menus' href="<?= LOCAL . "/public/index.php" ?>">
            <?php show_user_home_icon($session->currently_viewed_user_id, "icon", "wall", $session->currently_viewed_user_name) ?>
        </a>

    <?php } else { ?>

        <a id="menu_wall" class='menus' href="#">
            <?php show_user_home_icon(-69, "icon", "wall", "Guest") ?>
        </a>

    <?php } ?>




    <?php
//    // Notifications.
//    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
//        echo "<a id='menu_notifications' class='menus' href='" . LOCAL . "/public/__view/notifications'>";
//        echo "<img src='" . LOCAL . "/public/_photos/icon_notification_bell.png' class='icon'>";
//        echo "Notifications";
//        echo "<span id='span_num_of_notifications' style='display: none;'></span>";
//        echo "</a>";
//    }
    ?>


    <!--    Profile-->
    <a id="menu_profile" class='menus' href="

        <?php if ($session->is_logged_in()) { ?>

            <?= LOCAL . "/public/__view/profile" ?>

        <?php } else { ?>

            <?= "#" ?>

        <?php } ?>

    ">

        <?php show_user_home_icon(-69, "icon", "profile", "Profile") ?>

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


    <!--    Photos-->
    <a id="menu_my_photos" class='menus' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/my_photos';
    } else {
        echo "#";
    }
    ?>" class="">
        <i class="fa fa-instagram icon" style="font-size:24px; color: purple;"></i>MyPhotos</a>


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


<!--    ********************************-->
    <!--    Videos-->
    <a id="menu_my_videos" class='menus' href="
                                <?php
    if ($session->is_logged_in()) {
        echo LOCAL . '/public/__view/videos';
    } else {
        echo "#";
    }
    ?>" class="">
        <img src="<?php echo LOCAL . '/public/_photos/icon_video.png'; ?>" class="icon">Beta - MyVideos</a>



    <!--    Chat-->
    <?php
//    if ($session->is_logged_in() && $session->is_viewing_own_account()) {
//        echo "<a id='menu_chat' class='menus' href='" . LOCAL . "/public/__view/view_chat'>";
//        echo "<img src='" . LOCAL . "/public/_photos/icon_chat.png' class='icon'>";
//        echo "Chat</a>";
//    }
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

    <!--    New cart-->
    <?php if ($session->is_logged_in() && $session->is_viewing_own_account()) { ?>
        <a id="" class="menus" href="<?= LOCAL . "/public/__view/store_carts/index.php"?>">
            <img src="<?= LOCAL . "/public/_photos/icon_cart.png" ?>" class="icon">New My Cart (beta)
        </a>
    <?php } ?>


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
        <a id="menu_admin_tools" class="menus menus_with_sub_menus" menu_name="admin_tools"
           href="<?php echo LOCAL . "/public/__view/admin_tools/index.php"; ?>"><i class="fa fa-sliders icon"
                                                                                   style="font-size:24px;"></i>Admin
            Tools</a>
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