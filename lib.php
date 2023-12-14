<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>St Alphonsus Primary School.</title>

    <!-- icon link -->
    <link rel="icon" type="image/x-icon" href="favicon_io/favicon.ico">

</head>
<style>
    /* Styling for the body and general layout */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    /* Styling for the heading 2 */
    h2 {
        margin-top: 20px;
        text-decoration: underline;
    }

    /* Styling for heading 3 */
    h3 {
        margin-top: 10px;
    }

    /* Styling for the form container */
    form {
        max-width: 400px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Styling for labels in the form */
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    /* Styling for text and number input fields */
    input[type="number"],
    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Styling for the submit button */
    input[type="submit"] {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Styling for the submit button on hover */
    input[type="submit"]:hover {
        background-color: #2980b9;
    }
</style>

<!-- Heading -->
<h2><u>libary</u></h2>

<!-- Subheading -->
<h3>Insert Book:</h3>

<body>
    <!-- Form for inserting a book into the library -->
    <form id="myForm" onsubmit="return validateForm()" action="libary db.php" method="post">

        <!-- Input field for Pupil ID -->
        <label for="pupil_id">Pupil ID:</label>
        <input type="number" name="pupil_id" id="pupil_id" required placeholder="Pupil ID"><br><br>

        <!-- Dropdown menu for selecting a book name -->
        <label for="book_name">Book Name:</label>
        <select name="book_name" id="book_name" required>
            <?php
                // Database connection parameters
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $database = "school";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch book names from the libary table
                $sql_select_books = "SELECT book_name FROM libary";
                $result_books = $conn->query($sql_select_books);

                // Display book names as options in the dropdown
                while ($row = $result_books->fetch_assoc()) {
                    echo '<option value="' . $row['book_name'] . '">' . $row['book_name'] . '</option>';
                }

                // Close the database connection
                $conn->close();
            ?>
        </select><br><br>

        <!-- Submit button for submitting the form -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<script>
     document.getElementById("myForm").addEventListener("submit", validateForm);
    function validateForm() {
        var pupil_id = document.forms["myForm"]["pupil_id"].value;
        var book_name = document.forms["myForm"]["book_name"].value;

        // checks pupilID isnt empty
        if (pupil_id === "") {
            alert("Pupil ID must be filled out");
            return false;
        }

      
    }

    </script>
