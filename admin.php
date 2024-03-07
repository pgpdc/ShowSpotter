<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.php");
}
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewpoint" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="Styles/admin.css" />
</head>

<title>Admin</title>

<body>
  <h1>ShowSpotter Admin</h1>

  <!-- <ul>
    <li>
      Admin Dashboard
      <ul class="dropdown">
        <li><a href="">Showtimes</a></li>
        <li><a href="">Concessions</a></li>
        <li><a href="">Prices</a></li>
      </ul>
    </li>
  </ul> -->

  <div class="container">

    <!-- <iframe src="addMovies.php"></iframe>
    <iframe src="movieSchedule.php"></iframe> -->
    <a href="addMovies.php">Add Movies</a>
    <a href="movieSchedule.php">Movie Schedule</a>
    <a href="admin_edit_account.php">Edit User Accounts</a>

  </div>
</body>

</html>