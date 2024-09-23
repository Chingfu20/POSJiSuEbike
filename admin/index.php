<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background-light: #f8f9fa;
            --color-light: #343a40;
            --primary-color-light: #007bff;
            --background-dark: #343a40;
            --color-dark: #f8f9fa;
            --primary-color-dark: #17a2b8;
        }

        body {
            background-color: var(--background-light);
            color: var(--color-light);
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: var(--background-dark);
            color: var(--color-dark);
        }

        .card {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            border: none;
            border-radius: 12px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .dark-mode .card {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            color: #fff;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
        }

        .card-header {
            background-color: transparent;
            color: white;
            padding: 12px;
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-body h3 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
        }

        .chart-container {
            height: 200px;
            width: 100%;
        }

        .toggle-switch {
            display: inline-block;
            width: 60px;
            height: 30px;
            position: relative;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #adb5bd;
            transition: .4s;
            border-radius: 15px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked + .slider {
            background-color: #17a2b8;
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        footer {
            background: linear-gradient(135deg, #007bff 0%, #17a2b8 100%);
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top: 2px solid #17a2b8;
        }

        body.dark-mode footer {
            background: linear-gradient(135deg, #1f1f1f 0%, #343a40 100%);
            color: #ccc;
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="container-fluid">
    <h1 class="mt-4"></h1>

    <?php alertMessage(); ?>

    <!-- Row for Total Categories, Total Products, Total Customers, and Today's Orders -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-list-alt"></i> Total Categories
                </div>
                <div class="card-body">
                    <h3 id="categoryText">1</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-boxes"></i> Total Products
                </div>
                <div class="card-body">
                    <h3 id="productText"></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i> Total Customers
                </div>
                <div class="card-body">
                    <h3 id="customerText"></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-shopping-cart"></i> Today's Orders
                </div>
                <div class="card-body">
                    <h3 id="todayOrdersText"></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Monthly Sales Report and Total Orders -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">Monthly Sales Report</div>
                <div class="card-body">
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-receipt"></i> Total Orders
                </div>
                <div class="card-body">
                    <h3 id="totalOrdersText"></h3>
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

        document.getElementById('categoryText').innerHTML = categoryCount;
        document.getElementById('productText').innerHTML = productCount;
        document.getElementById('customerText').innerHTML = customerCount;
        document.getElementById('totalOrdersText').innerHTML = totalOrders;
        document.getElementById('todayOrdersText').innerHTML = todayOrders;

        // Monthly Sales Report Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sales',
                    data: [12, 19, 3, 5, 2, 3], // Replace with actual sales data
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgba(54, 162, 235, 1)',
                        }
                    }
                }
            }
        });

        // Dark Mode Toggle
        const toggleSwitch = document.getElementById('theme-toggle');
        toggleSwitch.addEventListener('change', function () {
            document.body.classList.toggle('dark-mode');
        });
    });
</script>
</body>
</html>
