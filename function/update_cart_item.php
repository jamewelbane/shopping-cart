<?php

session_start();
require_once "../database/connection.php";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the product ID and quantity are provided
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        // Sanitize the product ID and quantity
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if the user is logged in
        if (!$user_id) {
            // If user is not logged in, handle the case according to your application logic
            // For example, redirect to the login page or prompt the user to log in
            http_response_code(401); // Unauthorized
            echo "You need to log in to update items in your cart. ";
            exit;
        }

        // Prepare the SQL statement to update the cart item quantity
        $query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $product_id);
            if (mysqli_stmt_execute($stmt)) {
                // Cart item quantity updated successfully
                http_response_code(200); // OK

                // for debug
                // echo "Cart dets $quantity productid:$product_id";
            } else {
                // Error executing the statement
                http_response_code(500); // Internal Server Error
                echo "An error occurred while updating the cart item quantity.";
            }
            mysqli_stmt_close($stmt);
        } else {
            // Error preparing the statement
            http_response_code(500); // Internal Server Error
            echo "An error occurred while preparing the SQL statement.";
        }
    } else {
        // If the product ID or quantity is not provided, send an error response
        http_response_code(400); // Bad Request
        echo "Product ID and quantity are required.";
    }
} else {
    // If the request method is not POST, send an error response
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}


?>