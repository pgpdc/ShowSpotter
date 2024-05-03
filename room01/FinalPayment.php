<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
        <link rel="stylesheet" href="FinalPayment.css">

        <?php
       
        include "databaseConnect.php";

        //read in food and drink Items
        $sql = "SELECT * FROM foodprices ORDER BY foodItem DESC";
        $result = $conn->query($sql);

$arrFoodName = array();
$arrFoodPrice = array();
$i =0;
while(mysqli_num_rows($result)>$i){
    if($row = mysqli_fetch_assoc($result)){

           array_push($arrFoodName,$row["foodItem"]);
           array_push($arrFoodPrice,$row["foodPrice"]);
           $i = $i +1;

    }

}

        //Read in how many points a user has
        $pointsql = "SELECT userid, notusedPoints,pointsNum FROM points WHERE userid='$user'";
        $queryPointsResult = mysqli_query($conn, $pointsql);

if(mysqli_num_rows($queryPointsResult)>0){
    if($row = mysqli_fetch_assoc($queryPointsResult)){

            $money=$row["notusedPoints"];
            $points = $row["pointsNum"];

            $conn->close();}}

        ?>
        <script>

        const itemNames = sessionStorage.getItem('itemNameDatabase');
        const finalItemNames = JSON.parse(itemNames);
        console.log("Database Names" + finalItemNames);
        //Array for Database item and price
        var money = <?php echo json_encode($money); ?>;
        console.log("Current moeny amount"+money);
        var points = <?php echo json_encode($points); ?>;
        console.log("Current moeny points"+points);
            
        </script>
