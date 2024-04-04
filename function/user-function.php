<?php

function check_login($link)
{
    if (isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM user_account WHERE user_id = ? LIMIT 1";

        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            $activeStat = $user_data['active'];
            
           
        }
    }

    // User is not logged in, or the account does not exist
    // 	unset($_SESSION['user_id']);
    // header("Location: ../index.html");
    // die;
}

function show_generic_message($message, $icon, $timer_duration = 2000) {
    // Display a generic message to users without a button
    echo '<script type="text/javascript">';
    echo 'document.addEventListener("DOMContentLoaded", function () {';
    echo 'alert("' . $message . '");';
    echo '});</script>';
}


?>