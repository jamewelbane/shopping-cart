<?php
require ("../head.html");
require ("../user/navigation-bar.php");

// if (isset($_SESSION['user_id'])) {
  
// } else {
//     header("Location: ../index.html");
//   exit();
// }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopPay</title>

</head>
<body>
    

    <div class="store-container">
        <div class="item">
            <img src="../images/lenovo-1.jpg" alt="Product Image">
            <h2>Lenovo ThinkBook 13s</h2>
            <p>₱18,999.00</p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
        </div>
        <div class="item">
            <img src="../images/chair-2.jpg" alt="Product Image">
            <h2>Office/gaming Chair</h2>
            <p>₱21,999.00</p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
        </div>
        <div class="item">
            <img src="../images/gpu-3.jpg" alt="Product Image">
            <h2>RTX 2060</h2>
            <p>₱19,899.00</p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
        </div>
    </div>
    <script src="../javascript/custom.js"></script>
</body>
</html>
