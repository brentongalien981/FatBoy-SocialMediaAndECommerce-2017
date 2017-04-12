<?php

function confirm_query($result) {
  if (!$result) {
    die("Database query failed.");
  }
}

function mysql_prep($string) {
  global $connection;
  
  $escaped_string = mysqli_real_escape_string($connection, $string);
  return $escaped_string;
}

?>
