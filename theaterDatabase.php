<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';

// $DATABASE_NAME = $_GET["theater"];


if (isset($_SESSION["theater"])) {
    $DATABASE_NAME = $_SESSION["theater"];
    try {
        $link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    } catch (mysqli_sql_exception $e) {
        echo "<script type='text/javascript'>
                alert('Oops! Something went wrong. Please try again later.');
                window.location = '/ShowSpotter/index.php';
            </script>";
        exit;
    }
} else {
    echo "<script type='text/javascript'>
                alert('Please select a theater!');
                window.location = '/ShowSpotter/index.php';
            </script>";
}
