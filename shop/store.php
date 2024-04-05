<?php
require ("../head.html");
require ("../user/nav-bar.php");

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
    <title>ShopPay</title>

</head>
<body>
    

<?php

$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);

if ($result) {
    ?>
    <div style="margin-top: 50px;" class="store-container">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="item">
            <img src="<?php echo $row['image_url']; ?>" alt="Product Image">
            <h2><?php echo $row['product_name']; ?></h2>
            <p>₱<?php echo number_format($row['price'], 2); ?></p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
        </div>
        <div class="item">
            <img src="<?php echo $row['image_url']; ?>" alt="Product Image">
            <h2><?php echo $row['product_name']; ?></h2>
            <p>₱<?php echo number_format($row['price'], 2); ?></p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
        </div>
        <div class="item">
            <img src="<?php echo $row['image_url']; ?>" alt="Product Image">
            <h2><?php echo $row['product_name']; ?></h2>
            <p>₱<?php echo number_format($row['price'], 2); ?></p>
            <button class="add-to-cart"><i class="fas fa-cart-plus"></i></button>
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
</body>
</html>
