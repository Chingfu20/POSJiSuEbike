<?php
$servername = "localhost";
$username = "u510162695_db_jisu_pos";
$password = "1Db_jisu_pos";
$dbname = "u510162695_db_jisu_pos";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete all records from the orders table
$sql = "DELETE FROM orders";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "All records have been successfully deleted from the orders table.";
} else {
    echo "Error deleting records: " . $conn->error;
}

// Close the connection
$conn->close();
?>
