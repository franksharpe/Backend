<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School - Library Records</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Library Records</u></h3>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #1C4E80;
        }
        body {
            background-color: #F1F1F1;
        }

        .highlight {
            background-color: yellow;  /* You can change this to the desired highlight color */
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Connect to MySQL server
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected book ID from the AJAX request
$selectedBookId = isset($_GET['selectedId']) ? $_GET['selectedId'] : null;

// Query to retrieve library data
$sql = "SELECT book_id, book_name, pupil_id, hand_in FROM libary";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table
    echo "<table id='libraryTable'>";
    echo "
    <tr>
    <th>ID</th>
    <th>Book Name</th>
    <th>Pupil ID</th>
    <th>Hand In Date</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        $highlightClass = ($selectedBookId !== null && $selectedBookId == $row['book_id']) ? 'highlight' : '';
        echo "<tr class='$highlightClass'>
        <td>{$row['book_id']}</td>
        <td>{$row['book_name']}</td>
        <td>{$row['pupil_id']}</td>
        <td>{$row['hand_in']}</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

</body>
</html>
