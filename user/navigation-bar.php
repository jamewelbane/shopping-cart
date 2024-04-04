<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="../css/navigation-style.css">
</head>

<body>
    <!-- partial:index.partial.html -->
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="#">ShopPay</a></div>
            <input type="radio" name="slider" id="menu-btn">
            <input type="radio" name="slider" id="close-btn">
            <ul class="nav-links">
                <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <li>
                    <a href="#" class="desktop-item">Sell</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Dropdown Menu</label>
                    <ul class="drop-menu">
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Service</a></li>
                    </ul>
                </li>
                
                <li><a href="#">About</a></li>
                <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>



    <!-- body -->
    <!-- <div class="body-text">
        <div class="title">The price is 200% more expensive.</div>
        <div class="sub-title">Shop now with 100% discount!</div>
    </div> -->
    <!-- partial -->

</body>

<?php
require ("login.php");
?>
</html>