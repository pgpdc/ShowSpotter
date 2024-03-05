<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'indiana';

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$start = $_POST['start'];
$end = $_POST['end'];

$sql = "SELECT `imdbid`, `date`, `timestart`, `timeend`, `room_id` FROM `showtimes` WHERE `date` BETWEEN '$start' AND '$end'";
$result = mysqli_query($link, $sql);

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = array(
        'id' => $row['imdbid'],
        'start' => $row['date'] . 'T' . $row['timestart'],
        'end' => $row['date'] . 'T' . $row['timeend'],
        'resourceId' => $row['room_id']
    );
}

echo json_encode($events);
?>
