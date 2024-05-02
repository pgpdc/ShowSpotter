<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
  header("location: /ShowSpotter/index.php");
}
require("../theaterDatabase.php");
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewpoint" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="/ShowSpotter/Styles/admin.css" />
</head>

<title>Admin</title>

<body>
  <?php require("../navbar.php"); ?>

  <div class="container">
    <a href="addMovies.php">Add Movies</a>
    <a href="movieSchedule.php">Movie Schedule</a>
    <a href="admin_edit_account.php">Edit User Accounts</a>
    <a href="modifyInventory.php">Inventory</a>
  </div>

  <div class="theater">
    <h1>
      <div class="selections">
        <select id="theater-dropdown"></select>
        <button id="updateButton">Update</button>
      </div>
    </h1>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addresses = JSON.parse(sessionStorage.getItem('addresses'));
      const theaterDropdown = document.getElementById('theater-dropdown');

      addresses.forEach(address => {
        let option = document.createElement('option');
        option.value = address.replaceAll(" ", "");
        option.textContent = address;
        theaterDropdown.appendChild(option);
      });

      document.getElementById('updateButton').addEventListener('click', function() {
        var theaterDropdown = document.getElementById('theater-dropdown');
        var selectedTheater = theaterDropdown.value; 

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateTheater.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Session updated: ' + xhr.responseText);
          }
        };
        xhr.send('theater=' + encodeURIComponent(selectedTheater));
      });
      
});
  </script>
 
</body>

</html>