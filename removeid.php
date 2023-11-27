<?php
// Connect to MySQL server
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a pupil_id removal request is received
if (isset($_GET['removePupilId'])) {
    $parentId = $_GET['removePupilId'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE parents SET pupil_id = NULL WHERE Parent_id = ?");
    $stmt->bind_param("i", $parentId);
    $stmt->execute();
    $stmt->close();
}

// Close connection
$conn->close();
?>
