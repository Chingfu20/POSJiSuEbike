<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Products</h4>
            <div class="d-flex">
                <!-- Search Form -->
                <form method="GET" action="" class="d-flex me-3">
                    <input type="text" name="search" class="form-control" placeholder="Search product..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button type="submit" class="btn btn-secondary ms-2">Search</button>
                </form>
                <a href="products-create.php" class="btn btn-primary">Add Product</a>
            </div>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <?php
            // Initialize search term if provided
            $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

            // Fetch products with search functionality
            $query = "
                SELECT p.id, p.image, p.name, p.status, p.quantity
                FROM products p
            ";

            // Add search condition if search term is provided
            if ($searchTerm != '') {
                $query .= " WHERE p.name LIKE '%$searchTerm%' ";
            }

            // Order by product ID
            $query .= " ORDER BY p.id";

            $products = mysqli_query($conn, $query);

            if (!$products) {
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            if (mysqli_num_rows($products) > 0) {
            ?>  
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th> <!-- Display ID column -->
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Quantity</th> <!-- Changed header text -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $displayId = 1; // Initialize display ID
                            foreach($products as $item) : ?>
                            <tr>
                                <td><?= $displayId++ ?></td> <!-- Display ID -->
                                <td>
                                    <img src="../<?= htmlspecialchars($item['image']); ?>" style="width:50px;height:50px;" alt="Img" />
                                </td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td>
                                    <?php
                                    if($item['status'] == 1){
                                        echo '<span class="badge bg-danger">Hidden</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Visible</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><?= htmlspecialchars($item['quantity']) ?></td> <!-- Changed field name -->
                                <td>
                                    <a href="products-edit.php?id=<?= urlencode($item['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="products-delete.php?id=<?= urlencode($item['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="products-view.php?id=<?= urlencode($item['id']); ?>" class="btn btn-info btn-sm">View</a>
                                    <button class="btn btn-warning btn-sm add-quantity-btn" data-id="<?= $item['id']; ?>">+</button>
                                    </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                ?>
                    <h4 class="mb-0">No Record Found</h4>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When the "+" button is clicked
    $('.add-quantity-btn').click(function() {
        var productId = $(this).data('id');
        var button = $(this);

        // Perform AJAX request to add quantity
        $.ajax({
            url: 'add-quantity.php',
            method: 'POST',
            data: { id: productId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Quantity updated successfully! New quantity: ' + response.new_quantity);
                    // Optionally, you can refresh the page or update the quantity field in the table
                    location.reload(); // Refresh the page
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Failed to update quantity');
            }
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
