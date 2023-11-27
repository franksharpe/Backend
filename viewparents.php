<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School.</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Parents Records</u></h3>
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

        .removeButton {
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
        .ard{
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
    // Output data in a table
    echo "<table>";
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
</script>

</body>
</html>
