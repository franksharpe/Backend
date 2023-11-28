<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Money Records</u></h3>
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
echo "</br>";  
echo '<a href="dinner.html"><button>Add New</button></a><br>';
echo "</br>";  
echo "</br>"; 
// Get the selected dinner ID from the AJAX request or URL parameter
$selectedDinnerId = isset($_GET['selectedId']) ? intval($_GET['selectedId']) : null;

// Check if $selectedDinnerId is a valid integer before using it in the query
if (!is_null($selectedDinnerId) && is_int($selectedDinnerId)) {
    // Query to check if the selected dinner ID exists in the money table
    $sql = "SELECT dinner_id FROM money WHERE dinner_id = $selectedDinnerId";
    $result = $conn->query($sql);

    // Output highlighting or not based on the result
    if ($result && $result->num_rows > 0) {
        echo "<style>.highlight { background-color: yellow; }</style>";
    } else {
        echo "<style>.highlight { background-color: transparent; }</style>";
    }
}

// Query to retrieve pupils data
$sql = "SELECT dinner_id, pupil_id, amount FROM money";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table
    echo "<table>";
    echo "
    <tr>
    <th>ID</th>
    <th>Pupil ID</th>
    <th>Amount (£)</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        $highlightClass = ($selectedDinnerId !== null && $selectedDinnerId == $row['dinner_id']) ? 'highlight' : '';
        echo "<tr>
        <td class='$highlightClass'>{$row['dinner_id']}</td>
        <td class='$highlightClass'>{$row['pupil_id']}</td>
        <td class='$highlightClass'>{$row['amount']}</td>
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
