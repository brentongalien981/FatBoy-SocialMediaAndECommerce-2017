<footer>
    <nav>
        <a href="#" class="">About Us</a>
        <a href="#" class="">Contact Us</a>
        <a href="#" class="">Advertise</a>  
        <!--<a href="site_map.php" class="">Site Map</a>-->
    </nav><br>

    <h6>&copy; FatBoy <?php echo date("Y", time()); ?></h6>
</footer>


<script>
//    window.onload = function () {
//        var myTimeout;
//        
//        myTimeout = setTimeout(function () {
//            $("#the_spinner_div").fadeOut("slow", "linear", hideSpinner);
//            
//        }, 500);
//        
//
//        
//        function hideSpinner() {
//            document.getElementById("the_spinner_div").style.display = "none";
//            clearTimeout(myTimeout);
//        }
//    };

    $(document).ready(function () {
        setTimeout(function () {
            $("#the_spinner_div").fadeOut("slow", "linear", hideSpinner);

        }, 10);



        function hideSpinner() {
            document.getElementById("the_spinner_div").style.display = "none";
        }
    });
</script>
</body>

<!--<link href="../_styles/header.css" media="all" rel="stylesheet" type="text/css" />-->
</html>
<?php
if (isset($database)) {
    $database->close_connection();
}
?>