<html>

<head>
<link rel="stylesheet" href="customer.css">
</head>
<?php
session_start();
?>
<title>Account Details</title>
<style>
#myDIV {
  width: 100%;
  padding: 50px 0;
  text-align: center;
  background-color: lightblue;
  margin-top: 20px;
}
</style>
</head>
<body>
<?php

include_once("navbar.php");
include "databaseConnectBilling.php";



$sql = "SELECT username,password,cardName,creditNum,expDate,cvv,name,address,city,state,zipCode,billSame FROM paymentinfo WHERE username='$user'";
$queryNameResult = mysqli_query($conn, $sql);

if(mysqli_num_rows($queryNameResult)>0){
    if($row = mysqli_fetch_assoc($queryNameResult)){
            echo "Account User and Password:<br>";
            echo "Username: ". $row["username"]."<br>";
            echo "Password: ". $row["password"]."<br>";
            echo "Account Payment Information:<br>";
            echo "Card Name: ". $row["cardName"]."<br>";
            echo "Credit Card Number: ". $row["creditNum"]."<br>";
            echo "Experiation Date: ". $row["expDate"]."<br>";
            echo "Cvs: ". $row["cvv"]."<br>";
            echo "Address<br>";
            echo "Full Name: ". $row["name"]."<br>";
            echo "Address: ". $row["address"]."<br>";
            echo "City: ". $row["city"]."<br>";
            echo "State: ". $row["state"]."<br>";
            echo "Zip Code: ". $row["zipCode"]."<br>";
            echo "Billing Same: ". $row["billSame"]."<br>";
            $conn->close();
}
}else{
?>
<h1>Billing Info:</h1>

        <form action="checkout.php" method="post">
        <p>
            <label for="username">Username:</label>
            <input type="varchar" name="username" id="username">
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="varchar" name="password" id="password">
        </p>
        <p>
            <label for="cardName">Card Name:</label>
            <input type="varchar" name="cardName" id="cardName">
        </p>
        <p>
            <label for="creditNum">Credit Card Number:</label>
            <input type="varchar" name="creditNum" id="creditNum">
        </p>
        <p>
            <label for="expDate">Experation Date:</label>
            <input type="varchar" name="expDate" id="expDate">
        </p>
        <p>
            <label for="cvv">Cvv:</label>
            <input type="int" name="cvv" id="cvv">
        </p>
        <p>
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="address">Address:</label>
            <input type="varchar" name="address" id="address">
        </p>
        <p>
            <label for="city">City:</label>
            <input type="text" name="city" id="city">
        </p>
        <p>
            <label for="state">State:</label>
            <input type="text" name="state" id="state">
        </p>
        <p>
            <label for="zipCode">Zip Code:</label>
            <input type="int" name="zipCode" id="zipCode">
        </p>
        <p>
            <label for="billSame">Is billing address the same as your home address:</label>
            <input type="text" name="billSame" id="billSame">
            <input type="submit" value="submit">
        </p><?php 
        }?>

<!-- Button that when clicked will allow user to update Password-->
<button onclick="myFunction()">Update Password</button>
<div id="hidden" >
<h2>Update Password:</h2>
<form method="post" action="customerInfo.php">
        <p>
            <label for="password">Password:</label>
            <input type="varchar" name="password" id="password">
            <input type="submit" name="updatePass" value="click">
        </p>
</form>
</div>
<h2>Update Billing Information:</h2>
<form method="post" action="customerInfo.php">
        <p>
            <label for="cardName">Card Name:</label>
            <input type="varchar" name="cardName" id="cardName">
        </p>
        <p>
            <label for="creditNum">Credit Card Number:</label>
            <input type="varchar" name="creditNum" id="creditNum">
        </p>
        <p>
            <label for="expDate">Experation Date:</label>
            <input type="varchar" name="expDate" id="expDate">
        </p>
        <p>
            <label for="cvv">Cvv:</label>
            <input type="int" name="cvv" id="cvv">
        </p>
        <input type="submit" name="updateBilling" value="click">
</form>

<h2>Update Address Information:</h2>
<form method="post" action="customerInfo.php">
<p>
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="address">Address:</label>
            <input type="varchar" name="address" id="address">
        </p>
        <p>
            <label for="city">City:</label>
            <input type="text" name="city" id="city">
        </p>
        <p>
            <label for="state">State:</label>
            <input type="text" name="state" id="state">
        </p>
        <p>
            <label for="zipCode">Zip Code:</label>
            <input type="int" name="zipCode" id="zipCode">
        </p>
        <p>
            <label for="billSame">Is billing address the same as your home address:</label>
            <input type="text" name="billSame" id="billSame">
        <input type="submit" name="updateAddress" value="click">
        </p>
 </form>

<script>

  function passHide{
    var a = document.getElementBy("hidden");
    if (a.style.display === "none"){
        a.style.display = "block";
    } else {
        a.style.display = "none";
    }
}

function myFunction() {
    var x = document.getElementById("hidden");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>
<!---Update User and Password--->
<!--Update Billing-->
<?php

function updateUserInfo(){  
include "databaseConnectBilling.php";
$updatedPassword = $_POST['password'];
$sql = "UPDATE paymentinfo SET password='$updatedPassword' WHERE username='$user'";
if ($conn->query($sql)===TRUE){
    echo "yes";
}else{
    echo "no";
}
}
if(isset($_POST['updatePass'])){
    echo $_POST['password'];
    updateUserInfo();
}

function updateBillingInfo(){  
    include "databaseConnectBilling.php";
    $cardName = $_POST['cardName'];
    $creditNum = $_POST['creditNum'];
    $expDate = $_POST['expDate'];
    $cvv = $_POST['cvv'];

    $sql = "UPDATE paymentinfo SET cardName='$cardName',creditNum='$creditNum',expDate='$expDate',cvv='$cvv' WHERE username='$user'";
    if ($conn->query($sql)===TRUE){
        //echo "yes";
    }else{
        //echo "no";
    }
    }
    if(isset($_POST['updateBilling'])){
        updateBillingInfo();
    }

    function updateAddressInfo(){  
        include "databaseConnectBilling.php";
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zipCode'];
        $billSame = $_POST['billSame'];
    
        $sql = "UPDATE paymentinfo SET name='$name',address='$address',city='$city',state='$state',zipCode='$zipCode',billSame='$billSame' WHERE username='$user'";
        if ($conn->query($sql)===TRUE){
            echo "yes";
        }else{
            echo "no";
        }
        }
        if(isset($_POST['updateAddress'])){
            updateAddressInfo();
        }
?>
<!--Update Address-->

<!--Return to customer hub page-->
<input type="button" value="Customer Homepage"
    onclick="window.location.href='customer.php'"/><br>
</body>
</html>
</html>
