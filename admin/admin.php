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
</body>

</html>