<?php
session_start();
?>

<DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="concessions.css">
        <style>
            table {
                    margin: 0 auto;
                    font-size: 20px;
                    border: 1px solid black;
        }
        h1{
                text-align:center;
                font-size: xx-large;
        }
        td{
    border:5px solid black;
    background-color: green;
    font-weight:lighter;
        }
th, td{
    text-align:center;
    padding: 10px;
    font-weight:bold;
        }
        </style>
</head>
<form action="FinalPayment.php"method="post">
<?php
include_once('checkout.php');
require_once 'checkout.php';
if (isset($_SESSION['tickets'])){
$enteredTickets = $_SESSION['tickets'];

 


$arrayCost = [];
//$_SESSION['customer'] = array();
$_SESSION['customerTicket'] = array();
$_SESSION['customerValue'] = array();
$_SESSION['customerCost'] = array();
foreach($enteredTickets as $key => $value)

        {
        
        //echo "Seat ". $value . "<br>";
        $_SESSION["personSeat"] = $value;
        //echo "SESSION SEAT:";
        array_push($_SESSION['customerTicket'],$key);
        array_push($_SESSION['customerValue'],$value);
        }
    //echo "YES THIS IS:".$arrayCost;
    //Inputs ticket number and price into table reservationtimes
    foreach ($enteredTickets as $type => $ticket)
    {
    $type = mysqli_real_escape_string($conn,$type);
    $ticket = mysqli_real_escape_string($conn,$ticket);
    //echo $type;
    //echo $ticket;
    //$array_push($arrayCost);
    
    /*$sql = "INSERT INTO reservedtimes (type,ticket) VALUES('$type','$ticket')";
    
    if (mysqli_query($conn,$sql)){
        }



    }*/
}
}


//test adding items
if (isset($_POST['foodVal'])){
    $foodValue = $_POST['foodVal'];
    
    //$arrayCost = [];
    //$_SESSION['customer'] = array();
    $_SESSION['customerItem'] = array();
    $_SESSION['itemCost'] = array();
    $_SESSION['itemsFinal'] = array();
    foreach($_POST["foodVal"] as $keyItem => $valueItem)
             //echo $valueItem;
            {
                if($valueItem > 0){
                     //echo "FoodVal ".$keyItem. $valueItem . "<br>";
            //$_SESSION["personSeat"] = $value;
            //echo "SESSION SEAT:";
                    //array_push($_SESSION['customerItem'],$keyItem);
            //array_push($_SESSION['customerValue'],$value);
                  }
            }
        //echo "YES THIS IS:".$arrayCost;
        foreach ($foodValue as $item => $num)
        {
        $item = mysqli_real_escape_string($conn,$item);
        $num = mysqli_real_escape_string($conn,$num);
        //echo $item;
        //echo $num;
        //Not Working but loop below has $num != 0
        if ($num == 0){
            unset($item);
            unset($num);
        }
        }
    }
    










?>
<body>
    <section>
        <h1>Tickets:</h1>
        <table id="costTable">
            <tr>
                <th>Tickets:</th>
                <th>Item Quantity:</th>
                <th>Final Item(s) Cost:</th>
            </tr>
    <?php       
    $finalCost = 0;
    //Test
    foreach ($enteredTickets as $type => $ticket)
    {
    $type = mysqli_real_escape_string($conn,$type);
    $ticket = mysqli_real_escape_string($conn,$ticket);
    $key = $ticket;
    $sql = "SELECT ticket,cost FROM prices WHERE ticket='$key'";
    $result = mysqli_query($conn,$sql);
    //echo $ticket;
    $a = 0;
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
                if($row["ticket"] = $ticket){
                       ?>
                        <tr>
                        <td><?php echo $row["ticket"]; 
                        //$_SESSION[""]  
                              ?>, 
                        <td><?php echo $row["cost"]; 
                            //array_push($_SESSION['customerCost'],$row["cost"]);
                              //$a = $a+1;
                              ?> </td>
                         </tr>
                         
                
                        <?php
                        //$a = $a+1;
                       
                        
                }
                $_SESSION['customerFinal'] = $finalCost + $row["cost"];
                $finalCost = $finalCost + $row["cost"];

        }
    }}   

    //$finalCost = 0;
    //Test
    

    foreach ($foodValue as $item => $num)
    {
    $item = mysqli_real_escape_string($conn,$item);
    $num = mysqli_real_escape_string($conn,$num);
    $keyItem = $item;
    
    $sqlItem = "SELECT foodItem,foodPrice FROM foodprices WHERE foodItem= '$keyItem'";
    $resultItem = mysqli_query($conn,$sqlItem);
    //echo $ticket;
    $a = 0;
    $var = 0;
    //$var=array();
    if (mysqli_num_rows($resultItem) > 0){
        while($row = mysqli_fetch_assoc($resultItem)){
                if($row["foodItem"] = $item AND $num != 0){
                    //$row["foodItem"] = $ticket
                    //echo $row["foodItem"];
                    //echo "YES";
                       ?>
                        <tr>
                        
                        <td><?php echo $item; 
                                  array_push($_SESSION['customerItem'],$item);        
                              ?>, 
                        
                        
                        <td><?php echo $num; 
                                  array_push($_SESSION['itemCost'],$num);
                  
                              ?>, 
                        
                        
                        <td><?php echo  $var= $num*$row["foodPrice"]; 
                                  array_push($_SESSION['itemsFinal'],$var);
                              //$a = $a+1;
                              ?> </td>
                         </tr>
                         
                
                        <?php
                        $a = $a+1;
                       
                        $finalCost = $finalCost + $var;      
                }
            }
    }
}
    $_SESSION['finalTotal'] = $finalCost;
    //array_push($_SESSION['itemsFinal'],$num);
    ?>
    <tr>
    <th colspan="2"><?php echo "Final Cost: ".$finalCost; ?> </th>
    </tr>
    <?php

    //echo "<br>"."Final Cost:".$finalCost;
    //$_SESSION['finalcost'] = $finalCost;
    //echo "YES {$_SESSION['finalcost']}";


    ?>
    </table>
    <br>
    <!--<button onclick="deleteRow()">Click</button>
    <script>
        function deleteRow(){
            document.getElementById("costTable").deleteRow(0);
        }
       </script>*/-->
</section>
<input type="submit" value="Submit">
</form>
</body>
</html>
