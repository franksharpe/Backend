<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Redirect to the dashboard or another page
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input (you should perform more robust validation)
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "127.0.0.1";
    $db_username = "root";
    $db_password = "";
    $database = "school";

    // Improved error handling for database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // User is authenticated, store the username and role in the session
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        // Redirect to the appropriate dashboard based on the user's role
        switch ($_SESSION['role']) {
            case 'admin':
                header("Location: dashboard_admin.php");
                break;
            case 'teacher':
                header("Location: dashboard_teacher.php");
                break;
            case 'student':
                header("Location: dashboard_student.php");
                break;
            default:
                header("Location: dashboard.php");
        }
        exit();
    } else {
        $error_message = "Invalid username or password";
        echo "Entered Password: $password<br>";
        echo "Verification Result: Mismatch<br>";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        } ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
