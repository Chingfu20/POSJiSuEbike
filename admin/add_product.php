<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if ($productId > 0 && $quantity > 0) {
        // Insert logic to add the product to the user's cart
        $query = "INSERT INTO cart (product_id, quantity) VALUES ($productId, $quantity)
                  ON DUPLICATE KEY UPDATE quantity = quantity + $quantity"; // Adjust as necessary

        if (mysqli_query($conn, $query)) {
            echo "Product added successfully!";
        } else {
            echo "Error adding product: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid product ID or quantity.";
    }
} else {
    echo "Invalid request.";
}
?>
