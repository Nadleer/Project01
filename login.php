<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Proton</title>
    <link rel="shortcut icon" href="/images/Education-42-512.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <h1>Proton</h1>
        <nav class="navbar">
            <ul>
                <li><a href="/proton/index.html">Home</a></li>
                <li><a href="/proton/about.html">About us</a></li>
                <li><a href="/proton/services.html">Services</a></li>
                <li><a href="/proton/signup.html">Sign up</a></li>
                <li><a href="/proton/login.php">Sign In</a></li>
                <li><a href="checkout.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
        <a class="test" href="/proton/contactus.html"><button>Contact</button></a>
    </header>

    <main>
        <div class="auth-container">
            <h2>Welcome Back</h2>
            <?php if(isset($_GET['error'])): ?>
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i> Invalid credentials. Please try again.
            </div>
            <?php endif; ?>
            <form class="auth-form" action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="email">Email / Username</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email or username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="auth-btn">Sign In</button>
            </form>
            <div class="auth-footer">
                Don't have an account? <a href="signup.html">Sign Up</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; copyrights reserved 2024</p>
    </footer>
</body>

</html>
