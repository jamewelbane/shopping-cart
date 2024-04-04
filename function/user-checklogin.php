<?php

session_start();

$_SESSION;

require("../database/connection.php");
require("user-function.php");

mysqli_select_db($link, $db);

$user_data = check_login($link);

?>