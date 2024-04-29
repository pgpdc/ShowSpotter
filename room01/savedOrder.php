<html>

<head>
<link rel="stylesheet" href="saveOrder.css">
<link rel="stylesheet" href="/ShowSpotter/styles/navbar.css">
<title>Customer's Order Receipt</title>
</head>
<body>

<nav>
<div class="brand">ShowSpotter</div>
<div class="links">
    <a href="/ShowSpotter/">Home</a>
    <a href="concessions.php">Concessions</a>
    <a href="saveTickets.php">Checkout</a>
</div>
</nav>


<h1>Thank You For Your Order!</h1>
<h2>You can view your order history in your account</h2>
<?php
session_start();
$arrBuy = array();
foreach($_COOKIE as $key=> $value){
    //echo $key;
    //echo "<br>";
    //Remove ticket Name from string
    $ticketName = str_replace("Ticket_Number:","",$key);
    //Seperate different ticket/item name quantity and cost into own array
    $seperate = explode(":",$ticketName);
    //print_r($seperate);
    foreach ($seperate as $k => $c){
        //echo "YES";
        //echo $c;
        array_push($arrBuy,$c);
    }
    //array_push($arrBuy,$seperate);
}
$ca = count($arrBuy);
//echo $ca;
$i = 0;
//Ticket Arrays
$arrTicketNum = array();
$arrTicketName = array();
$arrTicketCost = array();
//Item Arrays
$arrItemQuantity = array();
$arrItemName = array();
$arrItemCost = array();
foreach($arrBuy as $key => $v){

    //Remove ticket Names
    $ticketType = str_replace("Ticket_Type","",$v);
    //echo $ticketType;
    //echo "noooooooooooo";
    $ticketCost = str_replace("Ticket_Final_Costs","",$ticketType);
    //Remove Item Names
    $itemQuantity = str_replace("Item's_Quantity","",$ticketCost);
    $itemValue = str_replace("Item's_Value","",$itemQuantity);
    $itemName = str_replace("Item's_Name","",$itemValue);
    //echo "YES";
    //echo $ticketCost;
    echo "<br>";
    if($key == '0'){
        ///echo 'yes it does';
        array_push($arrTicketNum,$itemName);
    }elseif($key == '1'){
        //echo 'yes it does';
        array_push($arrTicketName,$itemName);
    }elseif($key == '2'){
        //echo 'yes it does';
        array_push($arrTicketCost,$itemName);
    }elseif($key == '3'){
        //echo 'yes it does';
        array_push($arrItemQuantity,$itemName);
    }elseif($key == '4'){
        //echo 'yes it does';
        array_push($arrItemName,$itemName);
    }elseif($key == '5'){
        //echo 'yes it does';
        array_push($arrItemCost,$itemName);
    }
    //echo $c;
}

foreach($arrTicketNum as $k => $v){
    $seperateTicketNum = explode(",",$v);
    //print_r($seperateTicketNum);
}
//print_r($seperateTicketNum);

foreach($arrTicketName as $k => $v){
    $seperateTicketName = explode(",",$v);
    //print_r($seperateTicketName);
}
//print_r($seperateTicketName);

foreach($arrTicketCost as $k => $v){
    $seperateTicketCost = explode(",",$v);
    //print_r($seperateTicketCost);
}
//print_r($seperateTicketCost);


foreach($arrItemQuantity as $k => $v){
    $seperateItemAmount = explode(",",$v);
    //print_r($seperateItemAmount);
}
//print_r($seperateTicketNum);

foreach($arrItemName as $k => $v){
    $seperateItemName = explode(",",$v);
    //print_r($seperateItemName);
    $itemnamereplace = str_replace("_"," ",$seperateItemName);
    //print_r($itemnamereplace);
}
//print_r($seperateTicketName);

foreach($arrItemCost as $k => $v){
    $seperateItemCost = explode(",",$v);
    $itemcostreplace = str_replace("_",".",$seperateItemCost);
    //print_r($itemcostreplace);
}
//print_r($seperateItemCost);



//Save Ticket reservations
require_once('seatreservelib.php');


echo "USER:" .$_SESSION["userid"] ."<br>";
echo "TIME:" .$_SESSION["time"] ."<br>";
echo "DATE:"  .$_SESSION["date"] ."<br>";
echo "ROOM ID:" .$_SESSION["id"] ."<br>";
$user = $_SESSION["userid"];
$time = $_SESSION["time"];
$date = $_SESSION["date"];
$id = $_SESSION["id"];
//echo $_SESSION["seats"];
$_RSV->save($_SESSION["sessid"], $_SESSION["userid"], $_SESSION["seats"], $_SESSION["time"], $_SESSION["date"], $_SESSION["id"]);
function connectData(){
//Make database connection to php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "indiana";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn-> connect_error){
            die("Connection Error");
        }
    }

$i = 0;

$arrFinal = array();
$spaceO = str_repeat('&nbsp',5);
$spaceEightTeen = str_repeat('&nbsp',15);
//$sql = "INSERT INTO orderedtickets VALUES('$user', '$time','$date','$id','$seralizedTicketNum','$seralizedTicketNum','$seralizedTicketNum')";
echo "Ticket Type" ." " ."Ticket Number" ." " ."Ticket Cost" ."<br>";
foreach($seperateTicketName as $c => $v){
    connectData();
    echo  $spaceO.$v .$spaceEightTeen.   $seperateTicketNum[$i] .$spaceEightTeen."&nbsp&nbsp&nbsp    $" .$seperateTicketCost[$i] ."<br>";
    array_push($arrFinal,$seperateTicketCost[$i]);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "indiana";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn-> connect_error){
                die("Connection Error");
            }
    $sql = "INSERT INTO orderedtickets VALUES('$user', '$time','$date','$id','$seperateTicketNum[$i]','$v','$seperateTicketCost[$i]')";
    $i = $i + 1;
    

    if ($conn->query($sql)===TRUE){
        //echo "YES";
    }else{
        echo "ERROR";}
    $conn->close();
    
}


$i=0;
$wordSpaceThree = str_repeat('&nbsp',3);
$wordSpaceFive = str_repeat('&nbsp',5);
$wordSpace = str_repeat('&nbsp',14);
echo "Item Quantity" ." " ."Item Name" ."$wordSpaceFive" ."Item Cost" ." "."Final Item Cost"."<br>";
foreach($itemnamereplace as $c => $v){
    $finalItemCost = (float)$seperateItemAmount[$i]*(float)$itemcostreplace[$i];
    echo $seperateItemAmount[$i]. $wordSpace .$wordSpaceFive."&nbsp".$itemnamereplace[$i]. $wordSpaceThree. $itemcostreplace[$i]. $wordSpace .$finalItemCost. "<br>";
    array_push($arrFinal,$finalItemCost);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "indiana";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn-> connect_error){
                die("Connection Error");
            }

    $sql = "INSERT INTO ordereditems VALUES('$user', '$time','$date','$id','$seperateItemAmount[$i]','$itemnamereplace[$i]','$itemcostreplace[$i]','$finalItemCost')";
    $i = $i + 1;
    //echo "SAVED ITEM";

    if ($conn->query($sql)===TRUE){
        //echo "YES";
    }else{
        echo "ERROR";}
    $conn->close();
    
}

echo "Total Price:   $ " .(float)array_sum($arrFinal);

?>


<br>





      
 
</body>
</html>