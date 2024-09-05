<?php
require 'config/function.php';

if (isset($_SESSION['loggedIn'])) {
    logoutSession();
    redirect('login.php', 'Logged Out Successfully.');
} elseif (isset($_GET['login_success'])) {
    redirect('admin/index.php', 'Logged In Successfully');
} else {
    redirect('login.php', 'Please log in.');
}
?>
