<?php
if (isset($_POST["my_select"])) {
    echo "<br>select is set<br>";
}

if (isset($_POST["number"])) {
    echo "<br>number is set<br>";
}

if (isset($_POST["set"])) {
    echo "<br>set is set<br>";
}
?>

<form action="home.php" method="post">
    <select name="my_select" onchange="this.form.submit()">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    <input type="number" name="number" value="" onchange="this.form.submit()">
    <input type="submit" name="set" value="set">
</form>  

