<?php

session_start();
unset($_SESSION['theater']); //Leave here to unset the session everytime a user goes to the index.php
$_SESSION['theater'] = $_GET["theater"]; 

require("theaterDatabase.php");

$today = $_GET["date"];

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
    <title>ShowSpotter</title>
</head>

<body>
    <?php require("navbar.php"); ?>

    <div class="theater">
        <h1>
            <div class="selections">
            <select id="theater-dropdown">

            </select>
            <select id="DateSelection">
            </select>
            <button type="submit" onclick="updateTheater()">Update</button>
            </div>
        </h1>
    </div>

    <script>
 document.addEventListener('DOMContentLoaded', function() {

    const addresses = JSON.parse(sessionStorage.getItem('addresses'));


    const urlParams = new URLSearchParams(window.location.search);
    const selectedTheater = urlParams.get('theater');
    const selectedDate = urlParams.get('date');

    const theaterDropdown = document.getElementById('theater-dropdown');
    const dateDropdown = document.getElementById('DateSelection');

    if (addresses && addresses.length) {
        addresses.forEach(address => {
            const option = document.createElement('option');
            option.value = address.replaceAll(" ", "");
            option.textContent = address;
            if (address.replaceAll(" ", "") === selectedTheater) {
                option.selected = true;
            }
            theaterDropdown.appendChild(option);
        });
    } else {
        console.log('No addresses found in sessionStorage.');
    }

    populateDateDropdown(dateDropdown, selectedDate);

    function updateTheater() {
        var updatedTheater = theaterDropdown.value;
        var updatedDate = dateDropdown.value;
        window.location.href = "ShowTimes.php?theater=" + encodeURIComponent(updatedTheater) + "&date=" + encodeURIComponent(updatedDate);
    }

    document.querySelector('button[type="submit"]').addEventListener('click', updateTheater);
});

function populateDateDropdown(dropdown, selectedDate) {
    var currentDate = new Date();
    var currentDateString = formatDate(currentDate);

    var option = document.createElement('option');
    option.value = currentDateString;
    option.textContent = 'Today (' + currentDateString + ')';
    if (currentDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var tomorrowDate = new Date(currentDate.getTime() + (24 * 60 * 60 * 1000));
    var tomorrowDateString = formatDate(tomorrowDate);

    option = document.createElement('option');
    option.value = tomorrowDateString;
    option.textContent = 'Tomorrow (' + tomorrowDateString + ')';
    if (tomorrowDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var twoDate = new Date(currentDate.getTime() + (2 * 24 * 60 * 60 * 1000));
    var twoDateString = formatDate(twoDate);

    option = document.createElement('option');
    option.value = twoDateString;
    option.textContent = 'Overmorrow (' + twoDateString + ')';
    if (twoDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var threeDate = new Date(currentDate.getTime() + (3 * 24 * 60 * 60 * 1000));
    var threeDateString = formatDate(threeDate);

    option = document.createElement('option');
    option.value = threeDateString;
    option.textContent = threeDateString;
    if (threeDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var fourDate = new Date(currentDate.getTime() + (4 * 24 * 60 * 60 * 1000));
    var fourDateString = formatDate(fourDate);

    option = document.createElement('option');
    option.value = fourDateString;
    option.textContent = fourDateString;
    if (fourDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var fiveDate = new Date(currentDate.getTime() + (5 * 24 * 60 * 60 * 1000));
    var fiveDateString = formatDate(fiveDate);

    option = document.createElement('option');
    option.value = fiveDateString;
    option.textContent = fiveDateString;
    if (fiveDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);

    var sixDate = new Date(currentDate.getTime() + (6 * 24 * 60 * 60 * 1000));
    var sixDateString = formatDate(sixDate);

    option = document.createElement('option');
    option.value = sixDateString;
    option.textContent = sixDateString;
    if (sixDateString === selectedDate) {
        option.selected = true;
    }
    dropdown.appendChild(option);
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    return year + '-' + month + '-' + day;
}
    </script>
    


    <!--Movie Listings-->
    <br>
    <h2>Showtimes: </h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $imdbid = $row['imdbid'];
        $date = $row['date'];
        $timestart = $row['timestart'];
        $timeend = $row['timeend'];
        $room_id = $row['room_id'];

        // Check if movie data exists in local database
        $query = "SELECT * FROM Movies WHERE imdbid = '$imdbid'";
        $movieResult = mysqli_query($link, $query);

        if (mysqli_num_rows($movieResult) > 0) {
            // If movie data exists in local database, use it
            $movie = mysqli_fetch_assoc($movieResult);
            $title = $movie['title'];
            $imageUrl = $movie['imageUrl'];
            // Add the movie to the array, or append the start time if it already exists
            if (!isset($movies[$title])) {
                $movies[$title] = ['imageUrl' => $imageUrl, 'startTimes' => [$timestart]];
            } else {
                $movies[$title]['startTimes'][] = $timestart;
            }
        } else {
            // If movie data doesn't exist in local database, fetch from API
            $curl = curl_init();
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

                // Store the movie data in local database
                $query = "INSERT INTO Movies (imdbid, title, imageUrl) VALUES ('$imdbid', '$title', '$imageUrl')";
                mysqli_query($link, $query);
            }

            // Add the movie to the array, or append the start time if it already exists
            if (!isset($movies[$title])) {
                $movies[$title] = ['imageUrl' => $imageUrl, 'startTimes' => [$timestart]];
            } else {
                $movies[$title]['startTimes'][] = $timestart;
            }
        }
    }

    // Sort the movies alphabetically
    if (isset($movies)) {
        ksort($movies);
        // Display the movie details
        echo "<div class='container'>";
        foreach ($movies as $title => $movie) {
            echo "<div class='movie-box'>";
            echo "<h3>$title</h3>";
            echo "<img src='" . $movie['imageUrl'] . "' alt='$title'><br>";
            foreach ($movie['startTimes'] as $startTime) {
                // Convert the start time to 12-hour format with AM/PM
                $startTimeIn12HourFormat = date("g:i A", strtotime($startTime));

                // Create a link to the room page for this start time
                echo "<a href='room01/SeatingV2.php?id=$room_id&time=$startTime&date=$date' style='color: darkblue; font-weight: bold;'>$startTimeIn12HourFormat</a><br>";
            }
            echo "<br></div>";
        }
        echo "</div>";
    }
    ?>



</body>

</html>