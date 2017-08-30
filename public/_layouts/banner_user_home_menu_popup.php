<!-- Pop-up when home icon is hovered.-->
<?php if ($session->is_logged_in()) { ?>

    <div id="pop_up_for_link_home">;
        <a id="first_pop_up_link" class="pop_up_links"
           href="<?= LOCAL . "/public/__controller/log_out.php" ?>">Log-out</a>
    </div>

<?php } else { ?>

    <div id="pop_up_for_link_home">
        <a id="first_pop_up_link" class="pop_up_links" href="<?= LOCAL . "/public/__view/view_log_in.php" ?>">Log-in</a><br>
        <a href="<?= LOCAL . "/public/__view/view_signup.php" ?>" class="pop_up_links">Sign-up</a><br>
    </div>

<?php } ?>
