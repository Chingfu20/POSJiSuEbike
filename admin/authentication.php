<?php

session_start(); // Ensure session is started

// Assuming $conn is your database connection

if (isset($_SESSION['loggedInUser'])) {
    $email = validate($_SESSION['loggedInUser']['email']); // Fix the typo 'loggedInUSer' to 'loggedInUser'

    $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        logoutSession();
        redirect('../login.php', 'Access Denied!');
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['is_ban'] == 1) {
            logoutSession();
            redirect('../login.php', 'Your account has been banned! Please contact admin.');
        }
        // Additional login validation can go here if needed
    }
} else {
    redirect('../login.php', 'Login to Continue...');
}

?>
