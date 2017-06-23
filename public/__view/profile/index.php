<?php require_once("../../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_profile.php"); ?>





<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>




<link href="<?php echo LOCAL . "/public/_styles/profile/main.css"; ?>" rel="stylesheet" type="text/css">

<main id="middle_content">



    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a href="" id="sub_nav_chat_with">Sub-menu A</a>
    </nav>





    <!--Main content.-->
    <?php
    show_user_profile_summary();

//    show_work_experience();
    ?>
    <?php require_once(PUBLIC_PATH . "/__view/profile/work/index.php"); ?>








    <?php require_once(PUBLIC_PATH . "/__view/view_profile_likes.php"); ?>




    <?php
// TODO: SECTION: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>





<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Profile / FatBoy";
</script>






<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>






<script src="<?php echo LOCAL . "/public/_scripts/profile_likes.js"; ?>"></script>





<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>