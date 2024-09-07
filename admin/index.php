<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
            font-family: Arial, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: var(--background-dark);
            color: var(--color-dark);
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .dark-mode .card {
            background-color: #495057;
            border-color: #6c757d;
        }

        .card-header {
            background-color: var(--primary-color-light);
            color: white;
            padding: 12px;
            font-size: 1.25rem;
        }

        .dark-mode .card-header {
            background-color: var(--primary-color-dark);
        }

        .card-body {
            padding: 15px;
        }

        .chart-container {
            height: 200px;
            width: 100%;
        }

        .chart-container canvas {
            max-width: 100%;
            height: auto !important;
        }

        .toggle-container {
            margin: 10px 0;
        }

        .toggle-switch {
            display: inline-block;
            width: 60px;
            height: 30px;
            position: relative;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
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
        }

        input:checked + .slider {
            background-color: var(--primary-color-dark);
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        footer {
            margin-top: 20px;
            background-color: var(--background-light);
            color: var(--color-light);
            padding: 10px;
            text-align: center;
        }

        body.dark-mode footer {
            background-color: #1f1f1f;
            color: var(--color-dark);
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="container-fluid">
    <h1 class="mt-4"></h1>

    <?php alertMessage(); ?>

    <div class="container-fluid">
    <h1 class="mt-4"></h1>

    <!-- Row for Total Categories, Total Products, Total Customers, and Today's Orders -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list-alt"></i> Total Categories
            </div>
            <div class="card-body">
                <h3 id="categoryText"><i class="fas fa-list-alt"></i></h3> <!-- Category count will be shown here -->
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-boxes"></i> Total Products
            </div>
            <div class="card-body">
                <h3 id="productText"></h3> <!-- Product count will be shown here -->
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users"></i> Total Customers
            </div>
            <div class="card-body">
                <h3 id="customerText"></h3> <!-- Customer count will be shown here -->
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i> Today's Orders
            </div>
            <div class="card-body">
                <h3 id="todayOrdersText"></h3> <!-- Today's orders count will be shown here -->
            </div>
        </div>
    </div>
</div>


    <!-- Row for Monthly Sales Report and Total Orders -->
    <div class="row">
    <!-- Left Column: Monthly Sales Report -->
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">Monthly Sales Report</div>
            <div class="card-body">
                <!-- Chart for sales -->
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   var ctx = document.getElementById('totalOrdersChart').getContext('2d');
   var totalOrdersChart = new Chart(ctx, {
       type: 'pie',  // Change type to 'bar', 'line' if you need different visualization
       data: {
           labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], // Months
           datasets: [{
               label: 'Total Orders',
               data: [120, 150, 170, 140, 190, 210, 180, 230, 200, 250, 240, 300], // Sample order data
               backgroundColor: [
                   'rgba(255, 99, 132, 0.2)',
                   'rgba(54, 162, 235, 0.2)',
                   'rgba(255, 206, 86, 0.2)',
                   'rgba(75, 192, 192, 0.2)',
                   'rgba(153, 102, 255, 0.2)',
                   'rgba(255, 159, 64, 0.2)',
                   'rgba(255, 99, 132, 0.2)',
                   'rgba(54, 162, 235, 0.2)',
                   'rgba(255, 206, 86, 0.2)',
                   'rgba(75, 192, 192, 0.2)',
                   'rgba(153, 102, 255, 0.2)',
                   'rgba(255, 159, 64, 0.2)'
               ],
               borderColor: [
                   'rgba(255, 99, 132, 1)',
                   'rgba(54, 162, 235, 1)',
                   'rgba(255, 206, 86, 1)',
                   'rgba(75, 192, 192, 1)',
                   'rgba(153, 102, 255, 1)',
                   'rgba(255, 159, 64, 1)',
                   'rgba(255, 99, 132, 1)',
                   'rgba(54, 162, 235, 1)',
                   'rgba(255, 206, 86, 1)',
                   'rgba(75, 192, 192, 1)',
                   'rgba(153, 102, 255, 1)',
                   'rgba(255, 159, 64, 1)'
               ],
               borderWidth: 1
           }]
       },
       options: {
           responsive: true,
           plugins: {
               legend: {
                   position: 'top',
               },
               title: {
                   display: true,
                   text: 'Total Orders per Month'
               }
           }
       }
   });
</script>



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
        // Get the values from hidden inputs
        const categoryCount = document.getElementById("categoryCount").value;
        const productCount = document.getElementById("productCount").value;
        const customerCount = document.getElementById("customerCount").value;
        const salesAmount = document.getElementById("salesAmount").value;
        const todayOrders = document.getElementById("todayOrders").value;
        const totalOrders = document.getElementById("totalOrders").value;

        // Display the numbers for Total Categories, Total Products, Total Customers, and Today's Orders
        document.getElementById('categoryText').innerHTML = categoryCount;
        document.getElementById('productText').innerHTML = productCount;
        document.getElementById('customerText').innerHTML = customerCount;
        document.getElementById('todayOrdersText').innerHTML = todayOrders;

        // Create a bar chart for Monthly Sales Report
        const createBarChart = (context, label, data, bgColor, brColor) => {
            new Chart(context, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: label,
                        data: data, // Array of data for each month
                        backgroundColor: bgColor,
                        borderColor: brColor,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#f8f9fa',
                            titleColor: '#343a40',
                            bodyColor: '#343a40',
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 16,
                                    family: "'Comic Sans MS', 'Cursive'"
                                },
                                color: '#495057'
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 16,
                                    family: "'Comic Sans MS', 'Cursive'"
                                },
                                color: '#495057'
                            },
                            beginAtZero: true // Ensure the y-axis starts at 0
                        }
                    }
                }
            });
        };

        // Sample sales data for each month (you can replace this with dynamic data)
        createBarChart(
            document.getElementById("salesChart"),
            "Sales (Total)",
            [12000, 15000, 13000, 17000, 14000, 16000, 18000, 19000, 17000, 21000, 22000, 24000], // Sample data
            'rgba(54, 162, 235, 0.7)',  // Bar fill color
            'rgba(54, 162, 235, 1)'     // Bar border color
        );

        // Create a pie chart for Total Orders
        const createPieChart = (context, label, data) => {
            new Chart(context, {
                type: 'pie',
                data: {
                    labels: ['Orders'],
                    datasets: [{
                        label: label,
                        data: [data],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',  // Red
                            'rgba(54, 162, 235, 0.6)',  // Blue
                            'rgba(255, 206, 86, 0.6)',  // Yellow
                            'rgba(75, 192, 192, 0.6)'   // Green
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true },
                        tooltip: {
                            backgroundColor: '#f8f9fa',
                            titleColor: '#343a40',
                            bodyColor: '#343a40',
                        }
                    }
                }
            });
        };

        // Create Pie Chart for Total Orders
        createPieChart(document.getElementById("totalOrdersChart"), "Total Orders", totalOrders);

        // Sample data: number of orders per month
        const monthlyOrders = {
            January: 300,
            February: 250,
            March: 200,
            April: 180,
            May: 220,
            June: 210,
            July: 190,
            August: 240,
            September: 290,  // Calculating for September
            October: 320,
            November: 350,
            December: 370
        };

        // Function to calculate total orders for a specific month
        const calculateMonthlyOrders = (month) => {
            return monthlyOrders[month] || 0; // Return 0 if no orders in that month
        };

        // Calculate total orders for September
        const totalSeptemberOrders = calculateMonthlyOrders("September");
        console.log("Total orders for September:", totalSeptemberOrders); // Should output 290

        // Display September's total orders on the page (optional)
        document.getElementById('septemberOrdersText').innerHTML = `Total September Orders: ${totalSeptemberOrders}`;

        // Display chart for monthly orders using actual data
        createBarChart(
            document.getElementById("salesChart"),
            "Total Orders",
            Object.values(monthlyOrders), // Orders data for each month
            'rgba(54, 162, 235, 0.7)',  // Bar fill color
            'rgba(54, 162, 235, 1)'     // Bar border color
        );
    });
</script>
