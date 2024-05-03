<!DOCTYPE html>
<html>
<?php
        session_start();
?>

<head>
        <link rel="stylesheet" href="StylesCustomer/customerInfo.css">
</head>

<title>Account Details</title>
<style>

        .hidden{
                display:none;
        }
        .hiddenTwo{
                display:none;
        }   

</style>
</head>
<body>
        <?php

        require("../navbar.php"); 
        include "databaseConnectBilling.php";
        ?>
        <h1>Account Details</h1>
        <?php

            $sql = "SELECT username,cardName,creditNum,expDate,cvv,name,address,city,state,zipCode,billSame FROM paymentinfo WHERE username='$user'";
            $queryNameResult = mysqli_query($conn, $sql);

            if(mysqli_num_rows($queryNameResult)>0){
                echo "<table>";
                echo "<tr>";
                echo "<th>"."Account User"."<th>";
                if($row = mysqli_fetch_assoc($queryNameResult)){
                    echo "<tr>";
                    echo "<td>"."<b>Username:</b> ". $row["username"]."<td>"."<br>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>"."Account Payment Information:"."<th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Card Name:</b> ". $row["cardName"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Credit Card Number:</b> ".$row["creditNum"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Experiation Date:</b> ".$row["expDate"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Cvs:</b> ".$row["cvv"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>"."<b>Address</b> "."<th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Full Name:</b> ".$row["name"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Address:</b> ".$row["address"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>City:</b> ".$row["city"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>State:</b> ". $row["state"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Zip Code:</b> ".$row["zipCode"]."<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>"."<b>Billing Same:</b> ".$row["billSame"]."<td>";
                    echo "</tr>";
                    $conn->close();
                    echo "<tr>";
            }
            echo "<table>";
            }else{
            ?>
            <button value="New Pay" value="New Payment"
            onclick="window.location.href='newPayment.php'">Add Payment</button>
            <br>
            <?php
                }?>

        <script>

                function passHide(){
                    var a = document.getElementById("hidden");
                    console.log("YES");
                    if (a.style.display === "none"){
                        a.style.display = "block";
                    } else {
                        a.style.display = "none";
                    }
                }

        </script>
        
        <button onclick="passHide()">Update Payment</button>
        <br>
        <div class="hidden" id="hidden" display="none">
        <h2>Update Billing Information:</h2>
        <form method="post" action="customerInfo.php">
                <p>
                    <label for="cardName">Card Name:</label>
                    <input type="varchar" name="cardName" id="cardName" minlength="1" required>
                </p>
                <p>
                    <label for="creditNum">Credit Card Number:</label>
                    <input type="varchar" name="creditNum" id="creditNum" minlength="8"minlength="19">
                </p>
                <p>
                    <label for="expDate">Experation Date:</label>
                    <input type="date" name="expDate" id="expDate" value="2024-05-06" min="2024-05-02" max="2027-1-01" required>
                </p>
                <p>
                    <label for="cvv">Cvv:</label>
                    <input type="int" name="cvv" id="cvv"minlength="3"minlength="4" required>
                </p>
                <input type="submit" name="updateBilling" value="click">
        </form>
            </div>
        <script>

                function passHideTwo(){
                var a = document.getElementById("hiddenTwo");
                console.log("YES");
                if (a.style.display === "none"){
                    a.style.display = "block";
                } else {
                    a.style.display = "none";
                }
                }

        </script>

        <button onclick="passHideTwo()">Update Address</button>
        <br>
        <div class="hiddenTwo" id="hiddenTwo" display="none">
        <h2>Update Address Information:</h2>
        <form method="post" action="customerInfo.php">
        <p>
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name"minlength="1" required>
                </p>
                <p>
                    <label for="address">Address:</label>
                    <input type="varchar" name="address" id="address"minlength="1" required>
                </p>
                <p>
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city"minlength="1" required>
                </p>
                <p>
                    <label for="state">State:</label>
                    <input type="text" name="state" id="state"minlength="2" maxlength="2" required>
                </p>
                <p>
                    <label for="zipCode">Zip Code:</label>
                    <input type="int" name="zipCode" id="zipCode" minlength="5" maxlength="5" required>
                </p>
                <p>
                    <label for="billSame">Is billing address the same as your home address:</label>
                    <input type="text" name="billSame" id="billSame" minlength="2" maxlength="3" required>
                <br>
                <input type="submit" name="updateAddress" value="click">
                </p>
        </form>
        </div>

        <?php
            function updateBillingInfo(){  
                include "databaseConnectBilling.php";
                $cardName = $_POST['cardName'];
                $creditNum = $_POST['creditNum'];
                $expDate = $_POST['expDate'];
                $cvv = $_POST['cvv'];

                $sql = "UPDATE paymentinfo SET cardName='$cardName',creditNum='$creditNum',expDate='$expDate',cvv='$cvv' WHERE username='$user'";
                if ($conn->query($sql)===TRUE){
                }else{
                }
                }
                if(isset($_POST['updateBilling'])){
                    updateBillingInfo();
                }

                function updateAddressInfo(){  
                    include "databaseConnectBilling.php";
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zipCode = $_POST['zipCode'];
                    $billSame = $_POST['billSame'];
                    
                    $sql = "UPDATE paymentinfo SET name='$name',address='$address',city='$city',state='$state',zipCode='$zipCode',billSame='$billSame' WHERE username='$user'";
                    if ($conn->query($sql)===TRUE){
                    }else{
                        echo "no";
                    }
                    }
                    if(isset($_POST['updateAddress'])){
                        updateAddressInfo();
                    }
        ?>
        <!--Return to customer hub page-->
        <button value="Account Details" value="Customer Homepage"
            onclick="window.location.href='customer.php'">Return to Customer HomePage</button>

</body>
</html>

