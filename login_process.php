<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM signups WHERE company_email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['company_email'];
        
        // Check if user is admin
        if ($email === 'admin') {
            $_SESSION['is_admin'] = true;
            header("Location: admin.php");
        } else {
            // Regular user redirect
            header("Location: index.html");
        }
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
?>
