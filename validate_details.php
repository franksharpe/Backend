<?php
$servername = "127.0.0.1";
$username ="root";
$password = "";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$pupilId = $_POST['pupilId'];

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM pupils WHERE fname = ? AND pupil_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $fname, $pupilId);
$stmt->execute();
$result = $stmt->get_result();
$isValid = $result->num_rows > 0;

// Send the result back to the client-side JavaScript
echo json_encode($isValid);

// Close the database connection
$stmt->close();
$conn->close();
?>