<div id="divStatus">

    <!--    If logged-in, display a user-home-menu that let's the user go back-->
    <!--    to her home page when clicked. Else, just don't respond to it's click event. -->
    <?php if ($session->is_logged_in()) { ?>

        <a id="link_home" href="<?= LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1" ?>">
            <?php show_user_home_icon($session->actual_user_id, "header_icon", "user_home") ?>
        </a>

    <?php } else { ?>

        <a id="link_home" href="#">
            <?php show_default_user_home_icon("header_icon", "user_home") ?>
        </a>

    <?php } ?>
</div>


<?php require_once(PUBLIC_PATH . "/_layouts/banner_user_home_menu_popup.php"); ?>