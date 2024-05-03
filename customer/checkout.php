<!DOCTYPE html>
<html>
<head>
    <title>Insert Checkout Data</title>
    <link rel="stylesheet" href="StylesCustomer/customer.css">
</head>
<body>
       <?php
        require("../navbar.php"); 

        session_start();
        /*
        $DATABASE_HOST ='localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = $_SESSION["theater"];
        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
        if (!$conn){
            die("Conection failed:".mysqli_connect_error());
        }*/
        include "databaseConnectBilling.php";

        //Inserts values from checkoutForm
        $username = $_REQUEST['username'];
        //$password = $_REQUEST['password'];
        $cardName = $_REQUEST['cardName'];
        $creditNum = $_REQUEST['creditNum'];
        $expDate = $_REQUEST['expDate'];
        $cvv = $_REQUEST['cvv'];
        $name = $_REQUEST['name'];
        $address = $_REQUEST['address'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $zipCode = $_REQUEST['zipCode'];
        $billSame = $_REQUEST['billSame'];
        
        $sql = "INSERT INTO paymentinfo VALUES('$username','$cardName','$creditNum','$expDate','$cvv','$name',
        '$address','$city','$state','$zipCode','$billSame')";

        if (mysqli_query($conn,$sql)){
            echo "Payment Recoreded"."<br>";
            echo "See the rewards you earned as a first time user below!";
        }
        mysqli_close($conn);
        
        ?>
        <br>
        <button value="Rewards" value="Rewards"
    onclick="window.location.href='rewardsCustomer.php'">Rewards</button>
        <script>
        
        </script>
    </body>
    </html>