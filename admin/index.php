<?php
include ('../config/dbcon.php');

// Function to safely get count from a table
function getCount($table) {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM $table";
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    return 0;
}

// Fetch total products
$products = getCount('products');

// Fetch total orders
$totalOrders = getCount('orders');

// Fetch today's orders
$today = date('Y-m-d');
$sqlToday = "SELECT COUNT(*) AS total FROM orders WHERE order_date = ?";
$stmtToday = $conn->prepare($sqlToday);
$stmtToday->bind_param("s", $today);
$stmtToday->execute();
$resultToday = $stmtToday->get_result();
$todayOrders = 0;

if ($resultToday) {
    $row = $resultToday->fetch_assoc();
    $todayOrders = $row['total'];
}
$stmtToday->close();

// Fetch monthly sales data
$salesData = [];
for ($i = 1; $i <= 12; $i++) {
    $startDate = date("Y-$i-01");
    $endDate = date("Y-$i-t");
    
    $query = "SELECT COALESCE(SUM(total_amount), 0) AS monthly_sales 
              FROM orders 
              WHERE order_date BETWEEN ? AND ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();
    $salesData[] = number_format($row['monthly_sales'], 2, '.', '');
    $stmt->close();
}

// Fetch monthly customers
$monthlyCustomers = [];
for ($i = 1; $i <= 12; $i++) {
    $startDate = date("Y-$i-01");
    $endDate = date("Y-$i-t");
    
    $query = "SELECT COUNT(*) AS monthly_customers 
              FROM customers 
              WHERE created_at BETWEEN ? AND ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();
    $monthlyCustomers[] = $row['monthly_customers'];
    $stmt->close();
}

// Total sales
$totalSalesQuery = "SELECT COALESCE(SUM(total_amount), 0) AS total_sales FROM orders";
$totalSalesResult = $conn->query($totalSalesQuery);
$totalSales = $totalSalesResult ? $totalSalesResult->fetch_assoc()['total_sales'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike Dashboard</title>
    
    <!-- Bootstrap and Chart.js CDN links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Your existing CSS styles here */
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Dashboard Cards -->
            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #D3E5E2;">
                    <div class="card-header" style="background-color: #28a745; color: white;">
                        <i class="fas fa-list-alt"></i> Total Categories
                    </div>
                    <div class="card-body text-center">
                        <h3 id="categoryText"><?= getCount('categories') ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #FCE6B2;">
                    <div class="card-header" style="background-color: #ffc107; color: white;">
                        <i class="fas fa-boxes"></i> Total Products
                    </div>
                    <div class="card-body text-center">
                        <h3 id="productText"><?= $products ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #B3E5D6;"> 
                    <div class="card-header" style="background-color: #17a2b8; color: white;">
                        <i class="fas fa-receipt"></i> Total Orders
                    </div>
                    <div class="card-body text-center">
                        <h3 id="totalOrdersText"><?= $totalOrders ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #C8E6F5;"> 
                    <div class="card-header" style="background-color: #007bff; color: white;">
                        <i class="fas fa-shopping-cart"></i> Today's Orders
                    </div>
                    <div class="card-body text-center">
                        <h3 id="todayOrdersText"><?= $todayOrders ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card" style="background-color: #e2e3e5;">
                    <div class="card-header" style="background-color: #6c757d; color: white;">
                        Monthly Sales Report
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3"> 
                <div class="card" style="background-color: #B3E5D6;">
                    <div class="card-header" style="background-color: #17a2b8; color: white;">
                        <i class="fas fa-users"></i> Monthly Customers
                    </div>
                    <div class="card-body">
                        <canvas id="customersChart" style="max-width: 500px; max-height: 300px; width: 100%; height: auto;"></canvas> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Monthly Sales Chart
        const monthlySales = <?= json_encode($salesData) ?>;
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Sales (₱)',
                    data: monthlySales, 
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
                                return '₱' + value; 
                            }
                        }
                    }
                }
            }
        });

        // Monthly Customers Chart
        const monthlyCustomers = <?= json_encode($monthlyCustomers) ?>;
        const ctxCustomers = document.getElementById('customersChart').getContext('2d');
        new Chart(ctxCustomers, {
            type: 'pie',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Customers',
                    data: monthlyCustomers,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', 
                        '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                        '#9966FF', '#FF9F40'
                    ]
                }]
            }
        });
    });
    </script>
</body>
</html>