function togglePasswordVisibility(fieldId, iconId) {
    var passwordField = document.getElementById(fieldId);
    var passwordToggleIcon = document.getElementById(iconId);
  
    if (passwordField.type === "password") {
      passwordField.type = "text";
      passwordToggleIcon.classList.remove("fa-eye");
      passwordToggleIcon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      passwordToggleIcon.classList.remove("fa-eye-slash");
      passwordToggleIcon.classList.add("fa-eye");
    }
  }

   // Get the modal
   var modal = document.getElementById('id01');

   // close modal for outside click
   window.onclick = function(event) {
     if (event.target == modal) {
       modal.style.display = "none";
     }
   }

   // Get the modal for shopping-cart
   var modal_cart = document.getElementById('id02');
   
   window.onclick = function(event) {
     if (event.target == modal_cart) {
      modal_cart.style.display = "none";
     }
   }



   






