<div class="dropdown">
    <a id="actual-user-options"
       class="nav-link dropdown-toggle"
       href="#"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">
    </a>

    <div class="dropdown-menu"
         aria-labelledby="">

        <?php if ($session->is_logged_in()) { ?>

            <a class="dropdown-item"
               href="<?= LOCAL . "/public/__controller/log_out.php"; ?>">
                Log-out
            </a>

        <?php } else { ?>

            <a class="dropdown-item"
               href="<?= LOCAL . "/public/__view/log_in.php"; ?>">
                Log-in
            </a>

            <a class="dropdown-item"
               href="#">
<!--                --><?//= LOCAL . "/public/__view/view_signup.php"; ?>
                Sign-up
            </a>

        <?php } ?>
    </div>
</div>