<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Parents Records</u></h3>
    <style>
        body {
            background-color: #F1F1F1;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h3 {
            text-align: center;
            background-color: #1C4E80;
            color: #fff;
            padding: 20px;
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

        .removeButton, .ard {
            background-color: #ff6f6f;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .ard {
            background-color: green;
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
            display: block;
            margin-top: 10px;
        }

        button {
            cursor: pointer;
            align-items: center;
        }

        .t {
            text-align: center;
        }

        .y {
            align-items: center;
            text-align: center;
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
echo '<a href="parent.html"><button>Add New Parent</button></a><br>';
echo "</br>";  
echo "</br>"; 
// Check if a pupil_id removal request is received
if (isset($_GET['removePupilId'])) {
    $parentId = $_GET['removePupilId'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE parents SET pupil_id = NULL WHERE Parent_id = ?");
    $stmt->bind_param("i", $parentId);
    $stmt->execute();
    $stmt->close();
}

// Check if a pupil_id addition request is received
if (isset($_POST['addPupilId'])) {
    $parentId = $_POST['parent_id'];
    $pupilId = $_POST['pupil_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE parents SET pupil_id = ? WHERE Parent_id = ?");
    $stmt->bind_param("ii", $pupilId, $parentId);
    $stmt->execute();
    $stmt->close();
}

// Query to retrieve parents data
$sql = "SELECT Parent_id, fname, lname, phone, pupil_id FROM parents";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table with the id 'parentsTable'
    echo "<table id='parentsTable'>";
    echo "
    <tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Phone Number</th>
    <th>Pupil ID</th>
    <th>Remove</th>
    <th>Add Pupil ID</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['Parent_id']}</td>
        <td>{$row['fname']}</td>
        <td>{$row['lname']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['pupil_id']}</td>
        <td><button class='removeButton' data-parentid='{$row['Parent_id']}'>Remove Pupil ID</button></td>
        <td>
        <form method='post' action='viewparents.php'>
            <input type='hidden' name='parent_id' value='{$row['Parent_id']}'>
            <label for='pupil_id' >Enter Pupil ID:</label>
            <input type='text' name='pupil_id' required>
            <input type='submit' class='ard' name='addPupilId' value='Add Pupil ID'>
        </form>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<!-- Script to handle the button click event -->
<script>
    // Add an event listener to all buttons with the class 'removeButton'
    document.querySelectorAll(".removeButton").forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the parent ID from the button's data attribute
            var parentId = this.getAttribute('data-parentid');

            // Send an AJAX request to update the database and set the column to null
            fetch("removeid.php?removePupilId=" + parentId, {
                method: 'GET'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data);  // Log the response for debugging
                    // Reload the page to reflect changes in the table
                    location.reload();
                })
                .catch(error => {
                    console.error('Error during update:', error);
                });
        });
    });

    function findText() {
        var searchText = document.getElementById('search-input').value.toLowerCase();
        var parentsTable = document.getElementById('parentsTable');
        var tableRows = parentsTable.getElementsByTagName('tr');

        for (var i = 1; i < tableRows.length; i++) {
            var row = tableRows[i];
            var cells = row.getElementsByTagName('td');
            var found = false;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                var cellText = cell.innerText.toLowerCase() || cell.textContent.toLowerCase();

                if (cellText.indexOf(searchText) > -1) {
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

    function clearHighlights() {
        var parentsTable = document.getElementById('parentsTable');
        var tableCells = parentsTable.getElementsByTagName('td');

        for (var i = 0; i < tableCells.length; i++) {
            tableCells[i].classList.remove('highlight');
        }
    }
</script>

</body>
</html>
