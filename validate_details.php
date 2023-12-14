<?php
// Database connection parameters
$servername = "127.0.0.1";
$username ="root";
$password = "";
$dbname = "school";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the values from the POST request
$fname = $_POST['fname'];
$pupilId = $_POST['pupilId'];

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM pupils WHERE fname = ? AND pupil_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $fname, $pupilId);
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

// Check if there is at least one matching row in the database
$isValid = $result->num_rows > 0;

// Send the result back to the client-side JavaScript in JSON format
echo json_encode($isValid);

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
