<?php
// Define a function to perform the API request and return the results, accepting a combined location string
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
        "X-Goog-Api-Key: AIzaSyCZa8k5Xckx5xLtJkdv3W5HkhV7OKd6CC0", // Replace YOUR_API_KEY with your actual API key
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

echo '<pre>';
print_r($locationsData);
echo '</pre>';

?>


<!DOCTYPE html>
<html>
<head>
    <title>Movie Theater Search</title>
</head>
<body>

<form method="post">
    <input type="text" name="location" placeholder="Latitude,Longitude" required>
    <input type="submit" value="Search Movie Theaters">
</form>

<?php
// If locations data is available, display the formatted addresses and display names
if (!empty($locationsData) && isset($locationsData['places'])) {
    foreach ($locationsData['places'] as $place) {
        $displayName = isset($place['displayName']['text']) ? $place['displayName']['text'] : 'No Name Available';
        $formattedAddress = isset($place['formattedAddress']) ? $place['formattedAddress'] : 'No Address Available';
        
        echo htmlspecialchars($displayName) . " - " . htmlspecialchars($formattedAddress) . "<br>";
    }
} else {
    echo "No movie theaters found or error in response.";
}
?>

</body>
</html>