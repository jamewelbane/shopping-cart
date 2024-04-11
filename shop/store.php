<?php
require("../user/nav-bar.php");
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/store-design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="" crossorigin="anonymous" />
    <title>ShopPay</title>

    <style>
        /* Define the animation classes */
        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            25% {
                transform: translateY(-5px);
            }

            50% {
                transform: translateY(5px);
            }

            75% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* Apply animation class */
        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        .shake {
            animation-name: shake;
        }

        .bounce {
            animation-name: bounce;
        }
    </style>
</head>

<body>
    <?php
    $query = "SELECT * FROM products";
    $stmt = mysqli_prepare($link, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {

            echo '<div style="margin-top: 0px;" class="store-container">';
            while ($row = mysqli_fetch_assoc($result)) {
    ?>
                <div class="item-container" style="margin-top: 5%;">
                    <div class="item">
                        <img src="<?php echo $row['image_url']; ?>" alt="Product Image">
                        <h2><?php echo $row['product_name']; ?></h2>
                        <p>₱<?php echo number_format($row['price'], 2); ?></p>
                        <div class="quantity-input-container">
                            <div class="quantity-controls">

                                <button class="quantity-btn quantity-btn-decrease">-</button>

                                <input class="quantity-input" value="1" min="1" readonly>

                                <button class="quantity-btn quantity-btn-increase">+</button>
                            </div>

                            <button class="add-to-cart" data-product-id="<?php echo $row['product_id']; ?>"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>
    <?php
            }

            // End of the store container
            echo '</div>';

            mysqli_free_result($result); // Free the result set
        } else {
            echo "Error fetching products: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($link);
    }
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


    <script>
        document.querySelectorAll('.add-to-cart').forEach(function(button) {
            button.addEventListener('click', function() {
                var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

                if (!isLoggedIn) {
                    // Add animation for not logged in
                    this.classList.add('animated', 'shake');
                    alert("You need to log in first");
                } else {
                    // Add animation for logged in
                    this.classList.add('animated', 'bounce');
                    alert("Added successfully");
                }

                // Remove animation classes after animation ends
                this.addEventListener('animationend', function() {
                    this.classList.remove('animated', 'shake', 'bounce');
                });
            });
        });
    </script>
</body>

<script>
    // Get all quantity controls
    var quantityControls = document.querySelectorAll('.quantity-controls');

    // Iterate over each quantity control
    quantityControls.forEach(function(control) {
        var input = control.querySelector('.quantity-input');
        var decreaseBtn = control.querySelector('.quantity-btn-decrease');
        var increaseBtn = control.querySelector('.quantity-btn-increase');

        // Add event listener to decrease button
        decreaseBtn.addEventListener('click', function() {
            var value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        });

        // Add event listener to increase button
        increaseBtn.addEventListener('click', function() {
            var value = parseInt(input.value);
            input.value = value + 1;
        });
    });
</script>

</html>