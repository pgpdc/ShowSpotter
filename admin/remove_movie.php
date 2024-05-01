<?php
session_start();
require("../theaterDatabase.php");

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
