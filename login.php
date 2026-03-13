<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Proton</title>
    <link rel="shortcut icon" href="/images/Education-42-512.webp" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 2rem;
            background-color: #1e293b;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .login-container h2 {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #334155;
            background-color: #0f172a;
            color: white;
            font-size: 1rem;
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-btn:hover {
            background-color: #1d4ed8;
        }

        .error-msg {
            background-color: #ef4444;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
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

    <div class="login-container">
        <h2>Sign In</h2>
        <?php if(isset($_GET['error'])): ?>
        <div class="error-msg">Invalid credentials</div>
        <?php endif; ?>
        <form action="login_process.php" method="POST">
            <div class="form-group">
                <label for="email">Email / Username</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Sign In</button>
        </form>
    </div>
</body>

</html>
