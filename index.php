<?php

function fetchLocations($location) {
    list($latitude, $longitude) = explode(',', $location);
    $latitude = trim($latitude);
    $longitude = trim($longitude);

    $postData = json_encode([
        "includedTypes" => ["movie_theater"],
        "maxResultCount" => 10,
        "rankPreference" => "DISTANCE",
        "locationRestriction" => [
            "circle" => [
                "center" => ["latitude" => $latitude, "longitude" => $longitude],
                "radius" => 20000.0
            ]
        ]
    ]);

    $apiUrl = "https://places.googleapis.com/v1/places:searchNearby";
    $headers = [
        "Content-Type: application/json",
        "X-Goog-Api-Key: AIzaSyCZa8k5Xckx5xLtJkdv3W5HkhV7OKd6CC0", 
        "X-Goog-FieldMask: places.displayName,places.formattedAddress",
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }
}

$locationsData = [];

// Check if the form is submitted and the combined location is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['location'])) {
    // Fetch locations with the provided combined location string
    $locationsData = fetchLocations($_POST['location']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="Styles/ShowTimes.css">

</head>
<body>
    <h1>ShowSpotter</h>
    <script>
        function changeTheater() {
            <?php echo"window.location.href=ShowTimes.php?theater=indiana";
            ?>
        };
    </script>

    <form method="post">
    <input type="text" name="location" placeholder="Latitude,Longitude" required>
    <input type="submit" value="Search Movie Theaters">
    </form>

    <?php
    
    if (!empty($locationsData) && isset($locationsData['places'])) {
        foreach ($locationsData['places'] as $place) {
            $displayName = isset($place['displayName']['text']) ? $place['displayName']['text'] : 'No Name Available';
            $formattedAddress = isset($place['formattedAddress']) ? $place['formattedAddress'] : 'No Address Available';
            
            echo "<div class='result'>";
            echo "<strong>" . htmlspecialchars($displayName) . "</strong><br>";
            echo htmlspecialchars($formattedAddress);

            echo "<a href='Showtimes.php?theater=indiana' class='result-button'>Select</a>";
            echo "</div>";
        }
    } else {
        echo "No movie theaters found or error in response.";
    }
    ?>

   <!-- <h2>Choose a theater: </h2>
    <div class="theater">
        <h1>
            <select id="theater-dropdown">
                <option value="Indiana">Indiana</option>
                <option value="testing">Testing</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
            <button type="button" id="myButton" onclick="changeTheater()">Submit</button>
            <script>
                var web = "ShowTimes.php?theater=indiana";
                //Default set to Indiana;
                document.getElementById('theater-dropdown').addEventListener('change', function() {
                    if (this.value == "Indiana") {
                        web = "ShowTimes.php?theater=indiana";
                    }
                    else if (this.value == "testing") {
                        web = "ShowTimes.php?theater=testing";
                    }
                    else {
                        alert('Waiting for database');
                    }
                });

            </script>
        </h1>

            -->
</body>
</html>