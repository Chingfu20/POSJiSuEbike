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
        <div class="card" style="background-color: #D3E5E2;"> <!-- Softer green -->
            <div class="card-header" style="background-color: #28a745; color: white;">
                <i class="fas fa-list-alt"></i> Total Categories
            </div>
            <div class="card-body text-center">
                <h3 id="categoryText">
                    <i class="fas fa-list-alt"></i> 10 <!-- Example count with icon -->
                </h3> <!-- Category count will be shown here -->
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card" style="background-color: #FCE6B2;"> <!-- Soft beige -->
            <div class="card-header" style="background-color: #ffc107; color: white;">
                <i class="fas fa-boxes"></i> Total Products
            </div>
            <div class="card-body text-center">
                <h3 id="productText">
                    <i class="fas fa-boxes"></i> 25 <!-- Example count with icon -->
                </h3> <!-- Product count will be shown here -->
            </div>
        </div>
    </div>

    <!-- Right Column: Total Orders as Text -->
<div class="col-md-3 mb-3">
    <div class="card" style="background-color: #B3E5D6;"> <!-- Light teal -->
        <div class="card-header" style="background-color: #17a2b8; color: white;">
            <i class="fas fa-receipt"></i> Total Orders
        </div>
        <div class="card-body text-center">
            <h3 id="totalOrdersText">
                <i class="fas fa-receipt"></i> 30 <!-- Example count with icon -->
            </h3> <!-- Total Orders will be shown here -->
        </div>
    </div>
</div>


    <div class="col-md-3 mb-3">
        <div class="card" style="background-color: #C8E6F5;"> <!-- Light blue -->
            <div class="card-header" style="background-color: #007bff; color: white;">
                <i class="fas fa-shopping-cart"></i> Today's Orders
            </div>
            <div class="card-body text-center">
                <h3 id="todayOrdersText">
                    <i class="fas fa-shopping-cart"></i> 15 <!-- Example count with icon -->
                </h3> <!-- Today's orders count will be shown here -->
            </div>
        </div>
    </div>
</div>

<!-- Row for Monthly Sales Report and Total Orders -->
<div class="row">
    <!-- Left Column: Monthly Sales Report -->
    <div class="col-md-6 mb-3">
        <div class="card" style="background-color: #e2e3e5;">
            <div class="card-header" style="background-color: #6c757d; color: white;">
                Monthly Sales Report
            </div>
            <div class="card-body">
                <!-- Chart for sales -->
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <?php
// Database connection (assumed already established)
// Fetch total customers for each month from the database
$monthlyCustomers = [];
for ($i = 1; $i <= 12; $i++) {
    $startDate = date("Y-$i-01");
    $endDate = date("Y-$i-t");
    $result = mysqli_query($conn, "SELECT COUNT(*) AS monthly_customers FROM customers WHERE created_at BETWEEN '$startDate' AND '$endDate'"); // Adjust the date column name as needed
    $row = mysqli_fetch_assoc($result);
    
    $monthlyCustomers[] = $row['monthly_customers'] ? $row['monthly_customers'] : 0; // Count of customers for the month
}
?>

<div class="col-md-6 mb-3"> 
    <div class="card" style="background-color: #B3E5D6;">
        <div class="card-header" style="background-color: #17a2b8; color: white;">
            <i class="fas fa-users"></i> Total Customers
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <!-- Months list -->
            <ul id="monthsList" style="list-style-type: none; padding: 0; margin: 0;">
                <li>January</li>
                <li>February</li>
                <li>March</li>
                <li>April</li>
                <li>May</li>
                <li>June</li>
                <li>July</li>
                <li>August</li>
                <li>September</li>
                <li>October</li>
                <li>November</li>
                <li>December</li>
            </ul>
            <!-- Pie chart -->
            <canvas id="customersChart" style="max-width: 200px; max-height: 300px; width: 100%; height: auto;"></canvas> 
        </div>
    </div>
</div>

<script>
// JavaScript code for rendering the pie chart
document.addEventListener("DOMContentLoaded", function () {
    const monthlyCustomers = <?php echo json_encode($monthlyCustomers); ?>;

    // Pie Chart for Monthly Total Customers
    const ctxCustomers = document.getElementById('customersChart').getContext('2d');
    new Chart(ctxCustomers, {
        type: 'pie',
        data: {
            labels: [
            ],
            datasets: [{
                label: 'Monthly Total Customers',
                data: monthlyCustomers,  // Dynamic customer count data
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40',
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40'
                ],
                borderColor: 'rgba(255, 255, 255, 0.5)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#333' // Legend text color
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.raw !== null) {
                                label += context.raw; // Show the raw value in tooltips
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
});
</script>

<?php
// Fetch sales data for each month from the database
$salesData = [];
for ($i = 1; $i <= 12; $i++) {
    $startDate = date("Y-$i-01");
    $endDate = date("Y-$i-t");
    $result = mysqli_query($conn, "SELECT SUM(total_amount) AS monthly_sales FROM orders WHERE order_date BETWEEN '$startDate' AND '$endDate'");
    $row = mysqli_fetch_assoc($result);
    
    // Format sales amount in PHP currency format
    $salesData[] = $row['monthly_sales'] ? number_format($row['monthly_sales'], 2, '.', '') : 0.00;
}
?>

<script>
// Pass PHP sales data to JavaScript
document.addEventListener("DOMContentLoaded", function () {
    const monthlySales = <?php echo json_encode($salesData); ?>;

    // Monthly Sales Report Chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Monthly Sales',
                data: monthlySales,  // Use dynamic sales data
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value; // Add PHP symbol to y-axis labels
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgba(54, 162, 235, 1)',
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.raw !== null) {
                                label += '₱' + context.raw; // Add PHP symbol to tooltips
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
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

        // Display the numbers for Total Categories, Total Products, Total Customers, Today's Orders, and Total Orders
        document.getElementById('categoryText').innerHTML = categoryCount;
        document.getElementById('productText').innerHTML = productCount;
        document.getElementById('customerText').innerHTML = customerCount;
        document.getElementById('todayOrdersText').innerHTML = todayOrders;
        document.getElementById('totalOrdersText').innerHTML = totalOrders;

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
    });
</script>
