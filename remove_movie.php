<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'indiana';

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['imdbid']) && isset($_POST['roomId']) && isset($_POST['startTime']) && isset($_POST['endTime'])) {
        $imdbid = $_POST['imdbid'];
        $roomId = $_POST['roomId'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $query = "DELETE FROM `showtimes` WHERE `imdbid` = ? AND `room_id` = ? AND `timestart` = ? AND `timeend` = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("ssss", $imdbid, $roomId, $startTime, $endTime);
        $stmt->execute();
        echo "Movie removed successfully";
    } else {
        echo "Not all required data provided";
    }
} else {
    echo "Invalid request method";
}
?>
