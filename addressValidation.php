
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocode Address</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZa8k5Xckx5xLtJkdv3W5HkhV7OKd6CC0&callback=initMap" async defer></script>
</head>
<body>
    <h1>Get Latitude and Longitude</h1>
    <form id="addressForm">
        <input type="text" id="addressInput" placeholder="Enter an address">
        <button type="submit">Get Coordinates</button>
    </form>
    <div id="result"></div>

    <script>
        function initMap() {
            var geocoder = new google.maps.Geocoder();

            document.getElementById('addressForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var address = document.getElementById('addressInput').value;

                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();
                        document.getElementById('result').innerHTML = '<p>Valid address. Latitude: ' + lat + ', Longitude: ' + lng + '</p>';
                    } else {
                        document.getElementById('result').innerHTML = '<p>Unable to find the address. Status: ' + status + '</p>';
                    }
                });
            });
        }
    </script>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['address'])) {
    $address = urlencode($_POST['address']);


    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyCZa8k5Xckx5xLtJkdv3W5HkhV7OKd6CC0";

    $response = file_get_contents($url);
    $json = json_decode($response, true);

    if ($json['status'] == 'OK') {
        $lat = $json['results'][0]['geometry']['location']['lat'];
        $lng = $json['results'][0]['geometry']['location']['lng'];
        echo json_encode(['lat' => $lat, 'lng' => $lng]);
    } else {
        echo json_encode(['status' => $json['status']]);
    }
} else {
    echo json_encode(['status' => 'ERROR', 'message' => 'No address provided']);
}
?>
