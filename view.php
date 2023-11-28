<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h3><u>Pupils Record</u></h3>
<body>
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
    </style>

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
echo '<a href="pupil.html"><button>Add New Pupil</button></a><br>';
echo "</br>";  
echo "</br>";  
// Query to retrieve pupils data
$sql = "SELECT pupil_id, classid, fname, lname, address, dinner_id, book_id, birthday, medical_id, parent_count FROM pupils";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table
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
</script>

</body>
</html>
