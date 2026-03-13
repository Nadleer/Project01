<?php

$host = 'localhost';
$username = 'root';  
$password = '';      
$database = 'proton_db2';


$conn = mysqli_connect($host, $username, $password);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE DATABASE IF NOT EXISTS $database";
mysqli_query($conn, $sql);


mysqli_select_db($conn, $database);


$signups_table = "CREATE TABLE IF NOT EXISTS signups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    company_email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $signups_table);

$subscriptions_table = "CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    company_email VARCHAR(255) NOT NULL,
    plan_type VARCHAR(100) NOT NULL,
    special_request TEXT,
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $subscriptions_table);

$contacts_table = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    company_email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $contacts_table);

// Check if admin exists, if not create it
$admin_email = 'admin';
$check_admin = "SELECT * FROM signups WHERE company_email = '$admin_email'";
$result = mysqli_query($conn, $check_admin);
if (mysqli_num_rows($result) == 0) {
    $admin_pass = 'omarOMAR2014'; // In real app, hash this!
    $insert_admin = "INSERT INTO signups (company_name, company_email, password) VALUES ('Admin', '$admin_email', '$admin_pass')";
    mysqli_query($conn, $insert_admin);
}