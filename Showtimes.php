<?php

session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
if ($_GET["theater"] == "indiana") {
    $DATABASE_NAME = 'indiana';
}
else if ($_GET["theater"] == "testing") {
    $DATABASE_NAME = 'testing';
}

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


$timezone = new DateTimeZone('America/New_York'); // replace with the user's timezone
$date = new DateTime('now', $timezone);
$today = $date->format('Y-m-d');
//$today = $date = new DateTime('now', $timezone);

$sql = "SELECT * FROM `showtimes` WHERE `date` = '$today' ORDER BY 'timestart'";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/ShowTimes.css">

</head>
<title>ShowSpotter</title>

<body>
    <h1>ShowSpotter</h1>

    <ul>
        <li>Menu
            <ul class="dropdown">
                <li> <a href="">Showtimes</a></li>
                <li> <a href="">Sign-In</a></li>
                <li> <a href="">Concessions</a></li>
                <li> <a href="checkout.html">Checkout</a></li>
            </ul>
        </li>
    </ul>

    <div class="theater">
        <h1>
            <select id="theater-dropdown">
                <option value="Indiana">Indiana</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
            <select id="DateSelection">
            </select>
        </h1>
    </div>
    <script>
        function populateDropdown() {
            var dropdown = document.getElementById('DateSelection');
  
            var currentDate = new Date();
            var currentDateString = formatDate(currentDate);
  
            var option = document.createElement('option');
            option.value = currentDateString;
            option.textContent = 'Today (' + currentDateString + ')';
            dropdown.appendChild(option);
  
            var tomorrowDate = new Date();
            tomorrowDate.setDate(currentDate.getDate() + 1);
            var tomorrowDateString = formatDate(tomorrowDate);
  
            option = document.createElement('option');
            option.value = tomorrowDateString;
            option.textContent = 'Tomorrow (' + tomorrowDateString + ')';
            dropdown.appendChild(option);
        }


        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        populateDropdown();

        document.getElementById('theater-dropdown').addEventListener('change', function() {
            if (this.value == "Indiana") {
                var web = "ShowTimes.php?theater=indiana";
                <?php echo"window.location.href=web";
                ?>
           }
           else {
                alert('Waiting for database');
           }
        });
    </script>
 
    <!--Movie Listings-->
    <h2>Showtimes: </h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $imdbid = $row['imdbid'];
        $date = $row['date'];
        $timestart = $row['timestart'];
        $timeend = $row['timeend'];
        $room_id = $row['room_id'];

        // Create a new cURL resource
        $curl = curl_init();

        // Set the URL, including the imdbid at the end
        $url = "https://moviesdatabase.p.rapidapi.com/titles/" . $imdbid;

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
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // Decode the JSON response
            $data = json_decode($response, true);

            // Get the movie details
            $movie = $data['results'];
            $title = $movie['titleText']['text'];
            $imageUrl = $movie['primaryImage']['url'];

            // Add the movie to the array, or append the start time if it already exists
            if (!isset($movies[$title])) {
                $movies[$title] = ['imageUrl' => $imageUrl, 'startTimes' => [$timestart]];
            } else {
                $movies[$title]['startTimes'][] = $timestart;
            }
        }
    }

    // Sort the movies alphabetically
    if(isset($movies)) {
        ksort($movies);
        // Display the movie details
        foreach ($movies as $title => $movie) {
            echo "<div class='movie-box'>";
            echo "<h3>$title</h3>";
            echo "<img src='" . $movie['imageUrl'] . "' alt='$title'><br>";
            foreach ($movie['startTimes'] as $startTime) {
                // Convert the start time to 12-hour format with AM/PM
                $startTimeIn12HourFormat = date("g:i A", strtotime($startTime));
                
                // Create a link to the room page for this start time
                echo "<a href='room.php?id=$room_id&time=$startTime' style='color: darkblue; font-weight: bold;'>$startTimeIn12HourFormat</a><br>";
            }
            echo "<br></div>";
        }
    }
    

    
    
    ?>



</body>

</html>