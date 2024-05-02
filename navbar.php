<link rel="stylesheet" href="/ShowSpotter/Styles/navbar.css">


<nav>
    <div class="brand">ShowSpotter</div>
    <a href="/ShowSpotter/index.php">Home</a>
    <a href="/ShowSpotter/room01/concessions.php">Concessions</a>
    <a href="/ShowSpotter/room01/checkout.php">Checkout</a>
    <?php if (isset($_SESSION['admin'])) : ?>
        <a href="/ShowSpotter/admin/admin.php">Admin Hub</a>
        <?php elseif (isset($_SESSION['userid'])) : ?>
            <a href="/ShowSpotter/customer.php">Account Hub</a>
    <?php endif; ?>
    <div class="dropdown">
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) : ?>
            <a href="/ShowSpotter/login/logout.php">Log-Out</a>
        <?php else : ?>
            <a href="/ShowSpotter/login/login.php">Sign-In</a>
        <?php endif; ?>
    </div>
</nav>