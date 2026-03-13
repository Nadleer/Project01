<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['sub_data'] = [
        'company_name' => mysqli_real_escape_string($conn, $_POST['company_name']),
        'company_email' => mysqli_real_escape_string($conn, $_POST['company_email']),
        'plan_type' => mysqli_real_escape_string($conn, $_POST['plan_type']),
        'special_request' => mysqli_real_escape_string($conn, $_POST['special_request'])
    ];
    
    mysqli_close($conn);
    session_write_close();
    header("Location: checkout.php");
    // JavaScript fallback in case header redirection fails
    echo '<script type="text/javascript">window.location.href="checkout.php";</script>';
    exit();
} else {
    mysqli_close($conn);
    session_write_close();
    header("Location: services.html");
    echo '<script type="text/javascript">window.location.href="services.html";</script>';
    exit();
}