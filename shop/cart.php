<?php

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/cart-design.css">

</head>

<body>
    <div id="id02" class="modal_cart">
        <div class="modal-content animate">
            
            <div class="container">
                <!-- Close button -->
            <span class="close-icon-cart" onclick="closeCartModal()">&times;</span>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <h1>Shopping Cart</h1>
                    <div id="cartItemsContainer" style="text-align: center;" class="cart-grid-container"></div>
                <?php
                } else {
                ?>
                    <p>You need to login first</p>
                <?php
                }
                ?>
                
            </div>
        </div>
    </div>





    <script src="../javascript/custom.js"></script>
    <script src="../javascript/cart.js"></script>
            


</body>

</html>