<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <style>
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

    body {
        background-color: #F1F1F1;
        font-family: Arial, sans-serif; 
        margin: 0; 
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

    a {
        text-decoration: none; 
        text-align: center;
    }

    button {
        cursor: pointer;
        align-items: center;
    }
    .t {
        text-align: center;
    }

    .y {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .goback-btn {
  padding: 10px 20px;
  font-size: 6px;
  cursor: pointer;
  background-color: grey;
  color: #fff;
  border: none;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
}
</style>
</head>
<body>
<button class="goback-btn" onclick="goBack()">Go Back</button>
<h3 class="t"><u>Pupils Record</u></h3>

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
echo '<a class="y" href="pupil.html"><button>Add New Pupil</button></a><br>';
echo "</br>";  
echo "</br>";  
// Query to retrieve pupils data
$sql = "SELECT pupil_id, classid, fname, lname, address, dinner_id, book_id, birthday, medical_id, parent_count FROM pupils";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table with the id 'pupilsTable'
    echo "<table id='pupilsTable'>";
    echo "
    <tr>
    <th>ID</th>
    <th>Class ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Dinner ID</th>
    <th>Book ID</th>
    <th>Birthday</th>
    <th>Medical ID</th>
    <th>Parent Count</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['pupil_id']}</td>
        <td>{$row['classid']}</td>
        <td>{$row['fname']}</td>
        <td>{$row['lname']}</td>
        <td>{$row['address']}</td>
        <td class='dinnerIdCell' data-id='{$row['dinner_id']}'>{$row['dinner_id']}</td>
        <td class='bookIdCell' data-id='{$row['book_id']}'>{$row['book_id']}</td>
        <td>{$row['birthday']}</td>
        <td>{$row['medical_id']}</td>
        <td>{$row['parent_count']}</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<!-- Script to handle the selection change and highlight the value -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('pupilsTable').addEventListener('click', function (event) {
            var target = event.target;

            // Check if the clicked cell has the correct class
            if (target.classList.contains('dinnerIdCell') || target.classList.contains('bookIdCell')) {
                // Highlight the selected cell
                target.classList.add('highlight');

                // Redirect to the appropriate page with the selected ID after a short delay
                var url = target.classList.contains('dinnerIdCell') ? 'money.php' : 'libary.php';
                setTimeout(function () {
                    window.location.href = url + '?selectedId=' + target.getAttribute('data-id');
                }, 100);
            }
        });
    });

    function findText() {
        var searchText = document.getElementById('search-input').value;
        var pupilsTable = document.getElementById('pupilsTable');
        var searchRegex = new RegExp(searchText, 'gi');

        var tableRows = pupilsTable.getElementsByTagName('tr');

        for (var i = 1; i < tableRows.length; i++) { // Start from 1 to skip the header row
            var row = tableRows[i];
            var cells = row.getElementsByTagName('td');

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                var cellText = cell.innerText || cell.textContent;

                if (searchRegex.test(cellText)) {
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

    function clearHighlights() {
        var pupilsTable = document.getElementById('pupilsTable');
        var tableCells = pupilsTable.getElementsByTagName('td');

        for (var i = 0; i < tableCells.length; i++) {
            tableCells[i].classList.remove('highlight');
        }
    }
    function goBack() {
  window.history.back();
}
</script>

</body>
</html>
