<?php include('includes/header.php'); ?>

<div class="container">
    <?php 
        if(isset($_SESSION['status'])) {
            echo '<div class="alert alert-danger">'.$_SESSION['status'].'</div>';
            unset($_SESSION['status']);
        }
    ?>
    
    <?php
        // Fetch failed attempts for the logged-in user (before showing the login form)
        $email = $_POST['email'] ?? ''; // Use the posted email, if exists
        $query = "SELECT failed_attempts FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $admin = mysqli_fetch_assoc($result);
        
        // Only show the login form if failed attempts are less than 10
        if($admin['failed_attempts'] < 10) {
    ?>
    <form action="code.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php
        } else {
            echo '<p class="text-danger">Your account is locked due to too many failed login attempts. Please contact the administrator.</p>';
        }
    ?>
</div>

<?php include('includes/footer.php'); ?>
