<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// You can fetch additional student-related information from the database if needed

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?> (Student)!</h2>

    <!-- Student-specific content goes here -->
    <p>Your personalized student dashboard content...</p>

    <a href="logout.php">Logout</a>
</body>
</html>
