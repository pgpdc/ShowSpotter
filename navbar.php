<?php 
function isAdmin()
{
    return isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE;
}

$isUserAdmin = isAdmin();

?>


<link rel="stylesheet" href="Styles/navbar.css">


<nav>
        <div class="brand">ShowSpotter</div>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="room01/concessions.php">Concessions</a>
            <a href="room01/checkout.php">Checkout</a>
            <?php if ($isUserAdmin) : ?>
                <a href="admin.php">Admin Hub</a>
            <?php endif; ?>
            <div class="dropdown">
                <button class="dropbtn">Account</button>
                <div class="dropdown-content">
                    <?php if ($isUserAdmin) : ?>
                        <p>Admin</p>
                    <?php else : ?>
                        <p>Customer</p>
                    <?php endif; ?>
                    <a href="login.php">Sign-In</a>
                    <a href="logout.php">Log-Out</a>
                </div>
            </div>
        </div>
    </nav>