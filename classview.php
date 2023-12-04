<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
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
            color: white;
        }

        .updateButton, .addTaButton {
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
        }

        .highlight {
            background-color: yellow;
            cursor: pointer;
        }

        .update-form input[type="number"] {
            padding: 8px;
            width: 80px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        .update-form button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .update-form button:hover {
            background-color: #45a049;
        }

        .update-form {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

<h3><u>Class Record</u></h3>
<br>
<br>
<br>

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

    // Update the teacherid to null in the classes table using prepared statement
    $updateSql = "UPDATE classes SET teacherid = NULL WHERE classid = ?";
    $stmt = $conn->prepare($updateSql);

    // Bind parameters
    $stmt->bind_param("i", $classId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>window.location.reload();</script>";
    } else {
        echo "<script>alert('Error removing Teacher ID: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Handle Add Teacher ID
if (isset($_POST['classid']) && isset($_POST['teacherid'])) {
    $classId = $_POST['classid'];
    $teacherId = $_POST['teacherid'];

    // Check if the teacher is already assigned to another class
    $checkQuery = "SELECT * FROM classes WHERE teacherID = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $teacherId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "The teacher is already assigned to another class<br>";
    } else {
        // Update the teacherid in the classes table using prepared statement
        $updateSql = "UPDATE classes SET teacherid = ? WHERE classid = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $teacherId, $classId);

        if ($updateStmt->execute()) {
            echo "<script>
                window.location.reload();
              </script>";
        } else {
            echo "<script>alert('Error adding Teacher ID: " . $updateStmt->error . "');</script>";
        }

        $updateStmt->close();
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
    <th>Update Class Capacity</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['classid']}</td>
            <td>{$row['class_name']}</td>
            <td class='teacherIdCell' data-id='{$row['teacherid']}'>{$row['teacherid']}</td>
            <td>{$row['class_capacity']}</td>
            <td>
                <button class='updateButton' onclick=\"location.href='classview.php?action=remove_teacher&classid={$row['classid']}'\">
                    Remove
                </button>
            </td>
            <td>
                <form method='post'>
                    <input type='hidden' name='classid' value='{$row['classid']}'>
                    <label for='teacherIdSelect{$row['classid']}'>Select Teacher ID:</label>
                    <select id='teacherIdSelect{$row['classid']}' name='teacherid'>
                        <option value=''>Select Teacher ID</option>";

        // Fetch teacher IDs from the teachers table
        $teacherSql = "SELECT teacherid FROM teachers";
        $teacherResult = $conn->query($teacherSql);

        if ($teacherResult->num_rows > 0) {
            while ($teacherRow = $teacherResult->fetch_assoc()) {
                echo "<option value='{$teacherRow['teacherid']}'>{$teacherRow['teacherid']}</option>";
            }
        }

        echo "</select>
                    <button type='submit' class='addTaButton'>Add</button>
                </form>
            </td>
            <td class='update-form'>
                <form method='post'>
                    <input type='hidden' name='classid' value='{$row['classid']}'>
                    <label for='classCapacityInput{$row['classid']}'>Update Class Capacity:</label>
                    <input type='number' id='classCapacityInput{$row['classid']}' name='classcapacity' min='0'>
                    <button type='submit' class='updateButton'>Update</button>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

if (isset($_POST['classid']) && isset($_POST['classcapacity'])) {
    $classId = $_POST['classid'];
    $classCapacity = $_POST['classcapacity'];

    // Update the class capacity in the classes table using prepared statement
    $updateCapacitySql = "UPDATE classes SET class_capacity = ? WHERE classid = ?";
    $stmt = $conn->prepare($updateCapacitySql);

    // Bind parameters
    $stmt->bind_param("ii", $classCapacity, $classId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
                window.location.reload();
              </script>";
    } else {
        echo "<script>alert('Error updating class capacity: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('pupilsTable').addEventListener('click', function (event) {
            var target = event.target;

            // Check if the clicked cell has the correct class
            if (target.classList.contains('teacherIdCell')) {
                // Remove the 'highlight' class from all cells in the table
                var cells = document.querySelectorAll('.teacherIdCell');
                cells.forEach(function (cell) {
                    cell.classList.remove('highlight');
                });

                // Highlight the selected cell
                target.classList.add('highlight');

                // Redirect to the appropriate page with the selected ID after a short delay
                var url = 'index.php';
                var selectedId = target.getAttribute('data-id');
                setTimeout(function () {
                    window.location.href = `${url}?selectedId=${selectedId}`;
                }, 100);
            }
        });
    });
</script>

</body>
</html>