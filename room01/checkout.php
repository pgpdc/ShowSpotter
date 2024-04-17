<!DOCTYPE html>
<html>
<head>
    <title>Inser Checkout Data</title>
</head>
<body>
       <?php
        include_once('saveTickets.php');
        //session_start();
        $DATABASE_HOST ='localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'indiana';
        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
        if (!$conn){
            die("Conection failed:".mysqli_connect_error());
        }

        



        //$_RSV->set($_POST["sessid"], $_POST["userid"], $_POST["seats"], $_POST["tickets"]);
        //Test
        /*session_start();
        $DATABASE_HOST ='localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'test';
        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
        if (!$conn){ 
            die("Conection failed:".mysqli_connect_error());
        }
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $cardName = $_REQUEST['cardName'];
        $creditNum = $_REQUEST['creditNum'];
        $expDate = $_REQUEST['expDate'];
        $cvv = $_REQUEST['cvv'];
        $name = $_REQUEST['name'];
        $address = $_REQUEST['adddress'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $zipCode = $_REQUEST['zipCode'];
        $billSame = $_REQUEST['billSame'];
        
        $sql = "INSERT INTO reservedSeat VALUES($_POST["userid"], $_POST["seats"])";

        if (mysqli_query($conn,$sql)){
            echo"Stored"
        }
        mysqli_close($conn)*/



       







        /* Commenting off for checkout part right now


        //Inserts values from checkoutForm
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $cardName = $_REQUEST['cardName'];
        $creditNum = $_REQUEST['creditNum'];
        $expDate = $_REQUEST['expDate'];
        $cvv = $_REQUEST['cvv'];
        $name = $_REQUEST['name'];
        $address = $_REQUEST['adddress'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $zipCode = $_REQUEST['zipCode'];
        $billSame = $_REQUEST['billSame'];
        
        $sql = "INSERT INTO paymentinfo VALUES('$username','$password','$cardName','$creditNum','$expDate','$cvv','$name',
        '$address','$city','$state','$zipCode','$billSame')";

        if (mysqli_query($conn,$sql)){
            echo"Stored";
        }
        mysqli_close($conn)
        */
        ?>
    </body>
    </html>