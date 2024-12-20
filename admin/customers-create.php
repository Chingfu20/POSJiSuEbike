<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Customer
                <a href="customers" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            
            <?php alertMessage(); ?>

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
                        <input type="number" name="phone" id="phone" class="form-control"  maxlength="11" />
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

<script>
    document.getElementById('phone').addEventListener('input', function (e) {
        let value = e.target.value;
        if (value.length > 11) {
            e.target.value = value.slice(0, 11);
        }
    });
</script>

<?php include('includes/footer.php'); ?>
