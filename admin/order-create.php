<?php include('includes/header.php'); ?>

<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label>Enter Customer Name</label>
            <input type="text" class="form-control" id="c_name" />
        </div>
        <div class="mb-3">
            <label for="c_phone">Enter Customer Phone No.</label>
            <input type="text" class="form-control" id="c_phone" pattern="\d{11}" maxlength="11" title="Enter an 11-digit phone number" />
      </div>
      <div class="mb-3">
        <label>Enter Customer Address</label>
        <textarea class="form-control" id="c_address" rows="3" placeholder="Enter full address" required></textarea>
    </div>
        <div class="mb-3">
            <label>Enter Customer Email (optional)</label>
            <input type="text" class="form-control" id="c_email" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Create Order
                <a href="orders" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="orders-code.php" method="POST">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Select Product *</label>
                        <select name="product_id" class="form-select mySelect2">
                            <option value="">-- Select Product --</option>
                            <?php
                            $products = getAll('products');
                            if ($products) {
                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $prodItem) {
                                        ?>
                                        <option value="<?= $prodItem['id']; ?>"><?= $prodItem['name']; ?></option>
                                        <?php
                                    }
                                } else {
                                    echo '<option value="">No Product found</option>';
                                }
                            } else {
                                echo '<option value="">Something Went Wrong</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" value="0" class="form-control" min="0" />
                    </div>
                    <div class="col-md-3 mb-3 text-end">
                        <br />
                        <button type="submit" name="addItem" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Products</h4>
        </div>
        <div class="card-body" id="productArea">
            <?php
            if (isset($_SESSION['productItems'])) 
            {
                $sessionProducts = $_SESSION['productItems'];
                if(empty($sessionProducts)){
                    unset($_SESSION['productItemIds']);
                    unset($_SESSION['productItems']);
                }
                
                ?>
                <div class="table-responsive mb-3" id="productContent">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
$i = 1;
foreach ($sessionProducts as $key => $item) :
    ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $item['name']; ?></td>
        <td><?= $item['price']; ?></td>
        <td><?= $item['quantity']; ?></td>
        <td class="totalPrice"><?= number_format($item['price'] * $item['quantity'], 2); ?></td>
        <td>
            <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger">
                Remove
            </a>
        </td>
    </tr>
<?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                
                <div class="mg-2">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Select Payment Mode</label>
                            <select id="payment_mode" class="form-select">
                                <option value="">-- Select Payment --</option>
                                <option value="Cash Payment">Cash Payment</option>
                            </select>
                    </div>
                        <div class="col-md-4">
                        <label for="cphone">Enter Customer Phone Number</label>
                        <input type="text" id="cphone" class="form-control" maxlength="11" pattern="\d{11}" title="Enter exactly 11 digits" />
                    </div>
                        <div class="col-md-4">
                        <label>Total Amount</label>
                        <input type="text" id="totalAmount" class="form-control" value="" readonly />
                    </div>
                    <div class="col-md-4">
                        <label>Enter asdAmount</label>
                        <input type="number" id="amountPaid" class="form-control" value="0" class="form-control" min="0" required/>
                    </div>
                    <div class="col-md-4">
                        <label>Change</label>
                        <input type="text" id="changeAmount" class="form-control" value="" readonly />
                    </div>
                    <div class="col-md-4">
                        <br/>
                        <button type="button" class="btn btn-warning w-100 proceedToPlace">Proceed to place order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <?php
            } else {
                echo '<h5>No Items added</h5>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('.totalPrice').forEach(cell => {
                totalAmount += parseFloat(cell.textContent.replace(/,/g, ''));
            });
            document.getElementById('totalAmount').value = totalAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            updateChange();
        }

        function updateChange() {
            const totalAmount = parseFloat(document.getElementById('totalAmount').value.replace(/,/g, ''));
            const amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;
            const change = amountPaid - totalAmount;
            document.getElementById('changeAmount').value = change > 0 ? change.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') : '0.00';
        }

        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', function () {
                const qtyInput = this.parentElement.querySelector('.quantityInput');
                let quantity = parseInt(qtyInput.value);
                if (quantity < 999) {
                    qtyInput.value = ++quantity;
                    updateTotalPrice(this);
                }
            });
        });

        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', function () {
                const qtyInput = this.parentElement.querySelector('.quantityInput');
                let quantity = parseInt(qtyInput.value);
                if (quantity > 1) {
                    qtyInput.value = --quantity;
                    updateTotalPrice(this);
                }
            });
        });

        document.getElementById('amountPaid').addEventListener('input', updateChange);

        function updateTotalPrice(element) {
            const row = element.closest('tr');
            const price = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace(/,/g, ''));
            const quantity = parseInt(row.querySelector('.quantityInput').value);
            const totalPriceCell = row.querySelector('.totalPrice');
            totalPriceCell.textContent = (price * quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            updateTotalAmount();
        }

        updateTotalAmount();
    });
    document.getElementById('c_phone').addEventListener('input', function () {
    var value = this.value;

    // Remove any non-numeric characters
    value = value.replace(/[^0-9]/g, '');

    // Ensure the value is no longer than 11 digits
    if (value.length > 11) {
        value = value.slice(0, 11);
    }

    this.value = value;

    // Disable further actions if the number is not exactly 11 digits
    if (value.length !== 11) {
        // Show an error message or disable form submission
        console.log("Invalid number: The phone number must be exactly 11 digits.");
    } else {
        // Valid number
        console.log("Valid number entered.");
    }
});

document.querySelector('.proceedToPlace').addEventListener('click', function () {
    const totalAmount = parseFloat(document.getElementById('totalAmount').value.replace(/,/g, ''));
    const amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;

    if (amountPaid < totalAmount) {
        // Show an error using SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Insufficient Payment',
            text: `Amount paid (${amountPaid.toFixed(2)}) is less than the total amount (${totalAmount.toFixed(2)}).`,
        });
        return; // Stop further processing
    }

    // Proceed with placing the order
    document.getElementById('orderForm').submit();
});
</script>

<?php include('includes/footer.php'); ?>
