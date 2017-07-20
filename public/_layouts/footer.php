<footer>
    <nav>
        <a href="#" class="">About Us</a>
        <a href="#" class="">Contact Us</a>
        <a href="#" class="">Advertise</a>  
        <!--<a href="site_map.php" class="">Site Map</a>-->
    </nav><br>

    <h6>&copy; FatBoy <?php echo date("Y", time()); ?></h6>
</footer>


<?php // TODO:REMINDER: Uncomment this laster.?>
<script>
//    $(document).ready(function () {
//        setTimeout(function () {
//            $("#the_spinner_div").fadeOut("slow", "linear", hideSpinner);
//
//        }, 10);
//
//
//
//        function hideSpinner() {
//            document.getElementById("the_spinner_div").style.display = "none";
//        }
//    });
</script>





<script src="<?php echo LOCAL . "/public/_scripts/admin_tools/user_management/final_page_layout.js"; ?>"></script>


</body>

<!--<link href="../_styles/header.css" media="all" rel="stylesheet" type="text/css" />-->
</html>
<?php
if (isset($database)) {
    $database->close_connection();
}
?>