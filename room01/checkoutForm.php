<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
</head>
<body>
    
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
       <form action="saveTickets.php"method="post">
       <?php
        //Checkout Cart
        require "seatreservelib.php";
        $_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
        
       $typeTickets = $_POST['seats'];
       
       foreach ($typeTickets as $ticket) 
       {
        echo "<label for='$ticket'>$ticket:</label>";
        echo "<select name='tickets[$ticket]'>
             <option value='Adult'>Adult</option>
             <option value='Child'>Child</option>
             <option value='Senior'>Senior</option>
                                   </select><br>";
       }




       foreach($_POST["seats"] as $key => $value)

        {
        
        echo "Seat ". $value . "<br>";
        
        
        /*echo "Enter what ticket ype it is (Adult,Child)?";
        $tickets= readline('Enter what ticket ype it is (Adult,Child)?');
        echo "It is:". $tickets;-->
        <?php*/
        }
        ?>
        <input type="submit" value="Submit">
        </form>
        <!--<form id="ninja" method="post" action="checkoutForm.php">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
    </form>
    <button id="go" onclick="reserve.save()">Reserve Seats</button>-->
  </body>






        <h3>Billing Info:</h3>
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
        <input type="submit" value="Submit">
</form>
</body>
</html>