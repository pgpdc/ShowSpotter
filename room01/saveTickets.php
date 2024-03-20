<DOCTYPE html>
<html>
<head>
    <style>
        table {
            margin: 0 auto;
            font-size: large;
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

require_once 'checkout.php';

$enteredTickets = $_POST['tickets'];

foreach($_POST["tickets"] as $key => $value)

        {
        
        //echo "Seat ". $value . "<br>";
        }
    
    //Inputs ticket number and price into table reservationtimes
    foreach ($enteredTickets as $type => $ticket)
    {
    $type = mysqli_real_escape_string($conn,$type);
    $ticket = mysqli_real_escape_string($conn,$ticket);
    


    $sql = "INSERT INTO reservedtimes (type,ticket) VALUES('$type','$ticket')";
    
    if (mysqli_query($conn,$sql)){
        }



    }


    



/*
$sql = "SELECT cost FROM prices WHERE ticket=$ticket;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    echo $row["ticket"].$row["cost"];
}*/
?>
<body>
    <section>
        <h1>Tickets:</h1>
        <table>
            <tr>
                <th>Tickets</th>
                <th>Cost</th>
            </tr>
    <?php       
    $finalCost = 0;
    foreach ($enteredTickets as $type => $ticket)
    {
    $type = mysqli_real_escape_string($conn,$type);
    $ticket = mysqli_real_escape_string($conn,$ticket);
    $key = $ticket;
    $sql = "SELECT ticket,cost FROM prices WHERE ticket='$key'";
    $result = mysqli_query($conn,$sql);
    //echo $ticket;

    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
                if($row["ticket"] = $ticket){
                       ?>
                        <tr>
                        <td><?php echo $row["ticket"]; ?> </td>
                        <td><?php echo $row["cost"]; ?> </td>
                        </tr>
                        <?php
                        $finalCost = $finalCost + $row["cost"];

                        
                }
        }
    }
    }
    echo "<br>"."Final Cost:".$finalCost;

    ?>
    </table>
</section>
<input type="submit" value="Submit">
</form>

       <?php
        //Checkout Cart
        //require "seatreservelib.php";
        //$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
        
       


/*       </form action="FinalPayment.php"method="post">
<input type="hidden" name="seats" value="value"> 
<input type="submit" value="Send Data"> 
<?php
       
       //$typeTickets = $_POST['seats'];
       //$ticketPrice = $_POST['costs'];
       //$FinalCost   = $_POST['final'];
?>*/
?>

</body>
</html>
