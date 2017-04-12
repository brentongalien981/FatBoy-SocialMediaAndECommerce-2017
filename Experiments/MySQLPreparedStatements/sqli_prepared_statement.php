<?php

// 1. Connect
$mysqli = new mysqli("localhost", "user1", "user1", "dub3");

if($mysqli->connect_errno) {
  die("Connect failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// 2. Prepare
$sql = "SELECT * FROM Users WHERE UserName = ? AND UserTypeId = ?";
$stmt = $mysqli->prepare($sql);

if(!$stmt) {
	die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}

// 3. Bind params
// s = string
// i = integer
// d = double (float)
// b = blob (binary data)
$user_name = 'bren';
$user_type_id = 1;

$bind_result = $stmt->bind_param("si", $user_name, $user_type_id);
if(!$bind_result) {
	echo "Binding failed: (" . $stmt->errno . ") " . $stmt->error;
}

// 4. Execute
$execute_result = $stmt->execute();
if(!$execute_result) {
  echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

// $stmt->store_result();

// 5. Bind selected columns to variables
$stmt->bind_result($user_id, $user_name, $hashed_password, $user_type_id);

// 6. Use results
while($stmt->fetch()) {
	echo 'ID: ' . $user_id . '<br />';
	echo 'Username: ' . $user_name . '<br />';
        echo "HashedPassword: {$hashed_password}<br>";
	echo '<br />';
}

// 7. Free results
$stmt->free_result();

// 8. Close statment
$stmt->close();

// 9. Close MySQL connection
$mysqli->close();

?>
