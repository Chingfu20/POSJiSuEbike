<?php
include('includes/header.php');
include('includes/db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['id']);
    $quantityToAdd = intval($_POST['quantity']);

    if ($quantityToAdd > 0) {
        $query = "UPDATE products SET quantity = quantity + $quantityToAdd WHERE id = $productId";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = 'Quantity added successfully!';
        } else {
            $_SESSION['message'] = 'Error updating quantity: ' . mysqli_error($conn);
        }
    } else {
        $_SESSION['message'] = 'Please enter a valid quantity.';
    }

    header('Location: products.php');
    exit;
}
?>

<div class="container">
    <h2>Add Quantity to Product</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity to Add</label>
            <input type="number" name="quantity" class="form-control" id="quantity" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Quantity</button>
        <a href="products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>
