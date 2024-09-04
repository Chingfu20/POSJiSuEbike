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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .stat-card h3 {
            margin: 10px 0;
            font-size: 24px;
        }

        .stat-card p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 id="studentCount">1217</h3>
                    <p>Students</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 id="teacherCount">42</h3>
                    <p>Teachers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 id="employeeCount">68</h3>
                    <p>Employees</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 id="earnings">$4500</h3>
                    <p>Earnings</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Earnings (past 12 months)</div>
                    <div class="card-body chart-container">
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Employees</div>
                    <div class="card-body chart-container">
                        <canvas id="employeesChart"></canvas>
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
            const earningsChart = document.getElementById("earningsChart").getContext('2d');
            const employeesChart = document.getElementById("employeesChart").getContext('2d');

            const earningsData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Earnings in $',
                    data: [1800, 2000, 2200, 2800, 2600, 2400, 2600, 2200, 2000, 2400, 2800, 3000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            };

            const employeesData = {
                labels: ['Academic', 'Non-academic', 'Administration', 'Others'],
                datasets: [{
                    data: [42, 15, 8, 3],
                    backgroundColor: ['#4caf50', '#2196f3', '#ffc107', '#ff5722'],
                    hoverBackgroundColor: ['#388e3c', '#1976d2', '#ffa000', '#e64a19']
                }]
            };

            new Chart(earningsChart, {
                type: 'line',
                data: earningsData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });

            new Chart(employeesChart, {
                type: 'doughnut',
                data: employeesData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
