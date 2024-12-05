<?php 
function setFlashMessage($type, $message) {
    $_SESSION['sweet_alert'] = [
        'type' => $type,
        'message' => $message
    ];
}

require 'config/function.php';

if(isset($_SESSION['loggedIn'])){

    logoutSession();
    setFlashMessage('success', 'Logout Successfully, ' . $row['name'] . '!');
    redirect('login.php','Logged Out Successfully.');
}

?>
