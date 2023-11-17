<?php
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $conn = new mysqli('localhost','root','','school');
    if ($conn->connect_error) {
        die(''. $conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into form(fname,lname)
        values(?,?)")
        $stmt ->bind_param("ss", $fname, $lname,);
        $stmt->execute();
        echo"submitted";
        $stmt -> close();
        $conn ->close();
    }
?>