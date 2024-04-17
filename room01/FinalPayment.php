<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
        <link rel="stylesheet" href="FinalPayment.css">
</head>
<body>
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn-> connect_error){
            die("Connection Error");
        }
        //echo "YES THIS IS you userid:".$_SESSION["userid"];
        //Stating session variables
        $id = $_SESSION["userid"];
        $time = $_SESSION["time"];
        $date = $_SESSION["date"];
        $idForRoom = $_SESSION["id"];
        
        
        
        
        
        
        
        //Customer Ticket Price
        if (isset($_SESSION['customerTicket'])){
          $ticket = $_SESSION['customerTicket'];
          $ticketSum  = $_SESSION['customerValue'];
          $finalTicketCost = $_SESSION['customerFinal'];
        } 
        ?>
        <h3>Seats:</h3> <?php
        foreach($ticketSum as $t){

        }
    
        
        $add=0;
        foreach($ticket as $e){
              //foreach($ticketSum as $number){
                        $ticket = mysqli_real_escape_string($conn,$e);
                        //$ticketSum = mysqli_real_escape_string($conn,$ticketSum);
                        $finalTickets = mysqli_real_escape_string($conn,$finalTicketCost);
                        
                        echo $e." ";
                        echo $ticketSum[$add]."<br>";
              $sql = "INSERT INTO orderedTickets(id,timeV,dateV,idForRoom,ticket,sum,finalPrice) VALUES('$id','$time','$date','$idForRoom','$e','$ticketSum[$add]','$finalTicketCost')";
    

              if ($conn->query($sql) ===TRUE){
                //echo "NEW RECORD";
              }else{
                echo "ERROR:".$mysql;
              }
              
              $add = $add+1;
        //}
}
        /*foreach($ticket as $z){
                echo $z;
                echo "<br>";
        }
        foreach($ticketSum as $e){
                echo $e;
                echo "<br>";
        }*/
        echo "Final Cost For Items:".$finalTicketCost;
        echo "<br>";

        //Customer Item Price
        if (isset($_SESSION['customerItem'])){
          $item = $_SESSION['customerItem'];
          $finalItemCost = $_SESSION['itemsFinal'];
         } 
         if (isset($_SESSION['itemCost'])){
                $itemCost = $_SESSION['itemCost'];
         }
         //$a=0;
        /*foreach($item as $i){
              echo $i;
              //echo $itemCost;
              //$a = $a +1;
              echo "<br>";
        }
        foreach($itemCost as $a){
                echo $a;
                echo "<br>";
        }
        //echo $itemCost;
        foreach($finalItemCost as $f){
                echo $f;
                echo "<br>";
        }*/
        ?>
        <h3>Concessions:</h3> <?php
        $add=0;
        foreach($item as $i){
              //foreach($ticketSum as $number){
                        $ticket = mysqli_real_escape_string($conn,$i);
                        //$ticketSum = mysqli_real_escape_string($conn,$ticketSum);
                        //$finalTickets = mysqli_real_escape_string($conn,$finalTicketCost);
                        //echo $i;
                        //echo $itemCost[$add];
                        //echo $finalItemCost[$add];
                        $stringPrint = $i;
                        $splitCapital = preg_split('/(?=[A-Z])/',$stringPrint);
                        $capital = implode(' ',$splitCapital);
                        echo $capital." ";
                        echo $itemCost[$add]."<br>";
              $sql = "INSERT INTO orderedItems(id,timeV,dateV,idForRoom,item,itemCost,finalItemCost) VALUES('$id','$time','$date','$idForRoom','$i','$itemCost[$add]','$finalItemCost[$add]')";
    

              if ($conn->query($sql) ===TRUE){
                //echo "NEW RECORD";
              }else{
                echo "ERROR:".$mysql;
              }
              
              $add = $add+1;
        //}
}
        /*foreach($finalItemCost as $f){
                echo $f;
        }*/
        ?>
        <h3>Total:</h3><?php
        echo "$".$_SESSION['finalTotal'];
        ?>
<!--<button onclick="removeIndex('Adult')"> Delete Index </button>-->



<h3>Billing Info:</h3>
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
        </p>
        <input type="submit" value="Submit">
</body>
</html>
