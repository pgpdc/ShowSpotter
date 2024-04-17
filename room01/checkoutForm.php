<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>Checkout Form</title>
</head>
<body>
    
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
        
       <link rel="stylesheet" href="checkoutForm.css">
       <form action="concessions.php"method="post">
       <?php
        //Checkout Cart
        require "seatreservelib.php";
        $_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"], $_POST["time"], $_POST["date"], $_POST["id"]);
        
        //Creating session variables
        $_SESSION["userid"] = $_POST["userid"];
        $_SESSION["time"] = $_POST["time"];
        $_SESSION["date"] = $_POST["date"];
        $_SESSION["id"] = $_POST["id"];
       
        $typeTickets = $_POST['seats'];
       
       foreach ($typeTickets as $ticket) 
       {
        echo "SEAT:<br>";
        echo "<label for='$ticket'>$ticket:</label>";
        echo "<select name='tickets[$ticket]'>
             <option value='Adult'>Adult</option>
             <option value='Child'>Child</option>
             <option value='Senior'>Senior</option>
                                   </select><br>";
       }
       



       
        
        
        ?>
        <input type="submit" value="Submit">
        </form>

 </body>






 <!--<h3>Billing Info:</h3>
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
            <label for="address">Adress:</label>
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
        <input type="submit" value="Submit">-->
</form>
</body>
</html>