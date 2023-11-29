<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Teacher Records</u></h3>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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

        .updateButton {
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

        .addTaButton {
            background-color: green;
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
echo '<a href="teacher.html"><button>Add New Teacher</button></a><br>';
echo "</br>";
echo "</br>";

// Query to retrieve teacher data
$sql = "SELECT teacherid, fname, lname, address, phone, ta_id FROM teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for teachers in a table with the id 'teachersTable'
    echo "<table id='teachersTable'>";
    echo "
    <tr>
    <th>ID</th>
    <th>First name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Phone Number</th>
    <th>Teaching Assistant</th>
    <th>Remove</th>
    <th>Add</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['teacherid']}</td>
        <td>{$row['fname']}</td>
        <td>{$row['lname']}</td>
        <td>{$row['address']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['ta_id']}</td>
        <td><button class='updateButton' data-teacherid='{$row['teacherid']}'>Remove TA</button></td>
        <td>
        <form id='addTaForm{$row['teacherid']}'>
            <label for='taIdInput{$row['teacherid']}'>Enter TA ID:</label>
            <input type='text' id='taIdInput{$row['teacherid']}' name='taIdInput{$row['teacherid']}'>
            <button type='button' class='addTaButton' data-teacherid='{$row['teacherid']}'>Add TA</button>
        </form>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Output text between tables
echo "<h3><u>Teaching Assistants:</u></h3>";

// Free the result set
$result->free_result();

// Second Query to retrieve teaching assistant data
$sql = "SELECT ta_id, fname, lname, address, phone FROM ta";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for teaching assistants in a table
    echo "<table>";
    echo "
    <tr>
    <th>ID</th>
    <th>First name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Phone Number</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['ta_id']}</td>
        <td>{$row['fname']}</td>
        <td>{$row['lname']}</td>
        <td>{$row['address']}</td>
        <td>{$row['phone']}</td>
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
    var teachersTable = document.getElementById('teachersTable');
    var rows = teachersTable.getElementsByTagName('tr');

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
    var teachersTable = document.getElementById('teachersTable');
    var cells = teachersTable.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        cells[i].classList.remove('highlight');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Highlight the selected cell in index.php
    var selectedId = '<?php echo isset($_GET['selectedId']) ? $_GET['selectedId'] : '' ?>';
    if (selectedId !== '') {
        console.log('Selected ID:', selectedId);
        var selectedCell = document.querySelector('.updateButton[data-teacherid="' + selectedId + '"]');
        if (selectedCell) {
            console.log('Selected Cell Found:', selectedCell);
            // Highlight the entire row
            selectedCell.parentElement.parentElement.classList.add('highlight');
            console.log('Highlight applied successfully. Data ID:', selectedCell.getAttribute('data-teacherid'));
        } else {
            console.log('Selected cell not found. Checking all cells...');
            // Check all cells to see if any have a data-teacherid attribute
            var allCells = document.querySelectorAll('.updateButton');
            allCells.forEach(function (cell) {
                console.log('Cell Data ID:', cell.getAttribute('data-teacherid'));
            });
        }
    } else {
        console.log('No selected ID.');
    }

    // Add an event listener to all buttons with the class 'updateButton'
    document.querySelectorAll(".updateButton").forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the teacherid from the button's data attribute
            var teacherId = this.getAttribute('data-teacherid');
            console.log('Update Button Clicked. Teacher ID:', teacherId);

            // Send an AJAX request to update the database and set the column to null
            fetch("update_database.php?teacherid=" + teacherId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Update Response:', data);  // Log the response for debugging
                    // Reload the page to reflect changes in the table
                    location.reload();
                })
                .catch(error => {
                    console.error('Error during update:', error);
                });
        });
    });

    // Add an event listener to all buttons with the class 'addTaButton'
    document.querySelectorAll(".addTaButton").forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the teacherid from the button's data attribute
            var teacherId = this.getAttribute('data-teacherid');
            console.log('Add TA Button Clicked. Teacher ID:', teacherId);

            // Get the TA ID from the input field
            var taId = document.getElementById('taIdInput' + teacherId).value;
            console.log('TA ID:', taId);

            // Validate that TA ID is not empty
            if (taId.trim() === '') {
                alert('Please enter a valid TA ID.');
                return;
            }

            // Send an AJAX request to update the database and set ta_id to the provided value
            fetch("add_ta.php?teacherid=" + teacherId + "&taId=" + taId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Add TA Response:', data);  // Log the response for debugging
                    // Reload the page to reflect changes in the table
                    location.reload();
                })
                .catch(error => {
                    console.error('Error during addition:', error);
                });
        });
    });
});
</script>

</body>

</html>
