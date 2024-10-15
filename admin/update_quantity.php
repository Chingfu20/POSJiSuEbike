<?php
session_start();
include('config/dbconn.php'); // Ensure you include the database connection
include('functions.php'); // Include your custom functions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate inputs
    $productId = isset($data['product_id']) ? validate($data['product_id']) : null;
    $quantity = isset($data['quantity']) ? validate($data['quantity']) : null;

    if ($productId && $quantity) {
        // Update the product's quantity in the database
        $query = "UPDATE products SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $quantity, $productId);

        if ($stmt->execute()) {
            jsonResponse(200, 'success', 'Quantity updated successfully.');
        } else {
            jsonResponse(500, 'error', 'Failed to update quantity.');
        }

        $stmt->close();
    } else {
        jsonResponse(400, 'error', 'Invalid input data.');
    }
} else {
    jsonResponse(405, 'error', 'Method not allowed.');
}
