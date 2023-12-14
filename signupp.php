<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input (you should perform more robust validation)
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "127.0.0.1";
    $db_username = "root";
    $db_password = "";
    $database = "school";

    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'student')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Error during registration";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <?php if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        } ?>
        <form method="post" action="signupp.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Signup">
        </form>
    </div>
</body>
</html>
