<?php
session_start();
require_once "../database/connection.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
       
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
    

       
        if (!$user_id) {       
            http_response_code(401); // Unauthorized
            echo "You need to log in to add items to your cart.";
            exit;
        }

        // Check if the product already exists
        $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if (mysqli_num_rows($result) > 0) {
            // update the quantity if exist
            $row = mysqli_fetch_assoc($result);
            $existing_quantity = $row['quantity'];

            // Calculate the new quantity
            $new_quantity = $existing_quantity + $quantity;

            // Check if the new quantity exceeds the maximum limit of 10
            if ($new_quantity > 10) {
                // Calculate the difference between the new quantity and 10
                $quantityToAdd = 10 - $existing_quantity;

                // Update the new quantity to add only the difference
                $new_quantity = $existing_quantity + $quantityToAdd;
            }

         
            $update_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
            $update_stmt = mysqli_prepare($link, $update_query);

            if ($update_stmt) {
                mysqli_stmt_bind_param($update_stmt, "iii", $new_quantity, $user_id, $product_id);
                if (mysqli_stmt_execute($update_stmt)) {
                    echo "Product quantity updated in the cart.";
                } else {
                    http_response_code(500); // Internal Server Error
                    echo "An error occurred while updating the product quantity in the cart.";
                }
                mysqli_stmt_close($update_stmt);
            } else {
                // Error preparing the statement
                http_response_code(500); // Internal Server Error
                echo "An error occurred while preparing the SQL statement to update quantity.";
            }
        } else {
           
            $insert_query = "INSERT INTO cart (user_id, product_id, quantity, added_at) VALUES (?, ?, ?, NOW())";
            $insert_stmt = mysqli_prepare($link, $insert_query);

            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, "iii", $user_id, $product_id, $quantity);
                if (mysqli_stmt_execute($insert_stmt)) {
                    // Cart item added successfully
                    echo "Product added to cart successfully.";
                } else {
                    // Error executing the statement
                    http_response_code(500); // Internal Server Error
                    echo "An error occurred while adding the product to the cart.";
                }
                mysqli_stmt_close($insert_stmt);
            } else {
                http_response_code(500); // Internal Server Error
            }
        }
    } else {
        http_response_code(400); // Bad Request
    }
} else {
    // If the request method is not POST, send an error response
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
