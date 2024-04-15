<?php
/*
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

*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="Styles/ShowTimes.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZa8k5Xckx5xLtJkdv3W5HkhV7OKd6CC0&callback=initMap" async defer></script>
    <script>
        function clearBox(elementID)
    {
    document.getElementById(elementID).innerHTML = "";
    }
    </script>
</head>

<body>
    
    <nav>
        <div class="brand">ShowSpotter</div>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="">Concessions</a>
            <a href="checkout.html">Checkout</a>
            <a href="login.php">Sign-In</a>
        </div>
    </nav>
    <br>

    <script>
        function changeTheater() {
            <?php echo"window.location.href=ShowTimes.php?theater=indiana";
            ?>
        };
    </script>

    
    <form id="addressForm">
        <input type="text" id="addressInput" placeholder="Enter an address">
        <select name="distance" id="distance">
            <option value="1610">1 Mile</option>
            <option value="16094">10 Miles</option>
            <option value="32187">20 Miles</option>
            <option value="48280">30 Miles</option>
        </select>
        <button type="submit"  onclick="clearBox('placesContainer')">Get Theaters</button>
    </form>

    <script>
        function initMap() {
            var geocoder = new google.maps.Geocoder();

            document.getElementById('addressForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var address = document.getElementById('addressInput').value;
                var distance = document.getElementById('distance').value;

                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();
                        
                        console.log(lat + " " + lng);
                        searchMovieTheatersWDistance(lat, lng, distance);
                    } else {

                    }
                });
            });
        }
    </script>
    <br>
     

    <div id="placesContainer"></div>

<script>

    navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude } = position.coords;
        searchMovieTheaters(latitude, longitude);
        
    })

    function searchMovieTheaters(latitude, longitude) {
        //alert(latitude + " " + longitude);
        fetch('http://localhost/ShowSpotter/locationSearch.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'latitude=' + encodeURIComponent(latitude) + '&longitude=' + encodeURIComponent(longitude)
        })
        .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok. Status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.places && data.places.length > 0) {
        data.places.forEach(place => {

            console.log(place.formattedAddress); // Log formatted address
            console.log(place.displayName.text); // Log display name text
            
            if (!place.displayName.text.includes("Museum")) {
                createPlaceElement(place.formattedAddress, place.displayName.text);
            }
            
        });
    } else {
        // Handle case where 'places' is empty or not found
        console.log('No places found or data is malformed.');
    }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message); 
    });
    }

    function searchMovieTheatersWDistance(latitude, longitude, distance) {
        //alert(latitude + " " + longitude);
        fetch('http://localhost/ShowSpotter/locationSearchWDistance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'latitude=' + encodeURIComponent(latitude) + '&longitude=' + encodeURIComponent(longitude) + '&distance=' + encodeURIComponent(distance)
        })
        .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok. Status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.places && data.places.length > 0) {
        data.places.forEach(place => {

            console.log(place.formattedAddress); // Log formatted address
            console.log(place.displayName.text); // Log display name text
            
            if (!place.displayName.text.includes("Museum")) {
                createPlaceElement(place.formattedAddress, place.displayName.text);
            }
            
        });
    } else {
        // Handle case where 'places' is empty or not found
        console.log('No places found or data is malformed.');
    }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message); 
    });
    }

    function createPlaceElement(displayName, formattedAddress) {
        
        const resultDiv = document.createElement('div');
        resultDiv.className = 'result';

    
        const nameElement = document.createElement('strong');
        nameElement.textContent = displayName; 
        resultDiv.appendChild(nameElement);
        
        resultDiv.appendChild(document.createElement('br'));

        const addressText = document.createTextNode(formattedAddress); 
        resultDiv.appendChild(addressText);

        const selectLink = document.createElement('a');
        //echo "<a href='detailsPage.php?name=" . urlencode($displayName) . "' class='result-button'>View Details</a>";

        selectLink.href = 'Showtimes.php?theater=indiana'; 
        selectLink.className = 'result-button';
        selectLink.textContent = 'Select';
        resultDiv.appendChild(selectLink);


        document.getElementById('placesContainer').appendChild(resultDiv);
    }

</script>

    <?php
    /* Keeping this if we want to search by specific location.
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
    */
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