<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/login-style.css">
</head>


<?php
session_start(); 
require("../database/connection.php");
require("../function/user-function.php");


// if (isset($_SESSION['user_id'])) {
//   header("Location: ../index.html");
//   exit();
// }


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['uname'];
    $password = $_POST['psw'];
    if (!empty($user_name) && !empty($password)) {
        // Prepare the statement
        $query = "SELECT user_id, password FROM user_account WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $query);

        if ($stmt) {
            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "s", $user_name);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch the row
                $user_data = mysqli_fetch_assoc($result);

                // Use password_verify to check the hashed password
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id']; // Store user_id in session

                    // Show success alert
                    show_generic_message("Login successful. Redirecting...", "success");

                    // Redirect to the main webpage after a delay
                    echo '<script type="text/javascript">';
                    echo 'setTimeout(function() { window.location.href = "../shop/store.php"; }, 2000);';
                    echo '</script>';
                    die;
                } else {
                    // Incorrect password
                    show_generic_message("Login failed. Incorrect password.", "error");
                }
            } else {
                // No user found
                show_generic_message("Login failed. Please check your credentials.", "error");
            }
        } else {
            // Error preparing the statement
            show_generic_message("An error occurred. Please try again later.", "error");
        }
    }
}
?>


<body>

  <div id="id01" class="modal">

    <form class="modal-content animate" action="#" method="post">
      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <div style="display: grid; grid-template-columns: 1fr auto;">
          <input type="password" id="passwordField" placeholder="Enter Password" name="psw" required>
          <button class="showPass" type="button" onclick="togglePasswordVisibility('passwordField', 'passwordToggleIcon')">
            <span class="far fa-eye" id="passwordToggleIcon"></span>
          </button>
        </div>
        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </div>
  <script src="../javascript/custom.js"></script>
</body>