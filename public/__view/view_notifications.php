<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_notifications.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_my_store_items.php"); ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>











<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>










<?php
// TODO: SECTION: Sub-menus.
?>
<a>sub-menu1</a>
<a>sub-menu2</a>
</nav>












<?php

// TODO: SECTION: Functions.
?>












<?php
// TODO: SECTION: Meat.
echo "<h3>Notifications</h3>";
show_sales_notifications();
?>










<?php
// TODO: SECTION: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<?php
// TODO: SECTION: Styles.
?>
<!--<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />-->
<style>   
</style>





<?php
// TODO: SECTION: Scripts.
?>
<!--<script src="../_scripts/view_profile.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / Notifications";
</script>












<?php
// TODO: SECTION: Footer.
?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
