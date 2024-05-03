<html>
<head>
<link rel="stylesheet" href="StylesCustomer/customerInfo.css">
</head>
<?php
    session_start();
    require("../navbar.php"); 
    include "databaseConnectBilling.php";
?>
<body>
    
    <h1>Rewards:</h1>
    <h2>Here are your current points:</h2>
    <?php

        $sql = "SELECT userid,notusedPoints,pointsNum FROM points WHERE userid='$user'";
        $queryPointsResult = mysqli_query($conn, $sql);

        if(mysqli_num_rows($queryPointsResult)>0){
            if($row = mysqli_fetch_assoc($queryPointsResult)){
                    echo "<b>Account Point Info:</b><br>";
                    echo "<b>Username:</b> ". $row["userid"]."<br>";
                    echo "<b>Money that will become points:</b> $". number_format($row["notusedPoints"],2)."<br>";
                    echo "<b>Points:</b> ". $row["pointsNum"]."<br>";
                    $conn->close();
        }
        }else{
    ?>
        <h2>Points account created:</h2>
        <?php
            echo "User:".$user."<br>";
            $valNot = 0;
            $valPoints = 5;
            echo "Money that can become points set to:".$valNot."<br>";
            echo "Points(For new account you get 5 points):".$valPoints."<br>";

            include_once("databaseConnectBilling.php");
            $sqlPoints = "INSERT INTO points VALUES('$user','$valNot','$valPoints')";

            if ($conn->query($sqlPoints)===TRUE){
            }else{
                echo "ERROR";}
            $conn->close();
            }
        ?>
 <!--Return to customer hub page-->
 <button value="Customer Hub" value="Customer Homepage"
    onclick="window.location.href='customer.php'">Customer Hub</button>
</body>
</html>