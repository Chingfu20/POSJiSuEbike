<?php
// auth_middleware.php - Place this file in your includes folder
session_start();

function checkAuthenticatedUser()
{
    // Check if user is not logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        // Store the current URL they were trying to access
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        
        // Set warning message
        $_SESSION['sweet_alert'] = [
            'type' => 'warning',
            'message' => 'Please login to access this page'
        ];
        
        // Redirect to login page
        header("Location: /login.php");
        exit();
    }
}

function checkLoggedInRedirect()
{
    // If user is already logged in and tries to access login page
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
        // Set success message
        $_SESSION['sweet_alert'] = [
            'type' => 'info',
            'message' => 'You are already logged in'
        ];
        
        // Redirect to admin dashboard
        header("Location: /admin/index.php");
        exit();
    }
}

// Function to handle logout
function logout()
{
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Set success message
    session_start();
    $_SESSION['sweet_alert'] = [
        'type' => 'success',
        'message' => 'Logged out successfully'
    ];
    
    // Redirect to login page
    header("Location: /login.php");
    exit();
}