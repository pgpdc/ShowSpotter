<html>

<head>
<link rel="stylesheet" href="saveOrder.css">
<link rel="stylesheet" href="/ShowSpotter/styles/navbar.css">
<title>Customer's Order Receipt</title>
</head>
<body>


<script>
sessionStorage.clear();

</script>


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
include "databaseConnect.php";
//include "databaseConnect.php";





//Gets time and date for Order
$dateFound = time();
date_default_timezone_set("America/New_York");
$timeOrder = date("h:i:sa");
$dateFound = time();
$dateOrder =  date("Y-m-d",$dateFound);
$idOrder = 0;
echo "<h3>Ordered at:".$timeOrder."     ".$dateOrder."</h3>";



$arrBuy = array();
foreach($_COOKIE as $key=> $value){
    //echo "<br>";
    //Remove ticket Name from string
    $ticketName = str_replace("Points_Left","",$key);
    //Seperate different ticket/item name quantity and cost into own array
    $seperate = explode(":",$ticketName);
    //print_r($seperate);
    foreach ($seperate as $k => $c){
        //echo "YES";
        //echo "This is val:".$c."<br>";

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

//Discount
foreach($arrBuy as $key => $v){
    
   //Remove Discount
   $pointsF = str_replace("Discount","",$v);
   //echo "Points:".$pointsF."<br>";
   $discountF = str_replace("FinalCost","",$pointsF);
   //echo "Discount:".$discountF."<br>";
   $finalPayF = str_replace("ENDPAYTicket_Number","",$discountF);
   //echo "Final Costs:".$finalPayF."<br>";





    

    

    //Remove ticket Names
    $ticketType = str_replace("Ticket_Type","",$finalPayF);
    $ticketCost = str_replace("Ticket_Final_Costs","",$ticketType);
    //Remove Item Names
    $itemQuantity = str_replace("Item's_Quantity","",$ticketCost);
    $itemValue = str_replace("Item's_Value","",$itemQuantity);
    $itemName = str_replace("Item's_Name","",$itemValue);

   

    







   
    if($key == '0'){
        //echo $itemName."0<br>";
        $nothing = $itemName;
        //array_push($arrpointsF,$itemName);
    }elseif($key == '1'){
        //echo 'yes it does';
        //echo $itemName."Points<br>";
        $point = $itemName;
        //array_push($arrdiscountF,$itemName);
    }elseif($key == '2'){
        //echo 'yes it does';
        //echo $itemName." discount<br>";
        $discount = $itemName;
        //array_push($arrfinalPayF,$itemName);
    }elseif($key == '3'){
        ///echo 'yes it does';
        $totalCosts = $itemName;
        //array_push($arrTicketNum,$itemName);
    }elseif($key == '4'){
        ///echo 'yes it does';
        array_push($arrTicketNum,$itemName);
    }elseif($key == '5'){
        //echo 'yes it does';
        array_push($arrTicketName,$itemName);
    }elseif($key == '6'){
        //echo 'yes it does';
        array_push($arrTicketCost,$itemName);
    }elseif($key == '7'){
        //echo 'yes it does';
        array_push($arrItemQuantity,$itemName);
    }elseif($key == '8'){
        //echo 'yes it does';
        array_push($arrItemName,$itemName);
    }elseif($key == '9'){
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

$checkIfEmptyTickets = $seperateTicketCost[0];
//echo "YES".$checkIfEmptyTickets;
if($checkIfEmptyTickets != 0 && $checkIfEmptyTickets != null){

//Save Ticket reservations
require_once('seatreservelib.php');

echo "<table>";
echo "<tr>";
echo "<th>"."User"."</th>"."<td>".$_SESSION["userid"]."</td>";
echo "<th>"."Time:"."</th>"."<td>".$_SESSION["time"]."</td>";
echo "<th>"."Date:"."</th>"."<td>".$_SESSION["date"]."</td>";
echo "<th>"."Room Id:"."</th>"."<td>".$_SESSION["id"]."</td>";
echo "</tr>";
echo "</table>";
$user = $_SESSION["userid"];
$time = $_SESSION["time"];
$date = $_SESSION["date"];
$id = $_SESSION["id"];









$i = 0;



echo "<table>";
echo "<th>"."Ticket Type"."</th>";
echo "<th>"."Ticket Number"."</th>";
echo "<th>"."Ticket Cost"."</th>";

foreach($seperateTicketName as $c => $v){
    
    //array_push($arrFinal,$seperateTicketCost[$i]);
    echo "<tr>";
    echo "<td>".$v."</td>";
    echo "<td>".$seperateTicketNum[$i]."</td>";
    echo "<td>".$seperateTicketCost[$i]."</td>";
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $_SESSION["theater"];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn-> connect_error){
                die("Connection Error");
            }
    $sql = "INSERT INTO orderedtickets VALUES('$user', '$time','$date','$id','$seperateTicketNum[$i]','$v','$seperateTicketCost[$i]')";
    $i = $i + 1;
    

    if ($conn->query($sql)===TRUE){
        //echo "YES";
    }else{
        //echo "ERROR";}
    $conn->close();
    echo "</tr>";
    
}

}
echo "</table>";

//Reserve Seats
$_RSV->save($_SESSION["sessid"], $_SESSION["userid"], $_SESSION["seats"], $_SESSION["time"], $_SESSION["date"], $_SESSION["id"]);
}else{
    $id=0;
}


$i=0;
$checkIfEmpty = in_array("",$seperateItemAmount);
if($checkIfEmpty != 1){

echo "<table>";
echo "<th>"."Item Quanitity"."</th>";
echo "<th>"."Item Name"."</th>";
echo "<th>"."Item Individual Cost"."</th>";
echo "<th>"."Item Final Cost"."</th>";
//$wordSpaceFive = str_repeat('&nbsp',5);
//$wordSpace = str_repeat('&nbsp',14);

foreach($itemnamereplace as $c => $v){
   //echo "<td>".$seperateItemAmount[$i]."</td>";
   //Word Spacing 
   $finalItemCost = (float)$seperateItemAmount[$i]*(float)$itemcostreplace[$i];


   echo "<tr>";
   echo "<td>".$seperateItemAmount[$i]."</td>";
   echo "<td>".$v."</td>";
   echo "<td>".$itemcostreplace[$i]."</td>";
   echo "<td>".$finalItemCost."</td>";



  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $_SESSION["theater"];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn-> connect_error){
                die("Connection Error");
            }

    $sql = "INSERT INTO ordereditems VALUES('$user', '$timeOrder','$dateOrder','$idOrder','$seperateItemAmount[$i]','$itemnamereplace[$i]','$itemcostreplace[$i]','$finalItemCost')";
    $i = $i + 1;
    //echo "SAVED ITEM";

    if ($conn->query($sql)===TRUE){
        //echo "YES";
    }else{
        //echo "ERROR";}
    //$conn->close();
    echo "</tr>";
}
}


echo "</table>";
}

//Entering into databse for points and paymentRecord
//Call database for points
//Read in how much money user previously has that will become points
$pointsql = "SELECT notusedPoints FROM points WHERE userid='$user'";
$queryPointsResult = mysqli_query($conn, $pointsql);

if(mysqli_num_rows($queryPointsResult)>0){
if($row = mysqli_fetch_assoc($queryPointsResult)){
    $addMoneyNum = $row['notusedPoints'];
}}



//Count for points 
$earned = 0;
//Set totalCosts as $pointCalc
$pointCalc = $totalCosts;
$pointCalc = $pointCalc + $addMoneyNum;


//Add money for next payment
while ($pointCalc >= 30){
    $earned = $earned + 1;
    $pointCalc = $pointCalc - 30;
}
//Add database money to become points to database



//Add earned points to points
$point = $point + $earned;
//echo "Final point calc:".$pointCalc;
//echo "Total Points".$point;
//include "databaseConnect.php";
$sqlPoints = "UPDATE points SET notusedpoints = '$pointCalc',pointsNum = '$point' WHERE userid = '$user'";
if ($conn->query($sqlPoints)===TRUE){
    //echo "YES";
}else{
    echo "ERROR";}
//$conn->close();



//Add up points

//Insert Database payment
//include "databaseConnect.php";
echo "<br>";
echo "<b>Payed With:</b> ".$_SESSION['cardNumberHidden']."<br>";
echo "<b>Points Earned:</b> ".$earned."<br>";
echo "<b>Discount Given:</b> $".number_format($discount,2)."<br>";
echo  "<b>Total Costs:</b> $".number_format($totalCosts,2)."<br>";


$cardNum = $_SESSION['cardNumber'];
$sqlEnter = "INSERT INTO paymentRecord VALUES('$user', '$timeOrder','$dateOrder','$id','$cardNum','$earned','$discount','$totalCosts')";
$i = $i + 1;

if ($conn->query($sqlEnter)===TRUE){
    //echo "YES";
}else{
    echo "ERROR";}
//$conn->close();


?>





      
 
</body>
</html>