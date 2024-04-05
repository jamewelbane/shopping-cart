<?php
session_start();

// Validate CSRF token
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Clear session variables
    $_SESSION = array();

    // Destroy session
    session_destroy();

    // Redirect to login page or home page
    header("Location: ../shop/store.php");
    exit();
} else {
    // Invalid CSRF token, handle error or redirect
    exit("Invalid CSRF token");
}

?>
