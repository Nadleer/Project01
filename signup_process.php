<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $company_email = mysqli_real_escape_string($conn, $_POST['company_email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    
    $check_sql = "SELECT * FROM signups WHERE company_email = '$company_email'";
    $result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='signup.html';</script>";
    } else {
        
        $sql = "INSERT INTO signups (company_name, company_email, password) 
                VALUES ('$company_name', '$company_email', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: thanks.html");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>