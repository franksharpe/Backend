<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

if ($role !== 'teacher') {
    // Redirect to appropriate dashboard based on the user's role
    header("Location: dashboard.php");
    exit();
}

// Rest of the teacher dashboard content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?> (Teacher)!</h2>
    <!-- Teacher-specific content goes here -->
    <a href="logout.php">Logout</a>
</body>
</html>
