<?php

    $host = "localhost";
    $username = "root";
    $password =  "";
    $database = "fileDatabase";

    $conn = mysqli_connect($host, $username, $password, $database);
    if(!$conn) {
     echo (mysqli_connect_error());
    }
?>