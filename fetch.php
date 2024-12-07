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

// SQL query to fetch all records from the 'orders' table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Tracking No</th>
                <th>Invoice No</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Payment Mode</th>
                <th>Order Placed By ID</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["customer_id"] . "</td>
                <td>" . $row["tracking_no"] . "</td>
                <td>" . $row["invoice_no"] . "</td>
                <td>" . $row["total_amount"] . "</td>
                <td>" . $row["order_date"] . "</td>
                <td>" . $row["payment_mode"] . "</td>
                <td>" . $row["order_placed_by_id"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close the connection
$conn->close();
?>
