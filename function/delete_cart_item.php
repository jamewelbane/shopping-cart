<?php
session_start();
require_once "../database/connection.php"; // Include your database connection file

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the product ID is provided
    if (isset($_POST['product_id'])) {
        // Sanitize the product ID
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Check if the user is logged in
        if (!$user_id) {
            // If user is not logged in, handle the case according to your application logic
            // For example, redirect to the login page or prompt the user to log in
            http_response_code(401); // Unauthorized
            echo "You need to log in to delete items from your cart.";
            exit;
        }

        // Prepare the SQL statement to delete the cart item
        $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
            if (mysqli_stmt_execute($stmt)) {
                // Cart item deleted successfully
                http_response_code(200); // OK
                echo "success";
            } else {
                // Error executing the statement
                http_response_code(500); // Internal Server Error
                echo "An error occurred while deleting the cart item.";
            }
            mysqli_stmt_close($stmt);
        } else {
            // Error preparing the statement
            http_response_code(500); // Internal Server Error
            echo "An error occurred while preparing the SQL statement.";
        }
    } else {
        // If the product ID is not provided, send an error response
        http_response_code(400); // Bad Request
        echo "Product ID is required.";
    }
} else {
    // If the request method is not POST, send an error response
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>

<script>
     xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            if (xhr.responseText === "success") {
                alert("Cart item deleted successfully.");
                fetchCartItems(); // Fetch cart items again to update the display
            } else {
                console.error('Error deleting cart item:', xhr.responseText); // Log error to console
            }
        } else {
            console.error('Error deleting cart item:', xhr.status); // Log error to console
        }
    }
};
</script>


