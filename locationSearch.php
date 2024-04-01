<?php
function fetchLocations($latitude, $longitude) {
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
    return [
        'status' => 'success',
        'message' => "Received latitude: $latitude, longitude: $longitude"
    ];
}

$locationsData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Make sure to validate and sanitize the input
    $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Now you can call your function with these values
    $result = fetchLocations($latitude, $longitude); // Assuming this function exists and returns data

    header('Content-Type: application/json');
    $response = ['status' => 'success', 'message' => 'Data processed successfully.'];
    echo json_encode($result);
    
    exit;
}
?>
