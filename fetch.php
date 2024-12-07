<?php
// Database connection details
$servername = "localhost"; // your server name
$username = "u510162695_db_jisu_pos"; // your database username
$password = "1Db_jisu_pos"; // your database password
$dbname = "u510162695_db_jisu_pos"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete all records from the 'orders' table
$sql = "DELETE FROM orders";

if ($conn->query($sql) === TRUE) {
    echo "All records have been deleted from the 'orders' table.";
} else {
    echo "Error deleting records: " . $conn->error;
}

// Close the connection
$conn->close();
?>
