<?php
// Database connection details
define('DB_SERVER', "localhost");
define('DB_USERNAME', "u510162695_db_jisu_pos");
define('DB_PASSWORD', "1Db_jisu_pos");
define('DB_DATABASE', "u510162695_db_jisu_pos");

// Establish connection
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// SQL to drop the table if it exists
$drop_table_sql = "DROP TABLE IF EXISTS `admins`";

// Execute drop table query
if (mysqli_query($conn, $drop_table_sql)) {
    echo "Existing admins table dropped successfully.<br>";
} else {
    echo "Error dropping table: " . mysqli_error($conn) . "<br>";
}


// Close connection
mysqli_close($conn);
?>