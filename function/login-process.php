<?php
session_start(); 
require("../database/connection.php");
require("../function/user-function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['uname'];
    $password = $_POST['psw'];
    if (!empty($user_name) && !empty($password)) {
        // Prepare the statement
        $query = "SELECT user_id, password FROM user_account WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "s", $user_name);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch the row
                $user_data = mysqli_fetch_assoc($result);

                // Use password_verify to check the hashed password
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id']; // Store user_id in session

                    // Show success alert
                    show_generic_message("Login successful. Redirecting...", "success");

                    // Redirect to the main webpage after a delay
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function() { window.location.href = "../shop/store.php"; }, 2000);';
                    echo '</script>';
                    die;
                } else {
                    // Incorrect password
                    show_generic_message("Login failed. Incorrect password.", "error");
                }
            } else {
                // No user found
                show_generic_message("Login failed. Please check your credentials.", "error");
            }
        } else {
            // Error preparing the statement
            show_generic_message("An error occurred. Please try again later.", "error");
        }
    }
}

?>