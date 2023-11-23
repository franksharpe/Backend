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
$classname = trim($_POST['classid']);
$medical_info = $_POST['medical_info'];

// Fetch the classid based on the classname using a prepared statement
$classQuery = $conn->prepare("SELECT classid FROM classes WHERE class_name = ?");
$classQuery->bind_param("s", $classname);
$classQuery->execute();
$classResult = $classQuery->get_result();

if ($classResult->num_rows > 0) {
    $row = $classResult->fetch_assoc();
    $classid = $row['classid'];

    // Insert data into the "pupils" table using a prepared statement
    $sqlPupils = $conn->prepare("INSERT INTO pupils (fname, lname, address, birthday, classid) VALUES (?, ?, ?, ?, ?)");
    $sqlPupils->bind_param("ssssi", $fname, $lname, $address, $birthday, $classid);

    if ($sqlPupils->execute()) {
        $lastPupilID = $conn->insert_id;  // Get the last inserted pupil_id

        // Insert data into the "medical_information" table using a prepared statement
        $sqlMedical = $conn->prepare("INSERT INTO medical_information (pupil_id, medical_info) VALUES (?, ?)");
        $sqlMedical->bind_param("is", $lastPupilID, $medical_info);

        if ($sqlMedical->execute()) {
            $lastMedicalID = $conn->insert_id;  // Get the last inserted medical_id

            // Update the "pupils" table with the last inserted medical_id
            $sql_update_pupils = "UPDATE pupils SET medical_id = ? WHERE pupil_id = ?";
            $stmt_update_pupils = $conn->prepare($sql_update_pupils);
            $stmt_update_pupils->bind_param("ii", $lastMedicalID, $lastPupilID);
            $stmt_update_pupils->execute();

            echo "<br>Thank You For Joining St Alphonsus Primary School. <br> Your Pupil ID is: $lastPupilID <br> Your Class: $classname";
        } else {
            echo "Error inserting into medical_information table: " . $sqlMedical->error;
        }

        // Close the prepared statements for medical information and pupils
        $stmt_update_pupils->close();
        $sqlMedical->close();
        $sqlPupils->close();
    } else {
        echo "Error inserting into pupils table: " . $sqlPupils->error;
    }
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