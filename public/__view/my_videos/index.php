<?php require_once("../../_layouts/header.php"); ?>




<?php // For app debug messenger initialization. ?>
<?php if (!MyDebugMessenger::is_initialized()) { MyDebugMessenger::initialize(); } ?>





<?php // Make sure the actual user is logged-in. ?>
<?php if (!$session->is_logged_in()) { redirect_to(LOCAL . "/public/__view/view_log_in.php"); } ?>






<link href="<?php echo LOCAL . "/public/_styles/my_videos/index.css"; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo LOCAL . "/public/_styles/my_videos/read.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <a id="add_video_link">Add Video</a>
    </nav>



    <div id="main_content">
        <?php require_once(PUBLIC_PATH . "/__view/my_videos/create.php"); ?>
        <?php require_once(PUBLIC_PATH . "/__view/my_videos/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/my_videos/update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/my_videos/delete.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/my_videos/ajax_read.php"); ?>
        <?php require_once(PUBLIC_PATH . "/_scripts/my_videos/ajax_create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/my_videos/ajax_update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/my_videos/ajax_delete.php"); ?>        





        <?php
// TODO:SECTION:LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>
    </div>    
</main>





<script>document.getElementById("title").innerHTML = "MyVideos / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
<?php require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
