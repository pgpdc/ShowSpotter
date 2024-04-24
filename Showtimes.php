<?php

session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';

$DATABASE_NAME = $_GET["theater"];


$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


//$timezone = new DateTimeZone('America/New_York'); // replace with the user's timezone
//$date = new DateTime('now', $timezone);
//$today = $date->format('Y-m-d');
//$today = $date = new DateTime('now', $timezone);

$today = $_GET["date"];

$sql = "SELECT * FROM `showtimes` WHERE `date` = '$today' ORDER BY 'timestart'";

$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;
}

$isUserAdmin = isAdmin();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="Styles/ShowTimes.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <title>ShowSpotter</title>
</head>

<body>

    <nav>
        <div class="brand">ShowSpotter</div>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="room01/concessions.php">Concessions</a>
            <a href="room01/checkout.php">Checkout</a>
            <?php if ($isUserAdmin): ?>
                <a href="admin.php">Admin Hub</a>  
            <?php endif; ?>    
            <div class="dropdown">
                <button class="dropbtn">Account</button>
                <div class="dropdown-content">
                <?php if ($isUserAdmin): ?> 
                    <p>Admin</p> 
                <?php else: ?> 
                    <p>Customer</p> 
                <?php endif; ?>
                    <a href="login.php">Sign-In</a>
                    <a href="logout.php">Log-Out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="theater">
        <h1>
            <select id="theater-dropdown">
 
            </select>
            <select id="DateSelection">
            </select>
            <button type="submit" onclick="updateTheater()">Update</button>
        </h1>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Retrieve the addresses array from sessionStorage
            const addresses = JSON.parse(sessionStorage.getItem('addresses'));
            
            // Check if addresses are retrieved and log for debugging
            console.log('Retrieved addresses:', addresses);

            if (addresses && addresses.length) {
                const dropdown = document.getElementById('theater-dropdown');
                // Populate the dropdown
                addresses.forEach(address => {
                    const option = document.createElement('option');
                    option.value = address;
                    option.textContent = address;
                    dropdown.appendChild(option);
                });
            } else {
                console.log('No addresses found in sessionStorage.');
            }
        });
    </script>
    <script>
        function updateTheater() {
            var updatedTheater = document.getElementById('theater-dropdown').value;
            var updatedDate = document.getElementById('DateSelection').value;
            
            //window.location.href="Showtimes.php?theater=" + updatedTheater + "&date=" + updatedDate;
            window.location.href="Showtimes.php?theater=indiana" + "&date=" + updatedDate;
        }
    </script>
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
                <?php echo "window.location.href=web";
                ?>
            } else {
                alert('Waiting for database');
            }
        });
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