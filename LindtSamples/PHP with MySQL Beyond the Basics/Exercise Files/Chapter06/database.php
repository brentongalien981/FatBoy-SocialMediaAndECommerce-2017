<?php
require_once("config.php");

// 1. Create a database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()) {
  die("Database connection failed: " . 
       mysqli_connect_error() . 
       " (" . mysqli_connect_errno() . ")"
  );
}

// 2. Perform database query
$sql  = "SELECT * FROM subjects";
$result = mysqli_query($connection, $sql);
if (!$result) {
  die("Database query failed.");
}

// 3. Use returned data
while($row = mysqli_fetch_array($result)) {
  // output data
}

// 4. Close connection
if(isset($connection)) {
  mysqli_close($connection);
  unset($connection);
}

?>
