<?php require_once("../../_layouts/header.php"); ?>




<?php // For app debug messenger initialization. ?>
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php // Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>




<!--Styles-->
<link href="<?php echo LOCAL . "/public/_styles/my_photos/index.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <a id="add_photo_link">+ Add Photo</a>
    </nav>



    <div id="main_content">
        <?php  require_once(PUBLIC_PATH . "/__view/my_photos/create.php"); ?>
        <?php  require_once(PUBLIC_PATH . "/__view/my_photos/update.php"); ?>
        <?php  require_once(PUBLIC_PATH . "/__view/my_photos/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/admin_tools/user_management/delete.php");   ?>
    </div>

    <?php
//     TODO:SECTION:LOG
//    MyDebugMessenger::show_debug_message();
//    MyDebugMessenger::clear_debug_message();
    ?>
</main>





<!--Templates-->
<?php // require_once(PUBLIC_PATH . "/__view/admin_tools/user_management/templates/users_container.php");   ?>





<!--Scripts-->
<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/instance_vars.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/general_functions.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/my_photos/general_functions2.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/my_photos/general_functions3.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/create.js"; ?>"></script>
<!--<script src="--><?php //echo LOCAL . "/public/_scripts/my_photos/read.js"; ?><!--"></script>-->
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/update.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/delete.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/Photo.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/my_photos/event_listeners.js"; ?>"></script>
    <script src="<?php echo LOCAL . "/public/_scripts/my_photos/event_listeners2.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/my_photos/tasks.js"; ?>"></script>





<!--Sub-menus-->





<?php // TODO:SECTION: Script for page title and main content late bind ?>
<script>document.getElementById("title").innerHTML = "MyPhotos / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>





<!--Supporting Scripts-->





<!--Script for ad displayer-->
<!--Footer-->
<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>