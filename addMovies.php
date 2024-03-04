<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.html");
}
// Database connection
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
    echo "
    <style>
        body {
            display: flex;
            justify-content: flex-start; 
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            flex-direction: column;
            padding-top: 50px; 
        }
        div {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            width: 80%;
            margin-left: auto; 
            margin-right: auto; 
        }
        h2 {
            font-weight: bold;
            text-align: center; 
        }
        p {
            margin-bottom: 5px;
            text-align: center; 
        }
        img {
            width: 200px;
            display: block; 
            margin-left: auto; 
            margin-right: auto; 
        }
    </style>
";

    if (isset($data['results'])) {
        // Display the movie options to the admin
        foreach ($data['results'] as $movie) {
            // Check if the movie has additional information
            if (isset($movie['releaseYear']) && isset($movie['releaseDate']) && isset($movie['primaryImage'])) {
                echo "<div>";
                echo "<h2><a href='addMovies.php?id=" . rawurlencode($movie['id']) . "'>" . $movie['titleText']['text'] . "</a></h2>";

                // Display the movie details
                if (isset($movie['releaseYear'])) {
                    echo "<p><strong>Release Year:</strong> " . $movie['releaseYear']['year'] . "</p>";
                }
                if (isset($movie['releaseDate'])) {
                    echo "<p><strong>Release Date:</strong> " . $movie['releaseDate']['day'] . "-" . $movie['releaseDate']['month'] . "-" . $movie['releaseDate']['year'] . "</p>";
                }
                if (isset($movie['primaryImage'])) {
                    echo "<p><img src='" . $movie['primaryImage']['url'] . "' alt='" . $movie['primaryImage']['caption']['plainText'] . "'></p>";
                }
                echo "</div>";
            }
        }
    }
} else if (isset($_GET['id'])) {
    // The admin has selected a movie, display the form for date and start time
    echo "
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type='text'], input[type='date'], input[type='time'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type='submit'] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
        }
        input[type='submit']:hover {
            background-color: #0056b3;
        }
    </style>
    <form action='addMovies.php?id=" . $_GET['id'] . "' method='post'>
        <label for='date'>Date (YYYY-MM-DD):</label>
        <input type='date' id='date' name='date' required>
        <label for='timestart'>Start Time (HH:MM:SS):</label>
        <input type='time' id='timestart' name='timestart' required>
        <label for='timeend'>End Time (HH:MM:SS):</label>
        <input type='time' id='timeend' name='timeend' required>
        <label for='room_id'>Room ID:</label>
        <input type='text' id='room_id' name='room_id' required>
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

        if (mysqli_stmt_execute($stmt)) {
            echo "<script type='text/javascript'>
                    alert('New record created successfully');
                    window.location = 'addMovies.php';
                  </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error');
                    window.location = 'addMovies.php';
                  </script>";
        }
    }
} else {
    // No form is submitted, display the form for movie title
    echo "
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type='text'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type='submit'] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
        }
        input[type='submit']:hover {
            background-color: #0056b3;
        }
    </style>
    <form action='addMovies.php' method='post'>
        <label for='title'>Movie Title:</label>
        <input type='text' id='title' name='title' required>
        <input type='submit' value='Search'>
    </form>
    ";
}
