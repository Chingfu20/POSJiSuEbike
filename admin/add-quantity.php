<?php
include('config/dbcon.php'); // Include database connection

if (isset($_POST['id'])) {
    $productId = mysqli_real_escape_string($conn, $_POST['id']);
    $quantityToAdd = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1; // Default is 1

    // Fetch current quantity
    $query = "SELECT quantity FROM products WHERE id = '$productId'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $newQuantity = $product['quantity'] + $quantityToAdd;

        // Update quantity in database
        $updateQuery = "UPDATE products SET quantity = '$newQuantity' WHERE id = '$productId'";
        if (mysqli_query($conn, $updateQuery)) {
            echo json_encode(['status' => 'success', 'new_quantity' => $newQuantity]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }
}
?>
