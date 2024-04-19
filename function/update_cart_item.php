<?php

session_start();
require_once "../database/connection.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

       
        if (!$user_id) {
            http_response_code(401); // Unauthorized
            echo "You need to log in to update items in your cart. ";
            exit;
        }

        
        $query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $user_id, $product_id);
            if (mysqli_stmt_execute($stmt)) {
                
                http_response_code(200); // OK

                // for debug
                // echo "Cart dets $quantity productid:$product_id";
            } else {
             
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
        http_response_code(400); // Bad Request
        echo "Product ID and quantity are required.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}


?>