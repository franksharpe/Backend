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
$address = $_POST['address'];
$phone = $_POST['phone'];

    // Insert data into the table
    $sql = "INSERT INTO teachers (fname, lname, address, phone) VALUES ('$fname', '$lname', '$address','$phone' )";

    if ($conn->query($sql) === TRUE) {
        $lastteacherID = $conn->insert_id;
        echo "Record inserted successfully. <br> Your ID is: " . $lastteacherID;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close connection
$conn->close();
?>