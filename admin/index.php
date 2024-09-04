<div class="container-fluid">
    <h1 class="mt-4"></h1>

    <?php alertMessage(); ?>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Total Categories</div>
                <div class="card-body chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Total Products</div>
                <div class="card-body chart-container">
                    <canvas id="productChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Total Customers</div>
                <div class="card-body chart-container">
                    <canvas id="customerChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Monthly Sales Report</div>
                <div class="card-body chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Today's Orders</div>
                <div class="card-body chart-container">
                    <canvas id="todayOrdersChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Total Orders</div>
                <div class="card-body chart-container">
                    <canvas id="totalOrdersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="categoryCount" value="<?= getCount('categories'); ?>">
<input type="hidden" id="productCount" value="<?= getCount('products'); ?>">
<input type="hidden" id="customerCount" value="<?= getCount('customers'); ?>">
<input type="hidden" id="salesAmount" value="<?php
    $totalSales = mysqli_query($conn, "SELECT SUM(total_amount) AS total_sales FROM orders");
    echo $totalSales ? mysqli_fetch_assoc($totalSales)['total_sales'] : 0.00;
?>">
<input type="hidden" id="todayOrders" value="<?php
    $todayDate = date('Y-m-d');
    $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate'");
    echo $todayOrders ? mysqli_num_rows($todayOrders) : 0;
?>">
<input type="hidden" id="totalOrders" value="<?= getCount('orders'); ?>">

<?php include('includes/footer.php'); ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryCount = document.getElementById("categoryCount").value;
        const productCount = document.getElementById("productCount").value;
        const customerCount = document.getElementById("customerCount").value;
        const salesAmount = document.getElementById("salesAmount").value;
        const todayOrders = document.getElementById("todayOrders").value;
        const totalOrders = document.getElementById("totalOrders").value;

        const commonOptions = {
            type: 'bar',
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        };

        const createChart = (context, label, data, bgColor, brColor) => {
            new Chart(context, {
                ...commonOptions,
                data: {
                    labels: [label],
                    datasets: [{
                        data: [data],
                        backgroundColor: bgColor,
                        borderColor: brColor,
                        borderWidth: 1
                    }]
                }
            });
        };

        createChart(document.getElementById("categoryChart"), "Categories", categoryCount, 'rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)');
        createChart(document.getElementById("productChart"), "Products", productCount, 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)');
        createChart(document.getElementById("customerChart"), "Customers", customerCount, 'rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)');
        createChart(document.getElementById("salesChart"), "Sales (Total)", salesAmount, 'rgba(75, 192, 192, 0.2)', 'rgba(75, 192, 192, 1)');
        createChart(document.getElementById("todayOrdersChart"), "Today's Orders", todayOrders, 'rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)');
        createChart(document.getElementById("totalOrdersChart"), "Total Orders", totalOrders, 'rgba(255, 0, 0, 0.2)', 'rgba(255, 0, 0, 1)');

    });
</script>
