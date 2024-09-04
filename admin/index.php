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
    <h1 class="mt-4">Dashboard</h1>

    <div class="row">
        <!-- Summary Cards -->
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>10</h5>
                    <p>Total Categories</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>200</h5>
                    <p>Total Products</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>1500</h5>
                    <p>Total Customers</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>25</h5>
                    <p>Today's Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>120</h5>
                    <p>Total Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>$3000</h5>
                    <p>Monthly Sales Report</p>
                </div>
            </div>
        </div>

        <!-- Monthly Sales Line Chart -->
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header">Monthly Sales Report</div>
                <div class="card-body chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Orders Pie Chart -->
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">Orders Distribution</div>
                <div class="card-body chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Line Chart for Monthly Sales Report
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales in $',
                    data: [500, 700, 600, 800], // Replace with your data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart for Orders Distribution
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Pending', 'Cancelled'],
                datasets: [{
                    data: [100, 15, 5], // Replace with your data
                    backgroundColor: ['#4CAF50', '#FFC107', '#FF5722'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    });
</script>
</body>
</html>
