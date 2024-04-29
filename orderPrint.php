<html>

<head>
<link rel="stylesheet" href="customer.css">
</head>
<?Php
//Navbar
include_once("navbar.php");


//This is for TICKETS

 //Set up database connection
 $DATABASE_HOST ='localhost';
 $DATABASE_USER = 'root';
 $DATABASE_PASS = '';
 $DATABASE_NAME = 'indiana';
 $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
  if (!$conn){
        die("Conection failed:".mysqli_connect_error());
    }

//Read in database table for tickets
$sql="SELECT timeV,dateV FROM orderedtickets WHERE user_id='test8'";


$customer ="";
$queryD = $conn->query($sql);

//Loop through options for dates of customer
foreach($queryD as $row){
  $customer .= "<option name='{$row["dateV"]}'>{$row["dateV"]}</option>";
}

                
?>
<!doctype html>
<!-- This is for ticket selection of date-->
<html>
  <body>
    <h1>Order History</h1>
    <h2>Select below the date of your order for either tickets or concessions</h2>
    <form method="post">
      <div><label>Select a Date for tickets:</label></div>
      <select name="customer"><?php echo $customer; ?></select>
      </div>
<div> <input type="submit" name="submit"></div>
</form>
<?php

//When ticket date submitted it reads the tickets bought on that date for user
if (isset($_POST["submit"])){
  //echo "YES";
  //echo $_POST["customer"];
  $customer = $_POST["customer"];
  $queryT = "SELECT * FROM orderedtickets WHERE dateV= '$customer'and user_id='test8'";
  $result = $conn->query($queryT);
       
        //Read in ticket and store into javascript array
        //Read In to php array
  $ticketArray = array();
  $costArray = array();
   
  $a = 0;
  if ($result->num_rows >0){
      while($row = $result->fetch_assoc()){
        echo "Movie Time:".$row['timeV']."<br>";
        echo "Room Number:".$row['id']."<br>";
        echo "Ticket Number:".$row['ticketNumber']."<br>";
        echo "Ticket Type:".$row['ticketName']."<br>";
        echo "Ticket Cost:".$row['ticketCost']."<br>";
      }
    }
  }
  ?>

<?php
//Read in database table for items
$sqlI="SELECT timeV,dateV FROM ordereditems WHERE userid='test8'";

$customerItems ="";
$queryA = $conn->query($sqlI);

//Loops through database concession date options 
foreach($queryA as $row){
  $customerItems .= "<option name='{$row["dateV"]}'>{$row["dateV"]}</option>";
}
?>
<!doctype html>
<!--Shows concession date options-->
<html>
  <body>
    <h3>Select Date</h3>
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
  $queryT = "SELECT * FROM orderedItems WHERE dateV= '$customerItems'and userid='test8'";
  $resultI = $conn->query($queryT);
       
  //Loops through and displays the concession items bought on that date
  if ($resultI->num_rows >0){
      while($row = $resultI->fetch_assoc()){
        //echo "Movie Time:".$row['timeV']."<br>";
       // echo "Room Number:".$row['id']."<br>";
        echo "Item Quantity:".$row['itemQuantity']."<br>";
        echo "Item Type:".$row['item']."<br>";
        echo "Item Cost:".$row['itemCost']."<br>";
        echo "Final Item Cost:".$row['finalItemCost']."<br>";
      }
    }
  }
  ?>
  <!--Return to customer hub page-->
<input type="button" value="Customer Homepage"
    onclick="window.location.href='customer.php'"/><br>
</body>
</html>
</html>