<?php
session_start();
unset($_SESSION['theater']); //Leave here to unset the session everytime a user goes to the index.php
// $_SESSION['theater'] = "indiana"; //This is how you set the session
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
    function clearBox(elementID) {
         document.getElementById(elementID).innerHTML = "";
        }
    </script>
</head>

<body>
    
<?php require("navbar.php"); ?>


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
        const addresses = [];
        if (data.places && data.places.length > 0) {
        data.places.forEach(place => {

            console.log(place.formattedAddress); // Log formatted address
            console.log(place.displayName.text); // Log display name text
            
            if (!place.displayName.text.includes("Museum")) {
                createPlaceElement(place.formattedAddress, place.displayName.text);
                addresses.push(place.displayName.text);
            }
            
        });
        sessionStorage.setItem('addresses', JSON.stringify(addresses));
    } else {
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
        const addresses = [];
        if (data.places && data.places.length > 0) {
        data.places.forEach(place => {

            console.log(place.formattedAddress); // Log formatted address
            console.log(place.displayName.text); // Log display name text
            
            if (!place.displayName.text.includes("Museum")) {
                createPlaceElement(place.formattedAddress, place.displayName.text);
                addresses.push(place.displayName.text);
            }      
        });
        sessionStorage.setItem('addresses', JSON.stringify(addresses));

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
        var currentDate = new Date();
        var currentDateString = formatDate(currentDate);

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }
        var newAddress = formattedAddress.replaceAll(" ", "");

        selectLink.href='Showtimes.php?theater=' + newAddress + "&date=" + currentDateString;
        selectLink.className = 'result-button';
        selectLink.textContent = 'Select';
        resultDiv.appendChild(selectLink);

        document.getElementById('placesContainer').appendChild(resultDiv);
    }

</script>

</body>
</html>