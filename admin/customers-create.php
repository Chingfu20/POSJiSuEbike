<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Customer
                <a href="customers.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            
            <?php
            session_start();
            if (isset($_SESSION['success'])) {
                echo '<script>
                        swal("Success!", "' . $_SESSION['success'] . '", "success");
                      </script>';
                unset($_SESSION['success']);
            } elseif (isset($_SESSION['error'])) {
                echo '<script>
                        swal("Error!", "' . $_SESSION['error'] . '", "error");
                      </script>';
                unset($_SESSION['error']);
            }
            ?>

            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Email Id</label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <br/>
                        <button type="submit" name="saveCustomer" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
