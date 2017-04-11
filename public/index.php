<?php require_once("../includes/initialize.php"); ?>
<?php include_layout_template('header.php'); ?>

<?php
echo "tae fatboy<br>";


global $database;

$result = $database->query("SELECT * FROM Users");

for ($i = 0; $i < $database->num_rows($result); $i++) {
    echo "<pre>";
    print_r($database->fetch_array($result));
    echo "</pre>";
}
?>

<link href="_styles/index.css" rel="stylesheet" type="text/css">
<script>
    document.getElementById("title").innerHTML += " / home";
</script>


<?php include_layout_template('footer.php'); ?>
