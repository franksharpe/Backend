<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch book names from the libary table
$sql_select_books = "SELECT book_name FROM libary";
$result_books = $conn->query($sql_select_books);

// Array to store book names
$book_names = [];

while ($row = $result_books->fetch_assoc()) {
    $book_names[] = $row['book_name'];
}

// Close the database connection
$conn->close();

// Return book names as JSON
header('Content-Type: application/json');
echo json_encode($book_names);
?>
