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
$birthday = $_POST['birthday'];
$classname = $_POST['classid'];
$classname = trim($_POST['classid']);


// Fetch the classid based on the classname using a prepared statement
$classQuery = $conn->prepare("SELECT classid FROM classes WHERE class_name = ?");
$classQuery->bind_param("s", $classname);
$classQuery->execute();
$classResult = $classQuery->get_result();


if ($classResult->num_rows > 0) {
    $row = $classResult->fetch_assoc();
    $classid = $row['classid'];

    // Insert data into the "pupils" table using a prepared statement
    $sql = $conn->prepare("INSERT INTO pupils (fname, lname, address, birthday, classid) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssssi", $fname, $lname, $address, $birthday, $classid);

    if ($sql->execute()) {
        $lastPupilID = $conn->insert_id;
        echo "<br>Thank You For Joining St Alphonsus Primary School. <br> Your Pupil ID is: $lastPupilID <br> Your Class: $classname";
    } else {
        echo "Error: " . $sql->error;
        echo "Class Name: " . $classname . "<br>";
        echo "Number of Rows: " . $classResult->num_rows . "<br>";
    }

    // Close the prepared statement
    $sql->close();
} else {
    echo "Class not found";
    echo "Class Name: " . $classname . "<br>";
    echo "Number of Rows: " . $classResult->num_rows . "<br>";
}

if ($classQuery->error) {
    echo "Class Query Error: " . $classQuery->error;
}

// Close prepared statements and connection
$classQuery->close();
$conn->close();
?>