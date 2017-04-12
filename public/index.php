<?php // require_once("../private/includes/initializations.php"); ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php"); ?>
<?php include("_layouts/header.php"); ?>





<?php
echo "tae fatboy<br>";


$users = User::read_all();

echo "<pre>";
foreach ($users as $user) {
    print_r($user);
}
echo "</pre>";
//global $database;
//$query = "SELECT * FROM Users";
////mysqli_query(database->connection)

?>

<link href="_styles/header.css" media="all" rel="stylesheet" type="text/css" />
<link href="_styles/index.css" rel="stylesheet" type="text/css">





<script>
    document.getElementById("title").innerHTML += " / home";
</script>





<?php // include_layout_template('footer.php'); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
