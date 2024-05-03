<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width,initial-scale=1">
    <title>Checkout Form</title>
    <link rel="stylesheet" href="concessions.css">
</head>

<body>
    <?php 
    require("../navbar.php"); 
    include "databaseConnect.php";
    ?>
    <h1>Concessions</h1>
    <h2>Food and Drink Options:</h2>
    <h3>For drink: It is self-service and provided on site at your theatre location</h3>

    <script>
        
        //Customer Array Index for ticket number javascript array
        const ticketIndexs = sessionStorage.getItem('ticketNumIndex');
        const CticketIndex = JSON.parse(ticketIndexs);
        console.log(CticketIndex);
        //Customer Ticket Number javascript array
        const ticketNumbers = sessionStorage.getItem('customerTicketNum');
        const CticketNum = JSON.parse(ticketNumbers);
        console.log(CticketNum);
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
            //Customer Ticket type
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

        //read in food and drink Items
        $sql = "SELECT foodItem,foodPrice FROM foodprices ORDER BY foodItem DESC";
        $result = $conn->query($sql);

        $food = array();
        $cost = array();
        $foodPrice = array();

        $a = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $food[$a] = $row['foodItem'];
                $cost[$a] = $row['foodPrice'];
                $a = $a + 1;

            }
        }
        $i = 0;
        while ($i != count($food)) {
            
            $foodPrice[$food[$i]] = $cost[$i];
            $i = $i + 1;
        }
        
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
            }
            ?>
            <h4>Other Items Menu:</h4>
            <p><?php
            
            foreach ($foodPrice as $f => $c) {

                //For drinks
                $drink = "Drink";
                //For popcorn
                $popcorn = "Popcorn";

                $stringPrint = $f;
                $splitCapital = preg_split('/(?=[A-Z])/', $stringPrint);
                $capital = implode(' ', $splitCapital);
                //echo $f;
                
                if (!(strpos($stringPrint, $popcorn) !== false) && !(strpos($stringPrint, $drink) !== false)) {
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
            }
            

            ?></p>
 
        <script>

            //Array for Database item and price
            var foodPrice = <?php echo json_encode($foodPrice); ?>;
            //Seperating to item and price
            let itemNameDatabase = Object.keys(foodPrice);
            let value = Object.values(foodPrice);
            //Setting Database item name
            const itemNameFinal = JSON.stringify(itemNameDatabase);
            sessionStorage.setItem('itemNameDatabase', itemNameFinal);
            //Setting Database item cost
            const itemValues = JSON.stringify(value);
            sessionStorage.setItem('value', itemValues);

        </script>
        <input type="submit" onclick="save()" value="Submit">
    </form>
</body>

</html>