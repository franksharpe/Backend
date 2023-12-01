<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "school";

$conn = new mysqli($servername, $username, $password, $database);
// Get form data
$book_name = $_POST['book_name'];
$pupil_id = $_POST['pupil_id'];

// Update data if book_name already exists, otherwise insert a new record
$sql_select = "SELECT * FROM libary WHERE book_name = '$book_name'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Book exists, so update the record
    $random_date = date('Y-m-d', strtotime('+'.mt_rand(20, 200).' days'));
    $sql_update_libary = "UPDATE libary SET pupil_id = '$pupil_id', hand_in = '$random_date' WHERE book_name = '$book_name'";
    
    if ($conn->query($sql_update_libary) === TRUE) {
        // Now update the pupils table with the corresponding pupil_id
        $sql_update_pupils = "UPDATE pupils SET book_id = (SELECT book_id FROM libary WHERE book_name = '$book_name') WHERE pupil_id = '$pupil_id'";
        
        if ($conn->query($sql_update_pupils) === TRUE) {
            echo "Your Hand in date is: ". $random_date;
        } else {
            echo "Error" . $conn->error;
        }
    } else {
        echo "Error" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>