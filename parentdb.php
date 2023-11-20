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
// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$pupil_id = $_POST['pupil_id'];

    // Insert data into the "pupils" table
    $sql = "INSERT INTO parents (fname, lname, phone , pupil_id) VALUES ('$fname', '$lname', '$phone', '$pupil_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close connection
$conn->close();
?>