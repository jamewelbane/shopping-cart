<?php
require("../user/nav-bar.php");


// if (isset($_SESSION['user_id'])) {

// } else {
//     header("Location: ../index.html");
//   exit();
// }

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/store-design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="" crossorigin="anonymous" />
    <title>ShopPay</title>

</head>

<body>
    <?php
    $query = "SELECT * FROM products";
    $result = mysqli_query($link, $query);
    if ($result) {
    ?>

        <div style="margin-top: 0px;" class="store-container">
            <?php

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="item-container" style="margin-top: 5%;">
                    <div class="item">
                        <img src="<?php echo $row['image_url']; ?>" alt="Product Image">
                        <h2><?php echo $row['product_name']; ?></h2>
                        <p>₱<?php echo number_format($row['price'], 2); ?></p>
                        <div class="quantity-input-container">
                            <input type="number" class="quantity-input" value="1" min="1">
                            <button class="add-to-cart" data-product-id="<?php echo $row['product_id']; ?>"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    <?php
    } else {
        echo "Error fetching products: " . mysqli_error($link);
    }

    mysqli_close($link);
    ?>
    <script src="../javascript/custom.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all Add to Cart buttons
            var addToCartButtons = document.querySelectorAll(".add-to-cart");

            // Attach click event listener to each button
            addToCartButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Get the product ID associated with the button
                    var productId = button.getAttribute("data-product-id");

                    // Get the quantity input value
                    var quantityInput = button.parentNode.querySelector(".quantity-input");
                    var quantity = quantityInput.value;

                    // Send an AJAX request to add the product to the cart
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../function/add_to_cart.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Handle the response here if needed
                            console.log(xhr.responseText);
                        }
                    };
                    var quantity = quantityInput.value; // Get the quantity input value
                    xhr.send("product_id=" + productId + "&quantity=" + quantity); // Include quantity in the request

                });
            });
        });
    </script>
</body>


</html>