<html>

<head>
<link rel="stylesheet" href="StylesCustomer/orderPrint.css">
</head>
<?php
      session_start();
      require("../navbar.php"); 
      include "databaseConnectBilling.php";
      $user = $_SESSION['name'];
?>
<!doctype html>
<html>
  <body>
    <h1>Order History</h1>
    <h2>Select below the date of your order for either tickets,concessions,or billing</h2>
  <?php
        //Read in database table for tickets
        $sqlNew="SELECT timeV,dateV FROM orderedtickets WHERE user_id='$user'";

        $customer ="";
        $queryD = $conn->query($sqlNew);

        //Loop through options for dates for tickets
        foreach($queryD as $row){
          $customer .= "<option name='{$row["dateV"]}'>{$row["dateV"]}</option>";
        }
        if ($conn->query($sqlNew)===TRUE){
        }else{
          echo "ERROR";
        $conn->close();}
           
  ?>
  <form method="post">
      <div><label>Select a Date for tickets:</label></div>
      <select name="customer"><?php echo $customer; ?></select>
      </div>
  <div> <input type="submit" name="submit"></div>
  </form>
  <?php
    include "databaseConnectBilling.php";
    if (isset($_POST["submit"])){
    
      $customer = $_POST["customer"];
      $queryT = "SELECT * FROM orderedtickets WHERE dateV= '$customer'and user_id='$user'";
      $result = $conn->query($queryT);
          
      //Read in ticket/cost and store into javascript array
      $ticketArray = array();
      $costArray = array();
      
      $a = 0;
      $wordSpaceFive = str_repeat('-',15);
      if ($result->num_rows >0){
          while($row = $result->fetch_assoc()){
            echo "Movie Time:".$row['timeV']."<br>";
            echo "Room Number:".$row['id']."<br>";
            echo "Ticket Number:".$row['ticketNumber']."<br>";
            echo "Ticket Type:".$row['ticketName']."<br>";
            echo "Ticket Cost: $".number_format($row['ticketCost'],2)."<br>";
            echo $wordSpaceFive."<br>";
          }
        }
      }
      
      $sqlI="SELECT timeV,dateV FROM ordereditems WHERE userid='$user'";

      $customerItems ="";
      $queryA = $conn->query($sqlI);
      $i = 0;
      //Loops through database concession date options 
      foreach($queryA as $row){
        
        $customerItems .= "<option name='{$row["dateV"]}'>{$row["dateV"]}</option>";
       
      }
  ?>
<!doctype html>
<!--Shows concession date options-->
  <html>
    <body>
      <form method="post">
        <div><label>Select a Date for Items:</label></div>
        <select name="customerItems"><?php echo $customerItems; ?></select>
        </div>
  <div> <input type="submit" name="submitA"></div>
  </form>
  <?php
      $content = "";
      if (isset($_POST["submitA"])){
        
        $customerItems = $_POST["customerItems"];
        $queryT = "SELECT * FROM orderedItems WHERE dateV= '$customerItems'and userid='$user'";
        $resultI = $conn->query($queryT);
            
        $wordSpaceFive = str_repeat('-',15);
        
        //Loops through and displays the concession items bought on that date
        if ($resultI->num_rows >0){
          while($row = $resultI->fetch_assoc()){

            echo "Item Quantity:".$row['itemQuantity']."<br>";
            echo "Item Type:".$row['item']."<br>";
            echo "Item Cost: $".number_format($row['itemCost'],2)."<br>";
            echo "Final Item Cost: $".number_format($row['finalItemCost'],2)."<br>";
            echo $wordSpaceFive."<br>";
          }
      }
      }

  ?>
  <?php

      $sqlPays="SELECT * FROM paymentrecord WHERE userid='$user'";

      $customerTime ="";
      $queryPayment = $conn->query($sqlPays);
      $i = 0;
      //Loops through database payment date options 
      foreach($queryPayment as $row){
        
        $customerTime .= "<option name='{$row["date"]}'>{$row["date"]}</option>";
        
          
      }

  ?>
  <!doctype html>
  <!--Shows payment date options-->
  <html>
    <body>
      <form method="post">
        <div><label>Select a Date for Billing:</label></div>
        <select name="customerTime"><?php echo $customerTime; ?></select>
        </div>
  <div> <input type="submit" name="submitB"></div>
  </form>
  <?php
      $content = "";
      if (isset($_POST["submitB"])){
        
        include "databaseConnectBilling.php";
        $customerTime = $_POST["customerTime"];
        $queryPay = "SELECT * FROM paymentrecord WHERE date='$customerTime'and userid='$user'";
        $resultPay = $conn->query($queryPay);
            
        $wordSpaceFive = str_repeat('-',15);

        //Loops through and displays the concession items bought on that date
        if ($resultPay->num_rows >0){
          while($row = $resultPay->fetch_assoc()){
            echo "User:".$row['userid']."<br>";
            echo "Time:".$row['time']."<br>";
            echo "Date of Purchase:".$row['date']."<br>";
            echo "Card Num:".$row['cardNum']."<br>";
            echo "Points Earned:".$row['point']."<br>";
            echo "Discount: $".number_format($row['discount'],2)."<br>";
            echo "Total Cost: $".number_format($row['finalCost'],2)."<br>";
            echo $wordSpaceFive."<br>";
          }
      }
      }
  ?>
  <!--Return to customer hub page-->
  <button value="Customer Hub"
    onclick="window.location.href='customer.php'">Customer Hub</button>
</body>
</html>
