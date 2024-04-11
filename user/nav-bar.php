<?php
// session_start();
require("login.php");
require("../shop/cart.php");
if (isset($_SESSION['user_id'])) {
    $isLoggedIn = 1;
} else {
    $isLoggedIn = 0;
}

$csrf_token = bin2hex(random_bytes(32)); // Generate a random token
$_SESSION['csrf_token'] = $csrf_token; // Store the token in the session
?>

<html>

<head>
    <meta charset="UTF-8">
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'> -->
    <link rel="stylesheet" href="../css/navigation-style.css">

</head>



<body>

    <nav >
        <div class="wrapper">
            <div class="logo"><a href="../index.html">ShopPay</a></div>
            <input type="radio" name="slider" id="menu-btn">
            <input type="radio" name="slider" id="close-btn">
            <ul class="nav-links">
                <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                <li><a href="../index.html">Home</a></li>
                <li><a href="../shop/store.php">Product</a></li>
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

                <?php
                if ($isLoggedIn === 1) : ?>
                    <form id="logoutForm" action="../user/user-logout.php" method="post">
                        <li><input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <a href="#" onclick="logoutConfirmation()">Logout</a>
                        </li>
                    </form>
                    <li><a href="#" id="cartButton" onclick="document.getElementById('id02').style.display='block'"><i class="fas fa-cart-plus"></i></a></li>
                <?php endif; ?>

                <?php
                if ($isLoggedIn === 0) : ?>
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
                <?php endif; ?>

            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>



    <!-- body -->
    <!-- <div class="body-text">
        <div class="title"></div>
        <div class="sub-title">
        </div>
    </div> -->
    <!-- partial -->




<script src="../javascript/custom.js"></script>
<script>
    function logoutConfirmation() {
        var confirmLogout = confirm("Are you sure? You are about to logout.");

        if (confirmLogout) {
            document.getElementById("logoutForm").submit();
        }
    }
</script>

</body>


</html>