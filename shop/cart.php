<?php

// require("../database/connection.php");
// require("../function/user-function.php");

// if (isset($_SESSION['user_id'])) {
//   header("Location: ../index.html");
//   exit();
// }
if (isset($_SESSION['user_id'])) {
    $isLoggedIn = 1;
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/cart-style.css">

    <style>
        .cart-grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .cart-item-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }

        .product-info h2 {
            margin-bottom: 5px;
        }

        .product-info p {
            margin: 0;
        }

        .deleteItemGrid {
            display: flex;
            align-items: center;
        }


        /* quantity control */
        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            padding: 0.3em;
            /* Adjust the padding as needed */
            font-size: 10px;
            /* Adjust the font size as needed */
            border: none;
            background-color: transparent;
            cursor: pointer;
            font-weight: bold;
            width: 20px;
            color: black;
        }

        .quantity {
            padding: 0 0.3em;
            /* Adjust the padding as needed */
            font-size: 1em;
            /* Adjust the font size as needed */
        }

        .deleteBtn {
            background-color: #ff0000;
            /* Red */
            color: #fff;
            /* White text */
        }
    </style>
</head>

<body>
    <div id="id02" class="modal_cart">
        <div class="modal-content animate">
            <div class="container">
                <h1>Shopping Cart</h1>
                <?php
                if ($isLoggedIn === 1) {
                ?>
                    <div id="cartItemsContainer" class="cart-grid-container"></div>
                    <button class="checkout-bt">Check out</button>
                <?php
                } else {
                ?>
                    <p>You need to login first</p>w
                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <script src="../javascript/custom.js"></script>
    <script>
        
        // Function to update the quantity of a cart item using AJAX
        function updateQuantity(productId, quantity) {
            var xhr = new XMLHttpRequest();
            var params = 'product_id=' + productId + '&quantity=' + quantity; // Construct the request parameters
            xhr.open('POST', '../function/update_cart_item.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Log the response to the console
                        fetchCartItems(); // Fetch cart items again to update the display
                    } else {
                        console.error('Error updating cart item quantity:', xhr.status); // Log error to console
                    }
                }
            };
            xhr.send(params); // Send the request with the parameters
        }


        // Function to attach event listeners to quantity input fields
        function attachQuantityListeners() {
            var quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    var productId = this.dataset.productId; // Retrieve productId from dataset attribute
                    var newQuantity = this.value;
                    console.log("productId: ", productId); // Log productId to console for debugging
                    updateQuantity(productId, newQuantity);
                });
            });
        }



        // Function to fetch cart items using AJAX
        function fetchCartItems() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../function/fetch_cart_items.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var cartItems = JSON.parse(xhr.responseText);
                    var cartItemsContainer = document.getElementById('cartItemsContainer');
                    cartItemsContainer.innerHTML = ''; // Clear previous cart items

                    // Loop through cart items and append them to the container
                    cartItems.forEach(function(item) {
                        var cartItemHtml = '<div class="cart-item">';
                        cartItemHtml += '<div class="cart-item-details">';
                        cartItemHtml += '<div class="product-info">';
                        cartItemHtml += '<img src="' + item.image_url + '" alt="Product Image">';
                        cartItemHtml += '<div>';
                        cartItemHtml += '<h2>' + item.product_name + '</h2>';
                        cartItemHtml += '<p>Price: ₱' + parseFloat(item.price).toFixed(2) + '</p>';
                        cartItemHtml += '<label for="quantity' + item.product_id + '">Quantity:</label>';

                        cartItemHtml += '<div class="quantity-controls">';
                        cartItemHtml += '<button class="quantity-btn quantity-btn-decrease" onclick="decreaseQuantity(' + item.product_id + ')">-</button>';
                        cartItemHtml += '<span id="quantity' + item.product_id + '" class="quantity">' + item.quantity + '</span>';
                        cartItemHtml += '<button class="quantity-btn quantity-btn-increase" onclick="increaseQuantity(' + item.product_id + ')">+</button>';
                        cartItemHtml += '</div>';


                        cartItemHtml += '</div>';
                        cartItemHtml += '</div>';
                        cartItemHtml += '<div class="deleteItemGrid">';
                        cartItemHtml += '<button class="deleteBtn" onclick="deleteCartItem(' + item.product_id + ')"><i class="fas fa-trash"></i></button>';
                        cartItemHtml += '</div>';
                        cartItemHtml += '</div>';
                        cartItemHtml += '</div>';
                        cartItemsContainer.innerHTML += cartItemHtml;
                    });

                    // Attach event listeners to quantity input fields after updating the DOM
                    attachQuantityListeners();
                }
            };
            xhr.send();
        }

        // Call fetchCartItems() initially to populate the cart items
        fetchCartItems();

        function increaseQuantity(productId) {
            var quantityElement = document.getElementById('quantity' + productId);
            var currentQuantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentQuantity + 1;
            updateQuantity(productId, currentQuantity + 1);
        }

        function decreaseQuantity(productId) {
            var quantityElement = document.getElementById('quantity' + productId);
            var currentQuantity = parseInt(quantityElement.textContent);
            if (currentQuantity > 1) {
                quantityElement.textContent = currentQuantity - 1;
                updateQuantity(productId, currentQuantity - 1);
            }
        }


        // Function to delete a cart item using AJAX
        function deleteCartItem(productId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../function/delete_cart_item.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    fetchCartItems(); // Fetch cart items again to update the display
                }
            };
            xhr.send('product_id=' + productId);
        }

        // Function to show the cart modal and fetch cart items
        function showCartModal() {
            document.getElementById('id02').style.display = 'block';
            fetchCartItems(); // Fetch cart items when the modal is displayed
        }

        // Call the showCartModal function when the cart button is clicked
        document.addEventListener('DOMContentLoaded', function() {
            var cartButton = document.getElementById('cartButton');
            if (cartButton) {
                cartButton.addEventListener('click', showCartModal);
            }
        });
    </script>



</body>

</html>