<?php
include('config.php'); // Include your database connection

if(isset($_POST['product_id'])) {
    $productId = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Fetch current quantity
    $query = "SELECT quantity FROM products WHERE id = '$productId'";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $currentQuantity = $product['quantity'];

        // Increment the quantity
        $newQuantity = $currentQuantity + 1;

        // Update the quantity in the database
        $updateQuery = "UPDATE products SET quantity = '$newQuantity' WHERE id = '$productId'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if($updateResult) {
            // Return a success response with the new quantity
            echo json_encode([
                'success' => true,
                'new_quantity' => $newQuantity
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update the quantity.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Product not found.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request.'
    ]);
}
