<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <style>
        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        .school-table {
            border-collapse: collapse;
            width: 100%;
        }

        .school-table th, .school-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .school-table th {
            background-color: #1C4E80;
            color: black;
        }

        body {
            background-color: #F1F1F1;
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>

<h3><u>Class Record</u></h3>

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

// Handle Remove Teacher ID
if (isset($_GET['action']) && $_GET['action'] === 'remove_teacher' && isset($_GET['classid'])) {
    $classId = $_GET['classid'];

    // Update the teacherid to null in the classes table
    $updateSql = "UPDATE classes SET teacherid = NULL WHERE classid = $classId";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Teacher ID removed successfully.');</script>";
    } else {
        echo "<script>alert('Error removing Teacher ID: " . $conn->error . "');</script>";
    }
}

// Handle Add Teacher ID
if (isset($_POST['classid']) && isset($_POST['teacherid'])) {
    $classId = $_POST['classid'];
    $teacherId = $_POST['teacherid'];

    // Update the teacherid in the classes table
    $updateSql = "UPDATE classes SET teacherid = $teacherId WHERE classid = $classId";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Teacher ID added successfully.');</script>";
    } else {
        echo "<script>alert('Error adding Teacher ID: " . $conn->error . "');</script>";
    }
}

// Query to retrieve pupils data
$sql = "SELECT classid, class_name, teacherid, class_capacity FROM classes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table
    echo "<div class='table-container' , table id='pupilsTable'>";
    echo "<table class='school-table'>";
    echo "
    <tr>
    <th>ID</th>
    <th>Class Name</th>
    <th>Teacher ID</th>
    <th>Class Capacity</th>
    <th>Remove Teacher ID</th>
    <th>Add Teacher ID</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['classid']}</td>
        <td>{$row['class_name']}</td>
        <td class='dinnerIdCell' data-id='{$row['teacherid']}'>{$row['teacherid']}</td>
        <td>{$row['class_capacity']}</td>
        <td>
    <button class='updateButton' onclick=\"location.href='classview.php?action=remove_teacher&classid={$row['classid']}'\">
        Remove
    </button>
</td>
<td>
    <form method='post'>
        <input type='hidden' name='classid' value='{$row['classid']}'>
        <label for='teacherIdInput{$row['classid']}'>Enter Teacher ID:</label>
        <input type='text' id='teacherIdInput{$row['classid']}' name='teacherid'>
        <button type='submit' class='addTaButton'>Add</button>
    </form>
</td>
        </tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('pupilsTable').addEventListener('click', function (event) {
            var target = event.target;

            // Check if the clicked cell has the correct class
            if (target.classList.contains('dinnerIdCell')) {
                // Remove the 'highlight' class from all cells in the table
                var cells = document.querySelectorAll('.dinnerIdCell');
                cells.forEach(function (cell) {
                    cell.classList.remove('highlight');
                });

                // Highlight the selected cell
                target.classList.add('highlight');

                // Redirect to the appropriate page with the selected ID after a short delay
                var url = 'index.php';
                setTimeout(function () {
                    window.location.href = url + '?selectedId=' + target.getAttribute('data-id');
                }, 100);
            }
        });
    });
</script>

</body>
</html>
