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
    // If connection fails, terminate and show an error message
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Insert data into the "teachers" table
$sql = "INSERT INTO teachers (fname, lname, address, phone) VALUES ('$fname', '$lname', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {
    // If the query is successful, retrieve the last inserted teacher ID
    $lastteacherID = $conn->insert_id;
    echo "Record inserted successfully. <br> Your ID is: " . $lastteacherID;
    // Provide a button to return to the home page
    echo '<br><input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
} else {
    // If there's an error in the query, display an error message
    echo "Error: " . $sql . "<br>" . $conn->error;
    // Provide a button to return to the home page
    echo '<br><input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
}

// Close the database connection
$conn->close();
?>
