<?php
session_start();

// Validate CSRF token
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Clear session variables
    $_SESSION = array();


    session_destroy();

    
    header("Location: ../shop/store.php");
    exit();
} else {
    // Invalid CSRF token, handle error or redirect
    header("Location: ../shop/store.php");
    exit("Invalid CSRF token");
}

?>
