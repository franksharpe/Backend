<?php
// Connect to the database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the teacherid and TA ID from the query string
$teacherId = $_GET['teacherid'];
$taId = $_GET['taId'];

// Validate that teacher ID and TA ID are not empty
if (empty($teacherId) || empty($taId)) {
    die('Invalid teacher ID or TA ID.');
}

// Update the database and set the ta_id to the provided value for the specific teacher
$sqlUpdate = "UPDATE teachers SET ta_id = '$taId' WHERE teacherid = $teacherId";

if ($conn->query($sqlUpdate) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the connection
$conn->close();
?>