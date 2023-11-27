<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School.</title>
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">
    <h2>Teacher Records</h2>
    <h3><u>Teachers:</u></h3>
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
        body{
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
        .addTaButton{
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

// Query to retrieve teacher data
$sql = "SELECT teacherid, fname, lname, address, phone, ta_id FROM teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for teachers in a table
    echo "<table>";
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

<!-- Script to handle the button click event -->
<script>
    // Add an event listener to all buttons with the class 'updateButton'
    document.querySelectorAll(".updateButton").forEach(function(button) {
        button.addEventListener("click", function() {
            // Get the teacherid from the button's data attribute
            var teacherId = this.getAttribute('data-teacherid');

            // Send an AJAX request to update the database and set the column to null
            fetch("update_database.php?teacherid=" + teacherId)
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

    // Add an event listener to all buttons with the class 'addTaButton'
    document.querySelectorAll(".addTaButton").forEach(function(button) {
        button.addEventListener("click", function() {
            // Get the teacherid from the button's data attribute
            var teacherId = this.getAttribute('data-teacherid');

            // Get the TA ID from the input field
            var taId = document.getElementById('taIdInput' + teacherId).value;

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
                    console.log(data);  // Log the response for debugging
                    // Reload the page to reflect changes in the table
                    location.reload();
                })
                .catch(error => {
                    console.error('Error during addition:', error);
                });
        });
    });
</script>


</body>
</html>
