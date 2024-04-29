<!DOCTYPE html>
<html>
<?php
session_start();
?>
<head>
<link rel="stylesheet" href="customer.css">

<title>Customer</title>
</head>
<body>
    <?php
     include_once("navbar.php");
     ?>
    <h1>Customer HomePage</h1>
    <?php 
    
    echo "HELLO USER ".$_SESSION['name']. "<br>";
    ?>
    <input type="button" value="Account Details"
    onclick="window.location.href='customerInfo.php'"/><br>
    <input type="button" value="Order History"
    onclick="window.location.href='orderPrint.php'"/><br>
    <input type="button" value="Reward Details"
    onclick="window.location.href='rewardsCustomer.php'"/><br>
    
</body>
</html>