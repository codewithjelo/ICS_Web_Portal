<?php
    $server_name = "localhost:3308";
    $username = "root";
    $password = "";
    $db_name = "ics_db";

    $conn = mysqli_connect($server_name, $username, $password, $db_name);

    if (!$conn) {
        die("Connection Failed!".mysqli_connect_error());
    } 
?>   