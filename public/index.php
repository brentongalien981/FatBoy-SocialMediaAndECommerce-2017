<?php // require_once("../includes/initialize.php"); ?>
<?php require_once("../private/includes/initializations.php"); ?>

<?php // include_layout_template('header.php'); ?>
<?php include(PUBLIC_PATH . "/_layouts/header.php"); ?>





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

<link href="_styles/index.css" rel="stylesheet" type="text/css">





<script>
    document.getElementById("title").innerHTML += " / home";
</script>





<?php // include_layout_template('footer.php'); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
