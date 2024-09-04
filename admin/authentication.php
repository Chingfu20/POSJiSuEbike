<?php
session_start(); // Ensure sessions are started

// Database connection (replace with your connection details)
$conn = mysqli_connect("hostname", "username", "password", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Make sure validate function exists and works
function validate($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Redirect function
function redirect($url, $message) {
    // For the sake of this example, we'll use a simple redirect with a message.
    // In practice, you may want to handle flash messages in a more robust way.
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit();
}

// Logout function
function logoutSession() {
    session_unset();
    session_destroy();
}

if (isset($_SESSION['loggedInUser'])) {
    $email = validate($_SESSION['loggedInUser']['email']);

    $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 0) {
        logoutSession();
        redirect('../login.php', 'Access Denied!');
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['is_ban'] == 1) {
            logoutSession();
            redirect('../login.php', 'Your account has been banned! Please contact admin.');
        }
    }
} else {
    redirect('../login.php', 'Login to Continue...');
}

// Close the connection
mysqli_close($conn);

?>
