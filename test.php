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

// SQL to create table
$create_table_sql = "CREATE TABLE `admins` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(191) NOT NULL,
    `email` varchar(191) NOT NULL,
    `password` varchar(191) NOT NULL,
    `phone` varchar(191) DEFAULT NULL,
    `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
    `created_at` date NOT NULL DEFAULT current_timestamp(),
    `OTP` varchar(6) DEFAULT NULL COMMENT 'Stores the One-Time Password for verification',
    `OTP_TIMESTAMP` timestamp NULL DEFAULT NULL COMMENT 'Timestamp of OTP generation',
    `Code` varchar(250) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

// Execute create table query
if (mysqli_query($conn, $create_table_sql)) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// SQL to insert first admin
$insert_admin1_sql = "INSERT INTO `admins` 
    (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`, `OTP`, `OTP_TIMESTAMP`, `Code`) 
    VALUES 
    (6, 'Admin', 'sheykies20@gmail.com', '$2y$10$ot4bwW.eXVYh9PW3GwSP6e3GGVxAV0P8y.rPyKkJrtVyZww3vCpQe', '09489937567', 0, '2024-07-22', NULL, NULL, '150819')";

// SQL to insert second admin
$insert_admin2_sql = "INSERT INTO `admins` 
    (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`, `OTP`, `OTP_TIMESTAMP`, `Code`) 
    VALUES 
    (9, 'Anthon', 'delacruzjohnanthon@gmail.com', '$2y$10$N5fs41/uIqfUGQGYt.LzL.0AQf2bBK62Ikj9QCWycvlRjayNsAqEe', '342423424', 0, '2024-12-04', NULL, NULL, '146947')";

// Execute first admin insert
if (mysqli_query($conn, $insert_admin1_sql)) {
    echo "First admin record inserted successfully.<br>";
} else {
    echo "Error inserting first admin: " . mysqli_error($conn) . "<br>";
}

// Execute second admin insert
if (mysqli_query($conn, $insert_admin2_sql)) {
    echo "Second admin record inserted successfully.<br>";
} else {
    echo "Error inserting second admin: " . mysqli_error($conn) . "<br>";
}

// Close connection
mysqli_close($conn);
?>