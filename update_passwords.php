<?php
$servername = "127.0.0.1";
$db_username = "root";
$db_password = "";
$database = "school";

$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve existing users
$query = "SELECT id, password FROM users";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    // Update each password using password_hash
    $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
    $user_id = $row['id'];

    // Update the password in the database
    $update_query = "UPDATE users SET password='$hashed_password' WHERE id=$user_id";
    $conn->query($update_query);
}

$conn->close();
?>
