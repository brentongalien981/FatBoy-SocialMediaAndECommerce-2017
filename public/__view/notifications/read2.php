<?php if ($session->is_logged_in()) { ?>
    <div class="widget-menu-bar">
        <img src="<?= LOCAL . "/public/_photos/icon_notification_bell.png" ?>" class="icon widget-menu-bar-icon widget-menu-bar-item">
        <h5 class="widget-title widget-menu-bar-item">Notifications</h5>
        <span id="span_num_of_notifications" class="widget-menu-bar-item" style="display: none"></span>
    </div>
<?php } ?>

<!--<a id="menu_notifications" class="menus" href="--><? //= LOCAL . "/public/__view/notifications"?><!--">-->
