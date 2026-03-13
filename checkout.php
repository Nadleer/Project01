<?php
session_start();
if (!isset($_SESSION['sub_data'])) {
    header("Location: services.html");
    exit();
}

$sub = $_SESSION['sub_data'];
$plan_name = $sub['plan_type'];
$price = "";
$description = "";

if ($plan_name == "Essential Security") {
    $price = "$499";
    $description = "Standard protection for small businesses.";
} elseif ($plan_name == "Professional Guard") {
    $price = "$999";
    $description = "Advanced security with 24/7 monitoring.";
} elseif ($plan_name == "Enterprise Shield") {
    $price = "$1,999";
    $description = "Full-scale enterprise-grade security suite.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Cart - Proton</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/images/Education-42-512.webp" type="image/x-icon">
    <style>
        .cart-container {
            max-width: 900px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 30px;
            padding: 20px;
        }

        .cart-section {
            background: var(--card-background);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .cart-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .cart-header i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .cart-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
            background: rgba(255,255,255,0.03);
            border-radius: 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .item-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .item-details h3 {
            margin: 0 0 5px 0;
            font-size: 1.2rem;
        }

        .item-details p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .billing-info {
            margin-top: 30px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 500;
        }

        .summary-card {
            background: var(--card-background);
            border-radius: 20px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .summary-title {
            font-size: 1.3rem;
            margin-bottom: 25px;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .total-row {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 20px;
            padding-top: 20px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .payment-methods {
            margin-top: 25px;
        }

        .method-option {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .method-option input {
            display: none;
        }

        .method-box {
            padding: 15px;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .method-option input:checked + .method-box {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.1);
        }

        .confirm-btn {
            width: 100% !important;
            margin-top: 25px;
            background: var(--primary-color) !important;
            color: white !important;
            border: none;
            padding: 16px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .confirm-btn:hover {
            background: var(--secondary-color) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }
        }

        /* Clean up global form overrides */
        .summary-card form {
            width: 100%;
            background: transparent;
            padding: 0;
            margin: 0;
            color: inherit;
        }
    </style>
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
            <li><a href="/proton/login.php">Sign In</a></li>
            <li><a href="checkout.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
          </ul>
        </nav>
        <a class="test" href="contactus.html"><button>Contact</button></a>
    </header>

    <main>
        <div class="cart-container">
            <div class="cart-section">
                <div class="cart-header">
                    <i class="fas fa-shopping-cart"></i>
                    <h2>Services Cart</h2>
                </div>

                <div class="cart-item">
                    <div class="item-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="item-details">
                        <h3><?php echo htmlspecialchars($plan_name); ?></h3>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>

                <div class="billing-info">
                    <h3>Billing Information</h3>
                    <br>
                    <div class="info-group">
                        <div class="info-label">Company Name</div>
                        <div class="info-value"><?php echo htmlspecialchars($sub['company_name']); ?></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Contact Email</div>
                        <div class="info-value"><?php echo htmlspecialchars($sub['company_email']); ?></div>
                    </div>
                    <?php if(!empty($sub['special_request'])): ?>
                    <div class="info-group">
                        <div class="info-label">Special Request</div>
                        <div class="info-value"><?php echo nl2br(htmlspecialchars($sub['special_request'])); ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="summary-card">
                <h2 class="summary-title">Order Summary</h2>
                
                <div class="summary-row">
                    <span>Plan Subtotal</span>
                    <span><?php echo $price; ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>$0.00</span>
                </div>
                
                <div class="summary-row total-row">
                    <span>Total Due</span>
                    <span style="color: var(--primary-color);"><?php echo $price; ?></span>
                </div>

                <form action="payment_process.php" method="POST">
                    <div class="payment-methods">
                        <p style="font-size: 0.9rem; margin-bottom: 15px; color: var(--text-secondary);">Select Payment Method</p>
                        
                        <label class="method-option">
                            <input type="radio" name="payment_method" value="Visa" required>
                            <div class="method-box">
                                <i class="fab fa-cc-visa" style="color: #f79e1b;"></i>
                                <span>Visa / Mastercard</span>
                            </div>
                        </label>

                        <label class="method-option">
                            <input type="radio" name="payment_method" value="PayPal" required>
                            <div class="method-box">
                                <i class="fab fa-paypal" style="color: #003087;"></i>
                                <span>PayPal</span>
                            </div>
                        </label>
                    </div>

                    <button type="submit" class="confirm-btn">
                        Complete Order <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; copyrights reserved 2024</p>
    </footer>
</body>
</html>
