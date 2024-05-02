<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width,initial-scale=1">
    <title>Checkout Form</title>
    <link rel="stylesheet" href="concessions.css">
    <?php 
    require("../navbar.php"); ?>
    <h1>Concessions</h1>
</head>

<body>
    
    
    <h2>Food and Drink Options:</h2>
    <h3>For drink: It is self-service and provided on site at your theatre location</h3>

    <script>
        //Javascript arrays for tickets number

        //Customer Array Index for ticket number javascript array
        const ticketIndexs = sessionStorage.getItem('ticketNumIndex');
        const CticketIndex = JSON.parse(ticketIndexs);
        console.log(CticketIndex);
        //Customer Ticket Number javascript array
        const ticketNumbers = sessionStorage.getItem('customerTicketNum');
        const CticketNum = JSON.parse(ticketNumbers);
        console.log(CticketNum);

        //Array for ticket cost (not customer from database stored in array for saveTickets.php)

        //Ticket Type from database
        const ticketList = sessionStorage.getItem('ticketNameData');
        const ticketTypeList = JSON.parse(ticketList);
        console.log(ticketTypeList);
        //Ticket Cost from database
        const ticketCostList = sessionStorage.getItem('costPerTicket');
        const ticketsCosts = JSON.parse(ticketCostList);
        console.log(ticketsCosts);
    </script>

    <form action="saveTickets.php" method="post">
        <?php
        if (isset($_POST['tickets'])) {
            $ticketType = $_POST['tickets'];



            foreach ($ticketType as $t) {
                //cho $t;
                //echo "<br>";
            }
        
        ?>
        <script>
            //Array For customers ticket type
            var TicketTypeArray = <?php echo json_encode($ticketType); ?>;

            //Seperate arrT for key and value
            let ticketName = Object.keys(TicketTypeArray);
            let ticketTypes = Object.values(TicketTypeArray);
            //Customer's Ticket Name
            const ticketsNames = JSON.stringify(ticketName);
            sessionStorage.setItem('ticketName', ticketsNames);


            const ticketsType = JSON.stringify(ticketTypes);
            sessionStorage.setItem('ticketTypes', ticketsType);

            //Customer Array For Ticket Number
            const ticketNumCustomer = sessionStorage.getItem('ticketName');
            const CticketNumber = JSON.parse(ticketNumCustomer);
            console.log(CticketNumber);

            //Customer Array For ticket Type
            const ticketTypeCustomer = sessionStorage.getItem('ticketTypes');
            const CticketType = JSON.parse(ticketTypeCustomer);
            console.log(CticketType);
        </script>
        <?php
        }
        //Getting Values from mySQL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_SESSION["theater"];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection Error");
        }

        //read in food and drink Items
        $sql = "SELECT foodItem,foodPrice FROM foodprices ORDER BY foodItem DESC";
        $result = $conn->query($sql);


        $food = array();
        //Adding cost field
        $cost = array();

        //testing combining food and cost array
        $foodPrice = array();
        $a = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                //echo $row['foodItem'];
                $food[$a] = $row['foodItem'];
                //echo $food[$a];
                //Adding cost field
                $cost[$a] = $row['foodPrice'];
                //echo $cost[$a];

                $a = $a + 1;
                //echo "<br>";
            }
        }
        $i = 0;
        while ($i != count($food)) {
            //echo $food[$i];
            $foodPrice[$food[$i]] = $cost[$i];
            //echo $foodPrice[$food[$i]];
            $i = $i + 1;
        }
        foreach ($foodPrice as $foodI => $priceI) {
            //echo $foodI;
        }
        while ($i != count($foodPrice)) {
            //echo "Yes<br>";
            //echo $foodPrice[$i];
            //$foodPrice[$food[$i]] = $cost[$i];
            $i = $i + 1;
        }
        //Loop-For customer selection of food and drink
        $a = 0;

        //Cost variable to increment
        $costVar = 0;
        ?></p>
        <h4>Drinks Menu:</h4>
        <p><?php
            foreach ($foodPrice as $f => $c) {

                //For drinks
                $drink = "Drink";

                //For popcorn
                $popcorn = "Popcorn";

                $stringPrint = $f;
                $splitCapital = preg_split('/(?=[A-Z])/', $stringPrint);
                $capital = implode(' ', $splitCapital);
                //echo "Select how may you want for ".$word.":";

                if (strpos($stringPrint, $drink) !== false) {

                    echo "<label for='$f'>How may <b>$f(s)</b>:<br></label>";
                    echo "<br>";
                    echo "<b>Cost:</b>$ {$c}";
                    echo "<br>";

                    echo "<select name='foodVal[$f]'>
              <option value='0'></option>
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
              <option value='7'>7</option>
              <option value='8'>8</option>
              <option value='9'>9</option>
              <option value='10'>10</option>
                            </select><br>";
                }
                $a = $a + 1;

                //test
                $costVar = $costVar + 1;
            }
            $costVar = 0;
            ?></p>
        <h4>Popcorn Menu:</h4>
        <p><?php
            foreach ($foodPrice as $f => $c) {

                //For drinks
                $drink = "Drink";

                //For popcorn
                $popcorn = "Popcorn";

                $stringPrint = $f;
                $splitCapital = preg_split('/(?=[A-Z])/', $stringPrint);
                $capital = implode(' ', $splitCapital);
                //echo "Select how may you want for ".$word.":";

                if (strpos($stringPrint, $popcorn) !== false) {
                    echo "<label for='$f'>How may <b>$f(s)</b>:<br></label>";
                    echo "<br>";
                    echo "<b>Cost:</b>$ {$c}";
                    echo "<br>";

                    echo "<select name='foodVal[$f]'>
              <option value='0'></option>
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              <option value='5'>5</option>
              <option value='6'>6</option>
              <option value='7'>7</option>
              <option value='8'>8</option>
              <option value='9'>9</option>
              <option value='10'>10</option>
                            </select><br>";
                    $a = $a + 1;
                }
                //test
                //$costVar = $costVar + 1;
            }

            ?></p>
        

        <?php
        //Getting Values from mySQL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_SESSION["theater"];;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection Error");
        }
        /*
        //read in food and drink Items
        $sql = "SELECT foodItem,foodPrice FROM foodprices";
        $result = $conn->query($sql);

        $a = 0;
        arrFood = [];
        arrPrices = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                //echo $row['foodItem'];
                $arrFood[$a] = $row['foodItem'];
                //echo $food[$a];
                //Adding cost field
                $arrPrices[$a] = $row['foodPrice'];
                //echo $cost[$a];

                $a = $a + 1;
                //echo "<br>";
            }
        }
        */

        ?>
        <script>
            /*
         //Array for Database item and price
         var foodPrice = <?php //echo json_encode($foodPrice); ?>;
        //Seperating to item and price
        let itemName = Object.keys(foodPrice);
        let value = Object.values(foodPrice);
        //Setting Database item name
        const itemNameFinal = JSON.stringify(itemName);
        sessionStorage.setItem('itemName', itemNameFinal);
        //Setting Database item cost
        const itemValues = JSON.stringify(value);
        sessionStorage.setItem('value', itemValues);
        */

            //Array for Database item and price
            var foodPrice = <?php echo json_encode($foodPrice); ?>;
            //Seperating to item and price
            let itemName = Object.keys(foodPrice);
            let value = Object.values(foodPrice);
            //Setting Database item name
            const itemNameFinal = JSON.stringify(itemName);
            sessionStorage.setItem('itemName', itemNameFinal);
            //Setting Database item cost
            const itemValues = JSON.stringify(value);
            sessionStorage.setItem('value', itemValues);
        </script>
        <input type="submit" onclick="save()" value="Submit">
    </form>
</body>

</html>