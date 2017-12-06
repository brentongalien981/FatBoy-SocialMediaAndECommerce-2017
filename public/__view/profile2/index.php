<?php require_once("../../_layouts/header.php"); ?>


<?php if (!$session->is_logged_in()) { ?>
    <?php redirect_to(LOCAL . "/public/__view/view_log_in.php"); ?>
<?php } ?>


<!--Styles-->
<link href="<?php echo LOCAL . "/public/_styles/profile2/read.css"; ?>" rel="stylesheet" type="text/css">


<main id="middle_content">

    <nav id="sub_menus_nav">
    </nav>


    <div id="main_content">
        <!--        --><?php //require_once(PUBLIC_PATH . "/__view/profile2/create.php"); ?>
        <?php require_once(PUBLIC_PATH . "/__view/profile2/read.php"); ?>
        <!--        --><?php //require_once(PUBLIC_PATH . "/__view/profile2/update.php"); ?>
    </div>

    <!--Templates-->
</main>


<!--Scripts-->
<!--Late-bind scripts-->
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>
<script>document.getElementById("title").innerHTML = "Profile / FatBoy";</script>

<!--Extentional scripts-->


<!--Main scripts-->
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/instance_vars.js"; ?><!--"></script>-->
<script src="<?= LOCAL . "/public/_scripts/profile2/general_functions.js"; ?>"></script>
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/general_functions2.js"; ?><!--"></script>-->
<!--    <script src="--><? //= LOCAL . "/public/_scripts/profile2/general_functions3.js"; ?><!--"></script>-->
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/create.js"; ?><!--"></script>-->
<script src="<?= LOCAL . "/public/_scripts/profile2/read.js"; ?>"></script>
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/update.js"; ?><!--"></script>-->
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/delete.js"; ?><!--"></script>-->
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/fetch.js"; ?><!--"></script>-->
<script src="<?= LOCAL . "/public/_scripts/profile2/Profile.js"; ?>"></script>
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/event_handlers.js"; ?><!--"></script>-->
<!--<script src="--><? //= LOCAL . "/public/_scripts/profile2/event_listeners.js"; ?><!--"></script>-->
<!--    <script src="--><? //= LOCAL . "/public/_scripts/profile2/event_listeners2.js"; ?><!--"></script>-->
<script src="<?= LOCAL . "/public/_scripts/profile2/tasks.js"; ?>"></script>


<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>


