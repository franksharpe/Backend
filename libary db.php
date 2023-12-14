<?php
// Database connection 
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "school";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$book_name = $_POST['book_name'];
$pupil_id = $_POST['pupil_id'];

// Check if the book_name already exists in the library
$sql_select = "SELECT * FROM libary WHERE book_name = '$book_name'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Book exists, so update the record
    $random_date = date('Y-m-d', strtotime('+'.mt_rand(20, 200).' days'));

    // SQL query to update the library table with pupil_id and hand_in date
    $sql_update_libary = "UPDATE libary SET pupil_id = '$pupil_id', hand_in = '$random_date' WHERE book_name = '$book_name'";
    
    if ($conn->query($sql_update_libary) === TRUE) {
        // Now update the pupils table with the corresponding book_id
        $sql_update_pupils = "UPDATE pupils SET book_id = (SELECT book_id FROM libary WHERE book_name = '$book_name') WHERE pupil_id = '$pupil_id'";
        
        if ($conn->query($sql_update_pupils) === TRUE) {
            // Display the hand_in date to the user
            echo "Your Hand in date is: ". $random_date;
            // Add a reset button to return to the home page
            echo '<input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
        } else {
            // Display an error message if the pupils table update fails
            echo "Error" . $conn->error;
            echo '<input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
        }
    } else {
        // Display an error message if the library table update fails
        echo "Error" . $conn->error;
        echo '<input type="reset" id="return" value="Return" onclick="location.href=\'home.html\'" /> <br>';
    }
}

// Close the database connection
$conn->close();
?>
