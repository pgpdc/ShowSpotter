<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.php");
}

function isAdmin() {
  return isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;
}

$isUserAdmin = isAdmin();
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
  
<?php require("navbar.php"); ?>

  <div class="container">

    <!-- <iframe src="addMovies.php"></iframe>
    <iframe src="movieSchedule.php"></iframe> -->
    <a href="addMovies.php">Add Movies</a>
    <a href="movieSchedule.php">Movie Schedule</a>
    <a href="admin_edit_account.php">Edit User Accounts</a>
    <a href="modifyInventory.php">Inventory</a>

  </div>
</body>

</html>