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
        require_once('seatreservelib.php');
        //echo $_POST["userid"];
        

        //Old Reserve Function spot
        //$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"], $_POST["time"], $_POST["date"], $_POST["id"]);
        
        //Creating session variables
        $_SESSION["sessid"] = $_POST["sessid"];
        $_SESSION["userid"] = $_POST["userid"];
        $_SESSION["time"] = $_POST["time"];
        $_SESSION["date"] = $_POST["date"];
        $_SESSION["id"] = $_POST["id"];
       

        $_SESSION["seats"]=$_POST['seats'];
        $typeTickets = $_SESSION["seats"];


        //Get ticket Cost from database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_SESSION["theater"];
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
    const d = new Date();
    let hour = d.getHours();
    let minutes = d.getMinutes();
    console.log("This is current time:"+hour +":"+minutes);
    </script>
    
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


</form>
</body>
</html>