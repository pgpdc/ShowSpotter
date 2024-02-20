<?php
// Database connection
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'indiana';

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// Function to call the API
function callAPI($title)
{
    $title = rawurlencode($title);
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://moviesdatabase.p.rapidapi.com/titles/search/title/$title?exact=false&titleType=movie",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: moviesdatabase.p.rapidapi.com",
            "X-RapidAPI-Key: 8452b825abmshd1549bfe74262fcp138103jsnd5f10dbe3289"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    // Get the movie title from the form
    $title = $_POST['title'];
    
    // Call the API with the movie title
    $data = callAPI($title);

    // Check if the 'results' key is set in the API response
    if (isset($data['results'])) {
        // Display the movie options to the admin
        foreach ($data['results'] as $movie) {
            echo "<p><a href='addMovies.php?id=" . rawurlencode($movie['id']) . "'>" . $movie['titleText']['text'] . "</a></p>";
        }
    }
} else if (isset($_GET['id'])) {
    // The admin has selected a movie, display the form for date and start time
    echo "
    <form action='addMovies.php?id=" . $_GET['id'] . "' method='post'>
        <label for='date'>Date (YYYY-MM-DD):</label><br>
        <input type='date' id='date' name='date' required><br>
        <label for='timestart'>Start Time (HH:MM:SS):</label><br>
        <input type='time' id='timestart' name='timestart' required><br>
        <label for='timeend'>End Time (HH:MM:SS):</label><br>
        <input type='time' id='timeend' name='timeend' required><br>
        <label for='room_id'>Room ID:</label><br>
        <input type='text' id='room_id' name='room_id' required><br>
        <input type='submit' value='Insert'>
    </form>
    ";
    if (isset($_POST['date']) && isset($_POST['timestart']) && isset($_POST['timeend']) && isset($_POST['room_id'])) {
        // The admin has submitted the date and start time
        $id = $_GET['id'];
        $date = $_POST['date'];
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];
        $room_id = $_POST['room_id'];

        // SQL query
        $sql = "INSERT INTO `showtimes` (`imdbid`, `date`, `timestart`, `timeend`, `room_id`) VALUES ('$id', '$date', '$timestart', '$timeend', '$room_id')";

        $stmt = mysqli_prepare($link, $sql);

        if(mysqli_stmt_execute($stmt)) {
            echo "New record created successfully";
        } else {
            echo "Error";
        }
        
    }
} else {
    // No form is submitted, display the form for movie title
    echo "
    <form action='addMovies.php' method='post'>
        <label for='title'>Movie Title:</label><br>
        <input type='text' id='title' name='title' required><br>
        <input type='submit' value='Search'>
    </form>
    ";
}