</head>
<body>
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
        <h3>For Points: If your points on account hub is activated then, you can add points to get a discount</h3>
        <h3>3 Points = $10.00 disocunt</h3>
        <h3>Spending $30.00 = 1 point</h3>

        <div id="testArray"></div>

        <script type="text/javascript">
        //Customers Item Name
        const nameItem = sessionStorage.getItem('foodName');
        const ItemNames = JSON.parse(nameItem);

        //Database food price
        var foodPrice = <?php echo json_encode($arrFoodName); ?>;
        //Seperating to item and price
        let itemName = Object.keys(foodPrice);
        let value = Object.values(foodPrice);
        //Setting Database item name
        const itemNameFinal = JSON.stringify(itemName);
        sessionStorage.setItem('itemName', itemNameFinal);
        //Setting Database item cost
        const itemValues = JSON.stringify(value);
        sessionStorage.setItem('value', itemValues);
        //Database food price
        var valPrice = <?php echo json_encode($arrFoodPrice); ?>;
        //Seperating to item and price
        let itemPrice = Object.keys(valPrice);
        let valuePrice = Object.values(valPrice);
        //Setting Database item name
        const itemPriceFinal = JSON.stringify(itemPrice);
        sessionStorage.setItem('itemName', itemPriceFinal);
        //Setting Database item cost
        const itemValuesPrice = JSON.stringify(valuePrice);
        sessionStorage.setItem('value', itemValuesPrice);

        const finalItemValue = [];
        //DatabASE Count
        let lengthDatavalue = value.length;
        //Cusotmer Count
        let multiplyDataCustomer = ItemNames.length;
        console.log("LENGTH:"+multiplyDataCustomer+" Database "+lengthDatavalue);
        let looping = multiplyDataCustomer*lengthDatavalue;
        let loopingGo = multiplyDataCustomer*lengthDatavalue;
        var a = 0;
        var i=0;
        for(var loop = 0; loop <= looping;loop++){
               if(value[i] == ItemNames[a]){
                   finalItemValue.push(valuePrice[i]);
               }
               i = i + 1;
               if(i == lengthDatavalue){
                  a = a + 1;
                  i = 0;
               }
        }
        
        //Customer Array For Ticket Number
        const ticketNumCustomerYes = sessionStorage.getItem('ticketName');
        const CticketNumber = JSON.parse(ticketNumCustomerYes);
        console.log(CticketNumber);
        //Customer Array For ticket Type
        const ticketTypeCustomerYes = sessionStorage.getItem('ticketTypes');
        const CticketType = JSON.parse(ticketTypeCustomerYes);
        console.log(CticketType);
        const ticketCostArrays = sessionStorage.getItem('costPerTicket');
        const ticketsCosts = JSON.parse(ticketCostArrays);
        console.log(ticketsCosts);
        //Customer's Ticket Quantity
        const quantityItem = sessionStorage.getItem('itemQ');
        const itemQuantitys = JSON.parse(quantityItem);
        console.log(itemQuantitys);
        //Ticket Type from database
        const ticketList = sessionStorage.getItem('ticketNameData');
        const ticketTypeList = JSON.parse(ticketList);
        console.log("DATA"+ticketTypeList);

        var ticketCostArray = [];
        var FinalTicketCost =[];
        var final = [];
        //Setting Database item name
  
        //Check if array is null 
        let nullTicket=null;
        if(CticketType != nullTicket){
            
        for(var i = 0; i < CticketType.length;i++){
        var countType = 0;
        while(countType != 3){
            
            if(CticketType[i] == ticketTypeList[countType]){

                ticketCostArray.push(ticketsCosts[countType]);
                
                    }
        countType = countType + 1;
                }
            }
        }
        
        var Final = 0;
        var finalTicket = 0;
        var finalCost = 0; 
        function displayChart(){
            var html = "<table backgroundColor='white' border='1|1' class='table'>";
            setTimeout(() => {
                html += "<thread>";
                html +="<tr>";
                html += "<td>"+"Quantity/Ticket Type"+"</td>";
                html += "<td>"+"Item/Seat Number"+"</td>";
                html += "<td>"+"Cost"+"</td>";
                html += "</tr>";
                
                html += "</thread>";
                var inc = 0;
                //Tickets
                var costs=0;
                
                console.log("ticketCostArray"+ticketCostArray);
                if(CticketType != nullTicket){
                for(var i = 0; i < CticketType.length;i++){
                    console.log(CticketType[i]);
                    if (CticketType[i] != 0){
                    html +="<tr>";
                    html += "<td>"+ CticketType[i] +"</td>";
                    html += "<td>"+ CticketNumber[i] +"</td>";
                    html += "<td>"+ "$"+Number(ticketCostArray[i]).toFixed(2) +"</td>";
                    //Store in final cost
                    finalTicket = Number(finalTicket) + Number(ticketCostArray[i]);
                    finalCost = Number(finalCost) + Number(ticketCostArray[i]);
                    html += "</tr>";
                    inc = inc + 1; 
                    }
                    
                    
            }
        }

            for(var i = 0; i < itemQuantitys.length;i++){
                    console.log(itemQuantitys[i]);
                    if (itemQuantitys[i] != 0){
                    html +="<tr>";
                    html += "<td>"+ itemQuantitys[i] +"</td>";
                    html += "<td>"+ ItemNames[i] +"</td>";
                    var itemCalc = itemQuantitys[i]*finalItemValue[i];
                    html += "<td>"+ "$"+ itemCalc.toFixed(2) +"</td>";
                    //Store in final cost
                    finalCost = Number(finalCost) + Number(itemCalc);
                    html += "</tr>";

                    inc = inc + 1; 
                    }
                
                    
            } 
            html += "</table>";
        html += "<table>";
        html +="<tr>";
                final.push(finalCost);
                
        html +="</tr>";
        html += "</table>"
        document.getElementById("testArray").innerHTML = html},200);
            }
        
        displayChart();
        var finalC = 0;

        if(CticketType != nullTicket){
        for (var i = 0; i < CticketType.length;i++){
            
            finalTicket = Number(finalTicket) + Number(ticketCostArray[i]);
            finalC = Number(finalC) + Number(ticketCostArray[i]);

        }
    }
        for(var i = 0; i < itemQuantitys.length;i++){
                    if (itemQuantitys[i] != 0){
                    
                    var itemCalc = itemQuantitys[i]*finalItemValue[i];
                    finalC = Number(finalC) + Number(itemCalc);

                    }
                
                    
            } 

        </script>
        <p id="discount"></p>
        <p id="total"></p>

        <button onclick="addPoints()">Add Points</button>

        <p id="nodiscount"></p>
        <p id="points"></p>
        <p id="pointsLeft"></p>

        <script>
        var discountFinal = 0;
        var points = <?php echo json_encode($points); ?>;

        discount();
        total();

        function discount(){
        document.getElementById("discount").innerHTML = "<b>Discount:</b> $"+discountFinal.toFixed(2);
        }

        function discountA(){
        document.getElementById("discount").innerHTML = "<b>Discount:</b> $"+discountFinal.toFixed(2);
        }

        function total(){
        document.getElementById("total").innerHTML = "<b>Total Cost:</b> $"+finalC.toFixed(2);
        }

        var i = 0;
        function addPoints(){
            if (Number(finalC) >= 20){
            if (points >= 3){
                var pointsused = 0;
                //var discount = 0;
                console.log("POINTS:"+points);
                i = i + 1;
                pointsused = 3*i;
                points = points - 3;
                discountFinal = 10 * i;
                console.log("Discount Used:"+discountFinal);
                console.log("Amount of points used:"+i);
                finalC = finalC - 10;
                console.log("FINAL COST :"+finalC);
                document.getElementById("points").innerHTML="<b>Points used:</b> "+ pointsused;
                document.getElementById("pointsLeft").innerHTML="<b>Points Left:</b> "+ points;
                discountA();
                total();
            }else{
                console.log("No points to use");
            }
            var FinalCOSTS = finalC;
        }else{
            document.getElementById("nodiscount").innerHTML = "No discount for orders under $20.00"; 
        }
            console.log("Points After Loop:"+points);
            console.log("Money in points for customer:"+money);
                
        }

        </script>
        <h3>Billing Info:</h3>
                <form action="savedOrder.php" method="post">
                <script>
                
                function save(){
                var jsNames = ItemNames;
                var jsNamesJSON = JSON.stringify(jsNames);

                document.cookie = ItemNames;
                console.log("COOKIE"+document.cookie);

                //To seperate cookies
                var ticketNumberC  = "Ticket Number:";
                var tickettypeC  = "Ticket Type:";
                var ticketCostC = "Ticket Final Costs:";

                var finalAmount = "Order Final Cost:";
                var ItemQuantityC  = "Item's Quantity:";
                var ItemNameC  = "Item's Name:";
                var ItemValueA = "Item's Value:";
        
                var pointsC = "Points Left:";
                var discountC = "Discount:";
                var finalCostC = "FinalCost:";
                var endPayment = "ENDPAY";
            
                document.cookie = pointsC + points + discountC + discountFinal + finalCostC + finalC + endPayment +ticketNumberC+CticketNumber+tickettypeC+CticketType+ticketCostC+ticketCostArray+ItemQuantityC+itemQuantitys+ItemNameC+ ItemNames +ItemValueA+ finalItemValue;
                console.log("COOKIE"+document.cookie);
                }
                
                </script>
                <?php
                
                require_once('seatreservelib.php');
                
                //SET UP CONNECTION FOR DATABASE
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = $_SESSION["theater"];;
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn-> connect_error){
                    die("Connection Error");
                }
                
                //read in food and drink Items
                $sql = "SELECT * FROM paymentinfo WHERE username='$user'";
                $result = $conn->query($sql);
                if($result){
                    if(mysqli_num_rows($result)>0){
                        echo "<b>Payment Found With This Account</b>"."<br>";
                        if ($result -> num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $lastFourChar = substr($row["creditNum"],-4);
                                $hidden = "XXXXXXXXXXXX";
                                $hiddenNum = $hidden.$lastFourChar;
                                $_SESSION['cardNumber'] = $row["creditNum"];
                                echo "<b>Card Name:</b>".$row["cardName"]."<br>";
                                echo "<b>Credit Card Number:</b>".$hiddenNum."<br>";
                                $_SESSION['cardNumberHidden'] = $hiddenNum;
                                echo "<b>Credit Card Expiration:</b>".$row["expDate"]."<br>";
                            }
                        }
                    }else{
                        echo "No Recorded Payment On File"."<br>";
                        echo "Please Enter Payment Below"."<br>";
                        recordPayment();
                    }
                }

                function recordPayment(){
                    ?>
                    <a href="/ShowSpotter/customerInfo.php">Account Details<a>
                    <?php
                }
                ?>
                <input type="submit" onclick="save()" value="Submit">
        </body>
        </html>


