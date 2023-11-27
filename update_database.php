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

// Get the teacherid from the query string
$teacherId = $_GET['teacherid'];

// Update the database and set the specific column to null for the given teacherid
$sqlUpdate = "UPDATE teachers SET ta_id = NULL WHERE teacherid = $teacherId";
$conn->query($sqlUpdate);

// Close the connection
$conn->close();
?>