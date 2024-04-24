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


        //Get ticket Cost from database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "indiana";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn-> connect_error){
            die("Connection Error");
        }
    
        //read in food and drink Items
        $sql = "SELECT ticket,cost FROM prices ORDER BY ticket";
        $result = $conn->query($sql);
       
        //Read in ticket and store into javascript array
        //Read In to php array
        $ticketArray = array();
        $costArray = array();
   
        $a = 0;
        if ($result->num_rows >0){
        while($row = $result->fetch_assoc()){
                
                //echo $row['foodItem'];
                $ticketArray[$a] = $row['ticket'];
                //echo $ticketArray[$a];
                //Adding cost field
                $costArray[$a] = $row['cost'];
                //echo $costArray[$a];

                //test
                //array_push($food,$row['foodItem'])
                $a = $a + 1;
                //echo "<br>";
        }
      }
     //Combine Arrays
     $ticketCost = array();
     $i=0;
     while ( $i != count($ticketArray)){
            //echo $food[$i];
            $ticketCost[$ticketArray[$i]] = $costArray[$i];
            //echo $foodPrice[$food[$i]];
            $i = $i +1;
     }

     //Just to print out seat types from database for customer selection
     foreach($ticketCost as $ticketI => $costI){
            //echo $ticketI;
     }






       echo "SEAT:<br>";
       //Original Code
       foreach ($typeTickets as $ticket) 
       {
        
        echo "<label for='$ticket'>$ticket:<br></label>";
        echo "<select name='tickets[$ticket]'>
             <option value='Adult'>Adult</option>
             <option value='Child'>Child</option>
             <option value='Senior'>Senior</option>
                                   </select><br>";
       }

       

       ?>
       <script>
       //save Tickets
       
       function save(){
       //Save Tickets selected from customer

       //Convert php array into javascript array
       var customerTicketArray = <?php echo json_encode($typeTickets); ?>; 

       //Seperate arrT for key and value
       let ticketNumIndex = Object.keys(customerTicketArray);
       let customerTicketNum = Object.values(customerTicketArray);
       
       //Customer Ticket Number Index
       const ticketsIndex = JSON.stringify(ticketNumIndex);
       sessionStorage.setItem('ticketNumIndex',ticketsIndex);
       //Cusotmer Ticket Number
       const ticketsNumber = JSON.stringify(customerTicketNum);
       sessionStorage.setItem('customerTicketNum',ticketsNumber);


       //Save Ticket Type and Cost for cusotmer to calculate price on saveTickets.php

       //Convert php array into javascript array
       var TicketPriceArray = <?php echo json_encode($ticketCost); ?>; 

       //Seperate arrT for key and value
       let ticketNameData = Object.keys(TicketPriceArray);
       let costPerTicket = Object.values(TicketPriceArray);

       //Ticket Type from database used to match later
       const ticketsNum = JSON.stringify(ticketNameData);
       sessionStorage.setItem('ticketNameData',ticketsNum);
       //Ticket Cost from database
       const ticketsType = JSON.stringify(costPerTicket);
       sessionStorage.setItem('costPerTicket',ticketsType);
       
       }
       </script>
       
        <input type="submit" onclick="save()" value="Submit">
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