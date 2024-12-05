<?php 
$servername = "localhost";
$username = "u510162695_db_jisu_pos";
$password = "1Db_jisu_pos";
$db = "u510162695_db_jisu_pos";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>