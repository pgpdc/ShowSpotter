<?php

    //Add session_start
    session_start();
    
    $user = $_SESSION['name'];
    $DATABASE_HOST ='localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = $_SESSION["theater"];
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
    if (!$conn){
        die("Conection failed:".mysqli_connect_error());
    }
?>