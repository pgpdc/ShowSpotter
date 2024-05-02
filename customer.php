<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <link rel="stylesheet" href="Styles/customer.css">

    <title>Customer</title>
</head>

<body>
    <?php include("navbar.php");?>
    <h1>Customer HomePage</h1>
    <?php

    echo "HELLO USER:  " . $_SESSION['name'] . "<br>";
    ?>
    <button value="Account Details" onclick="window.location.href='customerInfo.php'">Account Details</button><br>
    <button value="Order History" onclick="window.location.href='orderPrint.php'">Order History</button><br>
    <button value="Reward Details" onclick="window.location.href='rewardsCustomer.php'">Points</button><br>

</body>

</html>