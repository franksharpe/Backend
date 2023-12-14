<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

if ($role !== 'admin') {
    // Redirect to appropriate dashboard based on the user's role
    header("Location: dashboard.php");
    exit();
}

// Rest of the admin dashboard content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?> (Admin)!</h2>
    <!-- Admin-specific content goes here -->
    <a href="logout.php">Logout</a>
</body>
</html>
