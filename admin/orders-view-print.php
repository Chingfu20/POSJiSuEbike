<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
          <div class="card-header">
               <h4 class="mb-0">Print Order
                <a href="orders.php" class="btn btn-danger btn-sm float-end">Back</a>
               </h4>
          </div>
          <div class="card-body">

          <div id="myBillingArea">

            <?php
                if(isset($_GET['track']))
                {
                    $trackingNo = validate($_GET['track']);
                     if($trackingNo == ''){
                        ?>
                 <div class="text-center pyp-5">
                    <h5>Please prodive Tracking Number</h5>
                    <div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                    </div>
                 </div>
                 <?php
                }

                $orderQuery = "SELECT o.*, c.* FROM orders o, customers c 
                    WHERE c.id=o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
                $orderQueryRes = mysqli_query($conn, $orderQuery);

                if(!$orderQueryRes){
                    echo "<h5>Something Went Wrong</h5>";
                    return false;
                }

                if(mysqli_num_rows($orderQueryRes) > 0)
                {
                    $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                  //  print_r($orderDataRow);
                    ?>
                  <table style="width: 100%; margin-bottom: 20px;">
    <tbody>
        <tr>
            <td style="text-align: center;" colspan="2">
                <h4 style="font-size: 23px; line-height: 30px; margin: 2px; padding: 0; display: inline;">Ji Su E-Bike POS</h4>
                <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">Located at Campo, Bantigue, Bantayan Island, Cebu</p>
                <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">Customer Service: 0923-377-4667</p>
                <img src="assets/img/logo.fb51b8e1.png" alt="Ji Su E-Bike Logo" style="vertical-align: middle; width: 130px; height: auto; margin-top: 10px;">
            </td>
        </tr>
        <tr>
            <td>
        <br>
        <br>
        <br>
        <br>

                <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;">Customer Details</h5>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Name: <?= $orderDataRow['name'] ?></p>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Phone No.: <?= $orderDataRow['phone'] ?></p>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Email: <?= $orderDataRow['email'] ?></p>
            </td>
            <td align="end">
        <br>
        <br>
        <br>
        <br>

                <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;">Invoice Details</h5>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Invoice No.: <?= $orderDataRow['invoice_no']; ?></p>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Invoice Date: <?= date('d M Y'); ?></p>
                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Address: Campo, Bantigue, Bantayan Island, Cebu</p>
            </td>
        </tr>
    </tbody>
</table>


                    <?php
                }
                else
                {
                    echo "<h5>No data found</h5>";
                    return false;
                }

                $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* 
                    FROM orders o, order_items oi, products p 
                    WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$trackingNo' ";

                    $orderItemQueryRes = mysqli_query($conn, $orderItemQuery);
                    if($orderItemQueryRes)
                    {
                        if(mysqli_num_rows($orderItemQueryRes) > 0)
                        {
                            ?>
                              <div class="table-responsive mb-3">
                                 <table style="width:100%;" cellpadding="5">
                                   <thead>
                                      <tr>
                                          <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                          <th align="start" style="border-bottom: 1px solid #ccc;">Unit Name</th>
                                          <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                                          <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                          <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                     </tr>
                                </thead>
                                <tbody>
                                  <?php
                                        $i = 1;
                                        foreach($orderItemQueryRes as $key => $row) :
                                   ?>
                                   <tr>
                                          <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                          <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                          <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['orderItemPrice'], 0) ?></td>
                                          <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity'] ?></td>
                                          <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                            <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                    <tr>
                                          <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                          <td colspan="1" style="font-weight: bold;"><?= number_format($row['total_amount'], 0); ?></td>
                                   </tr>
                                    <tr>
                                    <td colspan="4" align="end" style="font-weight: bold;">Amount:</td>
                                    <td colspan="1" style="font-weight: bold;">   <?= isset($_SESSION['amountPaid']) ? number_format($_SESSION['amountPaid'], 0) : '0'; ?></td>
                                    </tr>
                                    <tr>
                                    <td colspan="4" align="end" style="font-weight: bold;">Change:</td>
                                    <td colspan="1" style="font-weight: bold;">
                                     <?= isset($_SESSION['changeAmount']) ? number_format(floatval(str_replace(',', '', $_SESSION['changeAmount'])), 0) : '0'; ?>
                                    </td>
                                    </tr>
                                    
                                   <tr>
                                   <td colspan="5">Payment Mode: <?= $row['payment_mode'];?></td>
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                            <?php
                        }
                        else
                        {
                            echo "<h5>No data found</h5>";
                            return false;
                        }
                    }
                    else
                    {
                        echo "<h5>Something Went Wrong!</h5>";
                        return false;
                    }
                }
                else
                {
                    ?>
                    <div class="text-center pyp-5">
                    <h5>No Tracking Number Parameter Found</h5>
                    <div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                    </div>
                </div>
                    <?php
                }
              ?>
             </div>

             <div class="mt-4 text-end">
                <button class="btn btn-info px-4 mx-1" onclick="printMyBillingArea()">Print</button>
                <button class="btn btn-warning px-4 mx-1" onclick="downloadPDF('<?= $orderDataRow['invoice_no']; ?>')">Download PDF</button>
             </div>
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
     </script>
<?php include('includes/footer.php'); ?>
