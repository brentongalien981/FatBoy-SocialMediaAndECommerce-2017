<?php require_once("../../_layouts/header.php"); ?>


<?php if (!$session->is_logged_in()) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>


    <!--Styles-->
    <link href="<?php echo LOCAL . "/public/_styles/videos/index.css"; ?>" rel="stylesheet" type="text/css">


    <main id="middle_content">

        <nav id="sub_menus_nav">
            <?php if ($session->is_viewing_own_account()) { ?>
                <a id="add_video_link">+ Add Video</a>
                <a>* Edit Video</a>
                <a>- Delete Video</a>
            <?php } ?>
        </nav>


        <div id="main_content">
            <?php require_once(PUBLIC_PATH . "/__view/videos/create.php"); ?>
            <?php require_once(PUBLIC_PATH . "/__view/videos/read.php"); ?>
            <?php require_once(PUBLIC_PATH . "/__view/videos/update.php"); ?>
        </div>

        <!--Templates-->
    </main>


    <!--Scripts-->
    <!--Late-bind scripts-->
    <script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
    <script>document.getElementById("title").innerHTML = "Videos / FatBoy";</script>

    <!--Extentional scripts-->


    <!--Main scripts-->
    <script src="<?= LOCAL . "/public/_scripts/videos/instance_vars.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/general_functions.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/general_functions2.js"; ?>"></script>
    <!--    <script src="--><? //= LOCAL . "/public/_scripts/videos/general_functions3.js"; ?><!--"></script>-->
    <script src="<?= LOCAL . "/public/_scripts/videos/create.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/read.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/update.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/delete.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/fetch.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/MyVideo.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/event_handlers.js"; ?>"></script>
    <script src="<?= LOCAL . "/public/_scripts/videos/event_listeners.js"; ?>"></script>
    <!--    <script src="--><? //= LOCAL . "/public/_scripts/videos/event_listeners2.js"; ?><!--"></script>-->
    <script src="<?= LOCAL . "/public/_scripts/videos/tasks.js"; ?>"></script>


    <!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>