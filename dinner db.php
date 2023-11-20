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
$pupil_id = $_POST['pupil_id'];
$amount = $_POST['amount'];

// Check if there is an existing record for the pupil_id in the money table
$checkExistingRecordSQL = "SELECT * FROM money WHERE pupil_id = '$pupil_id'";
$result = $conn->query($checkExistingRecordSQL);

if ($result->num_rows > 0) {
    // If a record exists, update the amount
    $selectDinnerIdSQL = "SELECT dinner_id, amount FROM money WHERE pupil_id = '$pupil_id' ORDER BY dinner_id DESC LIMIT 1";
    $result = $conn->query($selectDinnerIdSQL);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dinner_id = $row['dinner_id'];
        $current_amount = $row['amount'];
        $money = $current_amount + $amount;

        $updateAmountSQL = "UPDATE money SET amount = amount + '$amount' WHERE pupil_id = '$pupil_id'";
        if ($conn->query($updateAmountSQL) === TRUE) {
            // Update the dinner_id in the pupils table
            $updatePupilsSQL = "UPDATE pupils SET dinner_id = '$dinner_id' WHERE pupil_id = '$pupil_id'";
            if ($conn->query($updatePupilsSQL) === TRUE) {
                echo "Amount updated successfully for pupil_id: $pupil_id.<br> Current Amount: £$money";
            } else {
                echo "Error updating " . $conn->error;
            }
        } else {
            echo "Error updating amount: " . $conn->error;
        }
    } else {
        echo "Error retrieving" . $conn->error;
    }
} else {
    // If no record exists, insert a new record
    $insertDataSQL = "INSERT INTO money (pupil_id, amount) VALUES ('$pupil_id', '$amount')";
    $updatePupilsSQL = "UPDATE pupils SET dinner_id = '$dinner_id' WHERE pupil_id = '$pupil_id'";
    if ($conn->query($insertDataSQL) === TRUE) {
        echo "Data inserted successfully for pupil_id: $pupil_id <br> Amount: £$amount";
    } else {
        echo "Error inserting data " . $conn->error;
    }
}

// Close connection
$conn->close();
?>