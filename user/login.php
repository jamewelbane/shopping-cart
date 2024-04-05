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

?>


<body>

  <div id="id01" class="modal">

    <form class="modal-content animate" action="../function/login-process.php" method="post">
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