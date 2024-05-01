<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.php");
}

require("../theaterDatabase.php");

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
        ::-webkit-scrollbar { width: 0px; height: 0px; } ::-webkit-scrollbar-button { width: 0px; height: 0px; } ::-webkit-scrollbar-thumb { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-thumb:hover { background: transparent; } ::-webkit-scrollbar-thumb:active { background: transparent; } ::-webkit-scrollbar-track { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-track:hover { background: transparent; } ::-webkit-scrollbar-track:active { background: transparent; } ::-webkit-scrollbar-corner { background: transparent; }
        .movies-container {
            display: flex;
            justify-content: flex-start; 
            align-items: center;
            height: 100vh;

            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
             
            flex-wrap: wrap;
        }
        .movies {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            width: 21vh;
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
            width: 20vh;
            display: block; 
            margin-left: auto; 
            margin-right: auto; 
        }
        .admin-home-button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }
        .admin-home-button:hover {
            background-color: #0056b3;
        }
        .button-container {
            display: flex;
            justify-content: center;
        }
    </style>
";

    if (isset($data['results'])) {
        // Display the movie options to the admin
        echo "<div class='button-container'>
        <a href='admin.php' class='admin-home-button'>Admin Home</a>
    </div>
    <div class='movies-container'>";
        foreach ($data['results'] as $movie) {
            // Check if the movie has additional information
            if (isset($movie['releaseYear']) && isset($movie['releaseDate']) && isset($movie['primaryImage'])) {
                echo "<div class='movies'>";
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
        echo "</div>";
    }
} else if (isset($_GET['id'])) {
    // The admin has selected a movie, display the form for date and start time
    echo "
    <style>
        ::-webkit-scrollbar { width: 0px; height: 0px; } ::-webkit-scrollbar-button { width: 0px; height: 0px; } ::-webkit-scrollbar-thumb { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-thumb:hover { background: transparent; } ::-webkit-scrollbar-thumb:active { background: transparent; } ::-webkit-scrollbar-track { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-track:hover { background: transparent; } ::-webkit-scrollbar-track:active { background: transparent; } ::-webkit-scrollbar-corner { background: transparent; }
        body {
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
        input[type='text'], input[type='date'], input[type='time'], select{
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
        .admin-home-button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }
        .admin-home-button:hover {
            background-color: #0056b3;
        }
        .button-container, .form-container {
            display: flex;
            justify-content: center;
        }
        .form-container {
            padding: 10%;
        }
    </style>
    <div class='button-container'>
    <a href='admin.php' class='admin-home-button'>Admin Home</a>
</div>
    <body>
    <div class='form-container'>
    <form action='addMovies.php?id=" . $_GET['id'] . "' method='post'>
        <label for='date'>Date (YYYY-MM-DD):</label>
        <input type='date' id='date' name='date' required>
        <label for='timestart'>Start Time (HH:MM:SS):</label>
        <input type='time' id='timestart' name='timestart' required>
        <label for='timeend'>End Time (HH:MM:SS):</label>
        <input type='time' id='timeend' name='timeend' required>
        <label for='room_id'>Room ID:</label>
        <select id='room_id' name='room_id' required>
            <option disabled selected></option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
        </select>
        <input type='submit' value='Insert'>
    </form>
    </div>
    </body>
    ";

    if (isset($_POST['date']) && isset($_POST['timestart']) && isset($_POST['timeend']) && isset($_POST['room_id'])) {
        // The admin has submitted the date and start time
        $id = $_GET['id'];
        $date = $_POST['date'];
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];
        $room_id = $_POST['room_id'];

        // Check if movie data exists in local database
        $query = "SELECT * FROM Movies WHERE imdbid = '$id'";
        $movieResult = mysqli_query($link, $query);

        if (mysqli_num_rows($movieResult) == 0) {
            // If movie data doesn't exist in local database, fetch from API
            $curl = curl_init();
            $url = "https://moviesdatabase.p.rapidapi.com/titles/" . $id;
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
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
            curl_close($curl);

            if ($response) {
                // Decode the JSON response
                $data = json_decode($response, true);

                // Get the movie details
                $movie = $data['results'];
                $title = $movie['titleText']['text'];
                $imageUrl = $movie['primaryImage']['url'];

                // Store the movie data in local database
                $query = "INSERT INTO Movies (imdbid, title, imageUrl) VALUES ('$id', '$title', '$imageUrl')";
                mysqli_query($link, $query);
            }
        }

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
        ::-webkit-scrollbar { width: 0px; height: 0px; } ::-webkit-scrollbar-button { width: 0px; height: 0px; } ::-webkit-scrollbar-thumb { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-thumb:hover { background: transparent; } ::-webkit-scrollbar-thumb:active { background: transparent; } ::-webkit-scrollbar-track { background: transparent; border: 0px none; border-radius: 0px; } ::-webkit-scrollbar-track:hover { background: transparent; } ::-webkit-scrollbar-track:active { background: transparent; } ::-webkit-scrollbar-corner { background: transparent; }
        body {
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
        .admin-home-button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }
        .admin-home-button:hover {
            background-color: #0056b3;
        }
        .button-container, .form-container {
            display: flex;
            justify-content: center;
        }
        .form-container {
            padding: 10%;
        }
    </style>
    <div class='button-container'>
        <a href='admin.php' class='admin-home-button'>Admin Home</a>
    </div>
    <div class='form-container'>
    <form action='addMovies.php' method='post'>
        <label for='title'>Movie Title:</label>
        <input type='text' id='title' name='title' required>
        <input type='submit' value='Search'>
    </form>
    </div>
    ";
}
