<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['sub_data'])) {
    $sub = $_SESSION['sub_data'];
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    
    $company_name = $sub['company_name'];
    $company_email = $sub['company_email'];
    $plan_type = $sub['plan_type'];
    $special_request = $sub['special_request'];

    $sql = "INSERT INTO subscriptions (company_name, company_email, plan_type, special_request, payment_method) 
            VALUES ('$company_name', '$company_email', '$plan_type', '$special_request', '$payment_method')";
    
    if (mysqli_query($conn, $sql)) {
        // Clear session data after successful subscription
        unset($_SESSION['sub_data']);
        header("Location: thanks2.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: services.html");
    exit();
}

mysqli_close($conn);
