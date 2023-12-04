<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Library Records</u></h3>
    <style>
        body {
            background-color: #F1F1F1;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h3 {
            background-color: #1C4E80;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #1C4E80;
            color: #fff;
        }

        .highlight {
            background-color: yellow;
            cursor: pointer;
        }

        #find-bar {
            padding: 10px;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 20px;
        }

        #search-input {
            padding: 5px;
            margin-right: 5px;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
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
echo '<a href="libary.html"><button>Add New</button></a><br>';
echo "</br>";  
echo "</br>"; 
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

<script>
    // Function to find and highlight text in the table
    function findText() {
        var searchText = document.getElementById('search-input').value.toLowerCase();
        var libraryTable = document.getElementById('libraryTable');
        var rows = libraryTable.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName('td');
            var found = false;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                var text = cell.textContent.toLowerCase();

                if (text.includes(searchText)) {
                    found = true;
                    cell.classList.add('highlight');
                } else {
                    cell.classList.remove('highlight');
                }
            }

            if (found) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    // Function to clear the highlights
    function clearHighlights() {
        var libraryTable = document.getElementById('libraryTable');
        var cells = libraryTable.getElementsByTagName('td');

        for (var i = 0; i < cells.length; i++) {
            cells[i].classList.remove('highlight');
        }
    }
</script>

</body>
</html>
