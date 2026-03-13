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
                    <span style="color: var(--text-primary);"><?php echo $price; ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span style="color: var(--text-primary);">$0.00</span>
                </div>
                
                <div class="summary-row total-row">
                    <span>Total Due</span>
                    <span style="color: var(--primary-color);"><?php echo $price; ?></span>
                </div>

                <form action="payment_process.php" method="POST" class="auth-form" style="background: transparent; width: 100%; padding: 0;">
                    <div class="payment-methods">
                        <p style="font-size: 0.9rem; margin: 25px 0 15px; color: var(--text-secondary);">Select Payment Method</p>
                        
                        <label class="method-option">
                            <input type="radio" name="payment_method" value="Visa" required>
                            <div class="method-box">
                                <i class="fab fa-cc-visa" style="color: #f79e1b; font-size: 1.5rem;"></i>
                                <span>Visa / Mastercard</span>
                            </div>
                        </label>

                        <label class="method-option">
                            <input type="radio" name="payment_method" value="PayPal" required>
                            <div class="method-box">
                                <i class="fab fa-paypal" style="color: #003087; font-size: 1.5rem;"></i>
                                <span>PayPal</span>
                            </div>
                        </label>
                    </div>

                    <button type="submit" class="auth-btn">
                        Complete Order <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h3 style="background: linear-gradient(135deg, #fff 0%, var(--primary-color) 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">Proton</h3>
                <p>Expert cybersecurity solutions designed to protect your digital assets in an ever-evolving threat landscape.</p>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contactus.html">Contact us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="ess.html">Web Pentesting</a></li>
                    <li><a href="pro.html">Mobile Protection</a></li>
                    <li><a href="all.html">Enterprise Defense</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Info</h3>
                <ul class="footer-contact">
                    <li><i class="fas fa-envelope"></i> security@proton.io</li>
                    <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-map-marker-alt"></i> Silicon Valley, CA</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Proton Cybersecurity. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
