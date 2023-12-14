<?php
// Database connection 
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

// Insert data into the "ta" table
$sql = "INSERT INTO ta (fname, lname, address, phone) VALUES ('$fname', '$lname', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {

    // Get the last inserted teacher ID
    $lastteacherID = $conn->insert_id;
    echo "Record inserted successfully. <br> Your ID is: " . $lastteacherID;
    echo '<br><input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo '<br><input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
}

// Close connection
$conn->close();
?>
