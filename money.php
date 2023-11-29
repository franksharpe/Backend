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
            background-color: yellow;
            cursor: pointer;
        }

        #find-bar {
            padding: 10px;
            background-color: #f0f0f0;
            text-align: center;
        }

        #search-input {
            padding: 5px;
        }
    </style>
</head>
<body>

<div id="find-bar">
    <input type="text" id="search-input" placeholder="Type to search">
    <button onclick="findText()">Find</button>
    <button onclick="clearHighlights()">Clear</button>
</div>

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
        echo "<tr class='$highlightClass'>
        <td>{$row['dinner_id']}</td>
        <td>{$row['pupil_id']}</td>
        <td>{$row['amount']}</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<!-- Script to handle the find bar -->
<script>
    function findText() {
        var searchText = document.getElementById('search-input').value;
        var rows = document.querySelectorAll('table tr');

        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName('td');
            var found = false;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell.innerHTML.toLowerCase().indexOf(searchText.toLowerCase()) > -1) {
                    found = true;
                    break;
                }
            }

            if (found) {
                row.classList.add('highlight');
            } else {
                row.classList.remove('highlight');
            }
        }
    }

    function clearHighlights() {
        var rows = document.querySelectorAll('table tr');
        for (var i = 1; i < rows.length; i++) {
            rows[i].classList.remove('highlight');
        }
    }
</script>

</body>
</html>
