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
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $displayId = 1;
                            foreach($products as $item) : ?>
                            <tr>
                                <td><?= $displayId++ ?></td>
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
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger btn-minus" data-id="<?= htmlspecialchars($item['id']); ?>">-</button>
                                    <span class="quantity"><?= htmlspecialchars($item['quantity']); ?></span>
                                    <button class="btn btn-sm btn-success btn-plus" data-id="<?= htmlspecialchars($item['id']); ?>">+</button>
                                </td>
                                <td>
                                    <a href="products-edit.php?id=<?= urlencode($item['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="products-delete.php?id=<?= urlencode($item['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="products-view.php?id=<?= urlencode($item['id']); ?>" class="btn btn-info btn-sm">View</a>
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

<?php include('includes/footer.php'); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Increase quantity
        $(".btn-plus").click(function () {
            var productId = $(this).data('id');
            updateQuantity(productId, 'increase');
        });

        // Decrease quantity
        $(".btn-minus").click(function () {
            var productId = $(this).data('id');
            updateQuantity(productId, 'decrease');
        });

        function updateQuantity(productId, action) {
            $.ajax({
                url: "update-quantity.php",  // Backend script to handle quantity update
                type: "POST",
                data: { id: productId, action: action },
                success: function (response) {
                    if (response.success) {
                        // Update the quantity displayed
                        $("button[data-id='" + productId + "']").siblings('.quantity').text(response.new_quantity);

                        // SweetAlert for success message
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        // SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                }
            });
        }
    });
</script>
