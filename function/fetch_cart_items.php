<?php
session_start();
require_once "../database/connection.php"; 


if (isset($_SESSION['user_id'])) {
   
    $query = "SELECT p.product_id, p.product_name, p.image_url, p.price, c.quantity FROM cart c
          INNER JOIN products p ON c.product_id = p.product_id
          WHERE c.user_id = ?";

    $stmt = mysqli_prepare($link, $query);

    if ($stmt) {
     
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if cart items exist
        if (mysqli_num_rows($result) > 0) {
            // Fetch cart items and store them in an array
            $cartItems = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cartItems[] = $row;
            }
            // Output cart items as JSON
            echo json_encode($cartItems);
        } else {
            // No items in the cart
            echo json_encode([]);
        }

        mysqli_stmt_close($stmt);
    } else {
    
        http_response_code(500);
        echo json_encode(["error" => "An error occurred while preparing the SQL statement."]);
    }
} else {
    // User is not logged in
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "You need to log in to view your cart items."]);
}
