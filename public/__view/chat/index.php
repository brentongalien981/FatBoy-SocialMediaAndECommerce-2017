<?php //require_once("../../_layouts/header.php"); ?>


    <!--For app debug messenger initialization.-->
<?php
//if (!MyDebugMessenger::is_initialized()) {
//    MyDebugMessenger::initialize();
//}
?>


<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
//    redirect_to(LOCAL . "/public/__view/view_log_in.php");
    return;
}
?>


    <!--uki-->
    <link href="<?php echo LOCAL . "/public/_styles/chat/index.css"; ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo LOCAL . "/public/_styles/chat/read.css"; ?>" rel="stylesheet" type="text/css">


    <!--    <main id="middle_content">-->

    <!--        <nav id="sub_menus_nav">-->
    <!--        </nav>-->


    <!--        <div id="main_content">-->
    <div id="chat_widget">
        <!-- Helper Pseudo-menus -->
        <?php require_once(PUBLIC_PATH . "/__view/chat_list/index.php"); ?>

        <!--            --><?php //require_once(PUBLIC_PATH . "/__view/chat/create.php"); ?>
        <?php require_once(PUBLIC_PATH . "/__view/chat/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/chat/update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/chat/delete.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_delete.php"); ?>


    </div>
    <!--    </main>-->


    <!--Templates-->
<?php // require_once(PUBLIC_PATH . "/__view/admin_tools/user_management/templates/users_container.php");   ?>


    <!--Scripts-->
    <script src="<?php echo LOCAL . "/public/_scripts/chat/instance_vars.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/general_functions.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/general_functions2.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/general_functions3.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/create.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/chat/read.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/update.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/delete.js"; ?><!--"></script>-->
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/Photo.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/chat/event_listeners.js"; ?>"></script>
    <!--    <script src="--><?php //echo LOCAL . "/public/_scripts/chat/event_listeners2.js"; ?><!--"></script>-->
    <script src="<?php echo LOCAL . "/public/_scripts/chat/event_handlers.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/chat/tasks.js"; ?>"></script>


    <!--Sub-menus-->


<?php // TODO:SECTION: Script for page title and main content late bind ?>
    <!--    <script>document.getElementById("title").innerHTML = "Chat / FatBoy";</script>-->
    <!--    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>-->


    <!--Supporting Scripts-->


    <!--Script for ad displayer-->
<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>

    <!--Footer-->
<?php //include(PUBLIC_PATH . "/_layouts/footer.php"); ?>