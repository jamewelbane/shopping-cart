// Function to update the quantity of a cart item using AJAX
function updateQuantity(productId, quantity) {
    var xhr = new XMLHttpRequest();
    var params = 'product_id=' + productId + '&quantity=' + quantity; // Construct the request parameters
    xhr.open('POST', '../function/update_cart_item.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
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
    quantityInputs.forEach(function (input) {
        input.addEventListener('input', function (event) {
            var productId = this.dataset.productId; // Retrieve productId from dataset attribute
            var newQuantity = this.value;
            // console.log("productId: ", productId); // Log productId to console for debugging
            updateQuantity(productId, newQuantity);
        });
    });
}


// Function to calculate the total amount to pay
function calculateTotalAmount(cartItems) {
    let total = 0;
    cartItems.forEach(item => {
        total += item.price * item.quantity;
    });
    return total.toFixed(2);
}

// Function to display the total amount
function displayTotalAmount(total) {
    const totalAmountElement = document.getElementById('totalAmount');
    totalAmountElement.textContent = 'Total amount: ₱' + total;
}

// Function to handle the checkout process
function checkout() {
    // Perform checkout process here, such as redirecting to a payment page
    alert('Redirecting to payment page...');
}

// Add event listener to the checkout button
const checkoutButton = document.getElementById('checkoutButton');
if (checkoutButton) {
    checkoutButton.addEventListener('click', checkout);
}

// Function to fetch cart items using AJAX
function fetchCartItems() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../function/fetch_cart_items.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var cartItems = JSON.parse(xhr.responseText);
            var cartItemsContainer = document.getElementById('cartItemsContainer');
            cartItemsContainer.innerHTML = ''; // Clrar previous cart items

            // Initialize total amount
            var totalAmount = 0;

            // Check if cart is empty
            if (cartItems.length === 0) {
                // Display message indicating empty cart
                var emptyCartMessage = document.createElement('p');
                emptyCartMessage.textContent = 'Your cart is empty.';
                cartItemsContainer.appendChild(emptyCartMessage);
            } else {
                // Loop through cart items
                cartItems.forEach(function (item) {
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

                    // Calculate total amount
                    totalAmount += item.price * item.quantity;
                });

                // Display total amount
                var totalAmountElement = document.createElement('p');
                totalAmountElement.textContent = 'Total amount: ₱' + totalAmount.toFixed(2);
                cartItemsContainer.appendChild(totalAmountElement);

                // Add checkout button only if cart is not empty
                var checkoutButton = document.createElement('button');
                checkoutButton.textContent = 'Checkout';
                checkoutButton.className = 'checkout-btn';
                checkoutButton.addEventListener('click', function () {
                    // Call checkout function
                    checkout(totalAmount);
                });
                cartItemsContainer.appendChild(checkoutButton);
            }

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
    var confirmDelete = confirm("Are you sure you want to delete this item from your cart?");
    if (confirmDelete) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../function/delete_cart_item.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            fetchCartItems();
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "success") {
                    alert("Cart item deleted successfully.");
                } else {
                    console.error('Error deleting cart item:', xhr.responseText); // Log error to console
                }
            } else {
                console.error('Error deleting cart item:', xhr.status); // Log error to console
            }
        };
        xhr.send('product_id=' + productId);
    }
}



// Function to close the cart modal
function closeCartModal() {
    document.getElementById('id02').style.display = 'none';
    fetchCartItems(); 
}

// Call the showCartModal function when the cart button is clicked
document.addEventListener('DOMContentLoaded', function() {
    var cartButton = document.getElementById('cartButton');
    if (cartButton) {
        cartButton.addEventListener('click', showCartModal);
        fetchCartItems();
    }
});

// Call the closeCartModal function when the close icon is clicked
document.addEventListener('DOMContentLoaded', function() {
    var closeIcon = document.querySelector('.close-icon-cart');
    if (closeIcon) {
        closeIcon.addEventListener('click', closeCartModal);
        fetchCartItems();
    }
});




document.addEventListener("DOMContentLoaded", function () {
    // Get all Add to Cart buttons
    var addToCartButtons = document.querySelectorAll(".add-to-cart");
    

    // Attach click event listener to each button
    addToCartButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the product ID associated with the button
            var productId = button.getAttribute("data-product-id");

            // Get the quantity input value
            var quantityInput = button.parentNode.querySelector(".quantity-input");
            var quantity = quantityInput.value || 1; // Set default quantity to 1 if not specified

            // Log the quantity before sending the AJAX request
            console.log("Quantity:", quantity);

            // Send an AJAX request to add the product to the cart
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../function/add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // console.log(xhr.responseText);
                    fetchCartItems();
                }
            };
            xhr.send("product_id=" + productId + "&quantity=" + quantity); // Include quantity in the request
        });
    });
});

