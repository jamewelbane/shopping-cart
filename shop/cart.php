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

    </style>
</head>

<body>
    <div id="id02" class="modal_cart">
        <form class="modal-content animate" action="../function/login-process.php" method="post">
            <div class="container">
                <h1>Shopping Cart</h1>
                <?php
                if ($isLoggedIn === 1) {
                ?>
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <img src="https://via.placeholder.com/100" alt="Product Image">
                            <div>
                                <h2>Product Name</h2>
                                <p>Price: $10.00</p>
                                <p>Quantity: 1</p>
                            </div>
                        </div>
                    </div>
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <img src="https://via.placeholder.com/100" alt="Product Image">
                            <div>
                                <h2>Another Product</h2>
                                <p>Price: $15.00</p>
                                <p>Quantity: 2</p>
                            </div>
                        </div>
                    </div>
                    <button class="checkout-bt">Check out</button>
                <?php
                } else {
                ?>
                    <h2>Log in first before you can check out items.</h2>
                <?php
                }
                ?>
            </div>
        </form>
    </div>
</body>
<script>

</script>

</html>