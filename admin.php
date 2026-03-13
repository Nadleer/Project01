<?php
session_start();
include 'config.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}

$edit_user = null;
$message = '';

// Handle Create/Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $company_email = mysqli_real_escape_string($conn, $_POST['company_email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); // In a real app, hash this!

        if ($_POST['action'] == 'create') {
            $sql = "INSERT INTO signups (company_name, company_email, password) VALUES ('$company_name', '$company_email', '$password')";
            if (mysqli_query($conn, $sql)) {
                $message = "User created successfully!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        } elseif ($_POST['action'] == 'update') {
            $id = intval($_POST['id']);
            $sql = "UPDATE signups SET company_name='$company_name', company_email='$company_email' WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                $message = "User updated successfully!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}


if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $sql = "SELECT * FROM signups WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $edit_user = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Proton</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/images/Education-42-512.webp" type="image/x-icon">
</head>
<body style="padding: 0;">
    <header>
        <h1>Proton</h1>
        <nav class="navbar">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="signup.html">Sign up</a></li>
                <li><a href="admin.php" class="active">Admin</a></li>
                <li><a href="checkout.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </nav>
        <a class="test" href="logout.php"><button style="background-color: #ef4444;">Logout</button></a>
    </header>

    <main style="padding: 40px 5%;">
        <h1 style="margin-bottom: 40px; background: linear-gradient(135deg, #fff 0%, var(--primary-color) 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">Admin Dashboard</h1>

        <?php if ($message): ?>
            <div class="status-badge status-success" style="margin-bottom: 30px; display: inline-block;">
                <i class="fas fa-check-circle"></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="auth-container" style="max-width: 600px; margin: 0 0 60px 0; background: var(--card-background);">
            <h2 style="text-align: left; margin-bottom: 30px;"><?php echo $edit_user ? 'Edit User' : 'Create New User'; ?></h2>
            <form method="POST" action="admin.php" class="auth-form">
                <input type="hidden" name="action" value="<?php echo $edit_user ? 'update' : 'create'; ?>">
                <?php if ($edit_user): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" required value="<?php echo $edit_user ? $edit_user['company_name'] : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="company_email" required value="<?php echo $edit_user ? $edit_user['company_email'] : ''; ?>">
                </div>
                
                <?php if (!$edit_user): ?>
                <div class="form-group">
                    <label>Temporary Password</label>
                    <input type="password" name="password" required value="">
                </div>
                <?php endif; ?>
                
                <div style="display: flex; gap: 20px; align-items: center;">
                    <button type="submit" class="auth-btn" style="width: auto; padding: 0.8rem 2rem; margin-top: 0;">
                        <?php echo $edit_user ? 'Update User' : 'Create User'; ?>
                    </button>
                    <?php if ($edit_user): ?>
                        <a href="admin.php" style="color: var(--text-secondary); text-decoration: none; font-size: 0.9rem;">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        
        <section style="margin-bottom: 60px;">
            <h2 style="margin-bottom: 25px; font-size: 1.5rem;">User accounts</h2>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, company_name, company_email, created_at FROM signups ORDER BY created_at DESC";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_email']) . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td><a href='admin.php?edit_id=" . $row['id'] . "' style='color: var(--primary-color); text-decoration: none;'><i class='fas fa-edit'></i> Edit</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section style="margin-bottom: 60px;">
            <h2 style="margin-bottom: 25px; font-size: 1.5rem;">Recent Subscriptions</h2>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Payment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM subscriptions ORDER BY created_at DESC";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_email']) . "</td>";
                            echo "<td><span class='status-badge' style='background: rgba(37, 99, 235, 0.1); color: var(--primary-color);'>" . $row['plan_type'] . "</span></td>";
                            echo "<td>" . (isset($row['payment_method']) ? $row['payment_method'] : 'N/A') . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section>
            <h2 style="margin-bottom: 25px; font-size: 1.5rem;">Inquiries</h2>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Message Preview</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['company_email']) . "</td>";
                            echo "<td>" . htmlspecialchars(substr($row['message'], 0, 50)) . "...</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
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
    <?php mysqli_close($conn); ?>
</body>
</html>