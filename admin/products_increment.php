<?php
require '../config/function.php';
require '../config/dbcon.php';

// Check if product ID is provided
if(isset($_GET['id'])) {
    $productId = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Update quantity by incrementing by 1
    $query = "UPDATE products SET quantity = quantity + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    
    if(mysqli_stmt_execute($stmt)) {
        redirect('products.php', 'Quantity updated successfully.');
    } else {
        redirect('products.php', 'Something went wrong while updating quantity.');
    }
} else {
    redirect('products.php', 'Product ID not found.');
}
?>