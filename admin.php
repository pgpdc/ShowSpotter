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
  <link rel="stylesheet" href="Styles/navbar.css">
</head>

<title>Admin</title>

<body>
  
  <nav>
    <div class="brand">ShowSpotter</div>
    <div class="links">
      <a href="index.php">Home</a>
      <a href="">Concessions</a>
      <a href="checkout.html">Checkout</a>
        <?php if ($isUserAdmin): ?>
          <a href="admin.php">Admin Hub</a>  
        <?php endif; ?> 
      <div class="dropdown">
      <button class="dropbtn">Account</button>
      <div class="dropdown-content">
        <?php if ($isUserAdmin): ?> 
          <p>Admin</p> 
        <?php else: ?> 
          <p>Customer</p> 
        <?php endif; ?>
      <a href="login.php">Sign-In</a>
      <a href="logout.php">Log-Out</a>
      </div>
      </div>
      </div>
    </nav>

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