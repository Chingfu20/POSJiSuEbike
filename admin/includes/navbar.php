<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu E-Bike POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Apply background color to the body and navbar */
        body, .sb-topnav.navbar {
            background-color: #000000; /* Black background */
            color: #90e0ef; /* Text color for readability */
        }

        /* Style for the sidebar */
        .sb-sidenav {
            background-color: #1a1a1a; /* Slightly lighter black for sidebar */
        }

        /* Style for the footer */
        .sb-sidenav-footer {
            background-color: #333333; /* Footer background color, dark grey */
            color: #caf0f8; /* Light text color */
        }

        /* Active links in the sidebar */
        .sb-sidenav .nav-link.active {
            background-color: #00b4d8; /* Active link background color */
            color: #ffffff; /* Active link text color */
        }

        /* Collapsed icon color */
        .sb-sidenav .sb-sidenav-collapse-arrow {
            color: #48cae4; /* Color for the arrow icons */
        }

        /* Adjust text color in the nav */
        .navbar .navbar-brand, .navbar .nav-link, .dropdown-item {
            color: #ade8f4; /* Navbar brand and item color */
        }

        /* Dropdown hover */
        .dropdown-item:hover {
            background-color: #00b4d8;
            color: #ffffff;
        }

        /* SweetAlert button color customization */
        .swal2-confirm {
            background-color: #48cae4 !important;
            border: none;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">JiSu Ebike
            <img src="assets/img/logo.fb51b8e1.png" alt="Brand Icon" style="height: 30px;">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        
        <!-- Navbar Search (hidden for now) -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!-- Search form can be re-enabled here if needed -->
        </form>
        
        <!--Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" id="logoutButton" href="#">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- SweetAlert Logout Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'No, stay logged in'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../login.php';
                }
            });
        });
    </script>
</body>
</html>
