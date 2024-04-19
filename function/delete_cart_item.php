<?php
session_start();
require_once "../database/connection.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if (!$user_id) {
          
  
            http_response_code(401); // Unauthorized
            echo "You need to log in to delete items from your cart.";
            exit;
        }

        $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
            if (mysqli_stmt_execute($stmt)) {
                http_response_code(200); // OK
                echo "success";
            } else {
                http_response_code(500); // Internal Server Error
                echo "An error occurred while deleting the cart item.";
            }
            mysqli_stmt_close($stmt);
        } else {
            
            http_response_code(500); // Internal Server Error
            echo "An error occurred while preparing the SQL statement.";
        }
    } else {
        
        http_response_code(400); // Bad Request
        echo "Product ID is required.";
    }
} else {
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
                console.error('Error deleting cart item:', xhr.responseText);
            }
        } else {
            console.error('Error deleting cart item:', xhr.status); 
        }
    }
};
</script>


