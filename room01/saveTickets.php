<?php

require_once 'checkout.php';

$enteredTickets = $_POST['tickets'];

foreach($_POST["tickets"] as $key => $value)

        {
        
        echo "Seat ". $value . "<br>";
        }
    
    //Inputs ticket number and price into table reservationtimes
    foreach ($enteredTickets as $type => $ticket)
    {
    $type = mysqli_real_escape_string($conn,$type);
    $ticket = mysqli_real_escape_string($conn,$ticket);



    $sql = "INSERT INTO reservedtimes (type,ticket) VALUES('$type','$ticket')";
    
    if (mysqli_query($conn,$sql)){
        echo"Stored";
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
