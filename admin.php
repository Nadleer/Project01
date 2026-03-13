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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0f172a;
            color: #fff;
            padding: 20px;
        }
        h1, h2 {
            color: #2563eb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #1e293b;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #334155;
        }
        th {
            background-color: #2563eb;
            color: white;
        }
        tr:hover {
            background-color: #334155;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <?php if ($message): ?>
        <div style="background-color: #22c55e; color: white; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div style="background-color: #1e293b; padding: 20px; border-radius: 8px; margin-bottom: 40px;">
        <h2><?php echo $edit_user ? 'Edit User' : 'Create New User'; ?></h2>
        <form method="POST" action="admin.php">
            <input type="hidden" name="action" value="<?php echo $edit_user ? 'update' : 'create'; ?>">
            <?php if ($edit_user): ?>
                <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">
            <?php endif; ?>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Company Name:</label>
                <input type="text" name="company_name" required value="<?php echo $edit_user ? $edit_user['company_name'] : ''; ?>" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #334155; background-color: #0f172a; color: white;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email:</label>
                <input type="email" name="company_email" required value="<?php echo $edit_user ? $edit_user['company_email'] : ''; ?>" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #334155; background-color: #0f172a; color: white;">
            </div>
            
            <?php if (!$edit_user): ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Password:</label>
                <input type="password" name="password" required value="" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #334155; background-color: #0f172a; color: white;">
            </div>
            <?php endif; ?>
            
            <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <?php echo $edit_user ? 'Update User' : 'Create User'; ?>
            </button>
            <?php if ($edit_user): ?>
                <a href="admin.php" style="margin-left: 10px; color: #94a3b8; text-decoration: none;">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <h2>Sign Ups</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT id, company_name, company_email, created_at FROM signups ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['company_name'] . "</td>";
            echo "<td>" . $row['company_email'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td><a href='admin.php?edit_id=" . $row['id'] . "' style='color: #60a5fa; text-decoration: none;'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <h2>Subscriptions</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Plan Type</th>
            <th>Special Request</th>
            <th>Payment Method</th>
            <th>Created At</th>
        </tr>
        <?php
        $sql = "SELECT * FROM subscriptions ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['company_name'] . "</td>";
            echo "<td>" . $row['company_email'] . "</td>";
            echo "<td>" . $row['plan_type'] . "</td>";
            echo "<td>" . $row['special_request'] . "</td>";
            echo "<td>" . (isset($row['payment_method']) ? $row['payment_method'] : 'N/A') . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <h2>Contact Messages</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Created At</th>
        </tr>
        <?php
        $sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['company_name'] . "</td>";
            echo "<td>" . $row['company_email'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <?php mysqli_close($conn); ?>
</body>
</html>