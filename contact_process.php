<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Proton</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/images/Education-42-512.webp" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Proton</h1>
        <nav class="navbar">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="signup.html">Sign up</a></li>
          </ul>
        </nav>
        <a class="test" href="contactus.html"><button>Contact</button></a>
    </header>
    
    <h1 style="text-align: center; padding: 30px;">Sign up</h1>
    
    <form class="signup" action="signup_process.php" method="POST">
        <input type="text" name="company_name" placeholder="Company's name" required>
        <input type="email" name="company_email" placeholder="Company's email" required>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Signup">
    </form>
    
    <footer class="footer">
        <p>&copy; copyrights reserved 2024</p>
    </footer>
</body>
</html>