<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<div id="layoutSidenav_nav"> 
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">JISU</div>

                <a class="nav-link <?= $page == 'index' ? 'active' : ''; ?>" href="index">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= $page == 'order-create.php' ? 'active' : ''; ?>" href="order-create">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Create Order
                </a>

                <a class="nav-link <?= $page == 'orders.php' ? 'active' : ''; ?>" href="orders">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <!-- Categories Section with Dropdown Icon -->
                <a class="nav-link <?= ($page == 'categories-create.php') || ($page == 'categories.php') ? 'collapse active' : 'collapsed'; ?>" 
                   href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" 
                   aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'categories-create.php' || $page == 'categories.php') ? 'show' : ''; ?>" 
                     id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'categories-create.php' ? 'active' : ''; ?>" href="categories-create">Create Category</a>
                        <a class="nav-link <?= $page == 'categories.php' ? 'active' : ''; ?>" href="categories">View Categories</a>
                    </nav>
                </div>

                <!-- Products Section with Dropdown Icon -->
                <a class="nav-link <?= ($page == 'products-create.php') || ($page == 'products.php') ? 'collapse active' : 'collapsed'; ?>" 
                   href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" 
                   aria-expanded="false" aria-controls="collapseProduct">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'products-create.php' || $page == 'products.php') ? 'show' : ''; ?>" 
                     id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'products-create.php' ? 'active' : ''; ?>" href="products-create">Create Product</a>
                        <a class="nav-link <?= $page == 'products.php' ? 'active' : ''; ?>" href="products">View Products</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Users</div>

                <!-- Customer Section with Dropdown Icon -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer" 
                   aria-expanded="false" aria-controls="collapseCustomer">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Customer
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'customers-create.php' || $page == 'customers.php') ? 'show' : ''; ?>" 
                     id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'customers-create.php' ? 'active' : ''; ?>" href="customers-create">Add Customer</a>
                        <a class="nav-link <?= $page == 'customers.php' ? 'active' : ''; ?>" href="customers">View Customers</a>
                    </nav>
                </div>

                <!-- Admin Section with Dropdown Icon -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" 
                   aria-expanded="false" aria-controls="collapseAdmins">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Admin
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= ($page == 'admins-create.php' || $page == 'admins.php') ? 'show' : ''; ?>" 
                     id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'admins-create.php' ? 'active' : ''; ?>" href="admins-create">Add Admin</a>
                        <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins">View Admins</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small"></div>
        </div>
    </nav>
</div>
