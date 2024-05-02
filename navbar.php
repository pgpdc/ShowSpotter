<link rel="stylesheet" href="/ShowSpotter/Styles/navbar.css">

<nav>
    <div class="brand">ShowSpotter</div>
    <?php if (isset($_SESSION['theater'])) : ?>
        <?php if ($_SERVER['PHP_SELF'] === '/ShowSpotter/Showtimes.php' || $_SERVER['PHP_SELF'] === '/ShowSpotter/ShowTimes.php' || $_SERVER['PHP_SELF'] === '/ShowSpotter/showtimes.php') : ?>
            <a href="/ShowSpotter/index.php">Home</a>
        <?php else : ?>
            <?php
            $encodedTheater = urlencode($_SESSION['theater']);
            $encodedDate = urlencode(date('Y-m-d'));
            ?>
            <a href="/ShowSpotter/Showtimes.php?theater=<?php echo $encodedTheater; ?>&date=<?php echo $encodedDate; ?>">Home</a>
        <?php endif; ?>
    <?php else : ?>
        <a href="/ShowSpotter/index.php">Home</a>
    <?php endif; ?>
    <?php if ($_SERVER['PHP_SELF'] !== '/ShowSpotter/index.php' && isset($_SESSION['theater'])) : ?>
        <a href="/ShowSpotter/room01/concessions.php">Concessions</a>
        <a href="/ShowSpotter/room01/checkout.php">Checkout</a>
    <?php endif; ?>
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