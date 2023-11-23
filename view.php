<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School.</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
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
            background-color: #f2f2f2;
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

// Query to retrieve pupils data
$sql = "SELECT pupil_id, classid, fname, lname, address, dinner_id, book_id, birthday, medical_id FROM pupils";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Class ID</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Dinner ID</th><th>Book ID</th><th>Birthday</th><th>Medical ID</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['pupil_id']}</td><td>{$row['classid']}</td><td>{$row['fname']}</td><td>{$row['lname']}</td><td>{$row['address']}</td><td>{$row['dinner_id']}</td><td>{$row['book_id']}</td><td>{$row['birthday']}</td><td>{$row['medical_id']}</td></tr>";
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