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



  //  logout 
  function logoutConfirmation() {
    var confirmLogout = confirm("Are you sure? You are about to logout.");

    if (confirmLogout) {
        // Redirect to the logout page
        window.location.href = "logout.php";
    }
}
