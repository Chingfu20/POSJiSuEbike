<?php
// Your login logic here...

if ($login_successful) {
    header('Location: login.php?alert=success');
    exit();
} else {
    header('Location: login.php?alert=error');
    exit();
}
?>
