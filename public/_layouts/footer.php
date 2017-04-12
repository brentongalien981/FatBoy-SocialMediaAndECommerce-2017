    </main>
    <footer>
    <nav>
        <a href="about_us.php" class="">About Us</a>
        <a href="partners.php" class="">Partners</a>
        <a href="advertise.php" class="">Advertise</a>  
        <a href="site_map.php" class="">Site Map</a>
    </nav>

    <h6>&copy; FatBoy <?php echo date("Y", time()); ?></h6>
</footer>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>