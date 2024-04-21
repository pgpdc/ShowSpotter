
   

<DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="concessions.css">
        <style>
            table {
                    margin: 0 auto;
                    font-size: 20px;
                    border: 1px solid black;
        }
        h1{
                text-align:center;
                font-size: xx-large;
        }
        td{
    border:5px solid black;
    background-color: lightgrey;
    font-weight:lighter;
        }
th, td{
    text-align:center;
    padding: 10px;
    font-weight:bold;
        }
        </style>
</head>
<body>
<nav>
        <div class="brand">ShowSpotter</div>
        <div class="links">
            <a href="/ShowSpotter/">Home</a>
            <a href="concessions.php">Concessions</a>
            <a href="checkout.php">Checkout</a>
        </div>
</nav>
<form action="FinalPayment.php"method="post">
<?php
include_once('checkout.php');
require_once 'checkout.php';

$i = 0;

//Array for final cost
$ItemCostFinal = array();
$foodNameCon = array();
$foodValue = array();
//Loop through to get customer items and quantity
if (isset($_POST['foodVal'])){
    $foodValueFirst = $_POST['foodVal'];
    
    
    foreach($foodValueFirst as $f => $num){
        //echo $num;
        //echo "<br>";
        if($num != 0){
            array_push($foodNameCon,$f);
            //echo $f;
            //echo "<br>";
            //echo $num;
            array_push($foodValue,$num);
            array_push($ItemCostFinal,$num);
        }
        $i = $i + 1;
    }

    foreach($foodNameCon as $f => $num){
        //echo $f;
        //echo "<br>Name:";
        //echo $num;
        //echo "<br>";
    }

    foreach($foodValue as $f => $num){
        //echo $f;
        //echo "<br>Number";
        //echo $num;
        //echo "<br>";
    }
    }
$arrQuantity = array();
?>
    <section>
        <h1>Tickets:</h1>
    <?php
    //echo json_encode($foodValue);
    //echo json_encode($foodValue);
    //echo json_encode($enteredTickets);
    //echo json_encode($shownCost);
    //Ticket Cost
    //echo json_encode($costPerTicket);
    //Final Item Cost
    //echo json_encode($ItemCostFinal);
    ?>
    </table>
    <br>
    <label for="ItemO"></label>
    <label for="Num"></label>
    <p id="testArr"></p>
    <script type="text/javascript">

    //Need Array for Ticket(Type), TicketNum, TicketPrice
    //Customer Array Index for ticket number javascript array
    /*
    const ticketIndexs = sessionStorage.getItem('ticketNumIndex');
    const CticketIndex = JSON.parse(ticketIndexs);
    console.log(CticketIndex);
    */
    //Customer Ticket Number javascript array
    /*
    const ticketNumbers = sessionStorage.getItem('customerTicketNum');
    const CticketNum = JSON.parse(ticketNumbers);
    console.log("CticketNum"+CticketNum);
    */

   //Customer Array For Ticket Number
    const ticketNumCustomerY = sessionStorage.getItem('ticketName');
    const CticketNumber = JSON.parse(ticketNumCustomerY);
    console.log(CticketNumber);

    //Customer Array For ticket Type
    const ticketTypeCustomer = sessionStorage.getItem('ticketTypes');
    const CticketType = JSON.parse(ticketTypeCustomer);
    console.log(CticketType);

    










    //Database Ticket Arrays
    //Ticket Type from database
    //RIGHT HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    const ticketList = sessionStorage.getItem('ticketNameData');
    const ticketTypeList = JSON.parse(ticketList);
    console.log("DATA"+ticketTypeList);
    //Ticket Cost from database
    const ticketCostList = sessionStorage.getItem('costPerTicket');
    const ticketsCosts = JSON.parse(ticketCostList);
    //console.log(ticketsCosts);
    
    
    //Customer Arrays for Item,Item Quantity
    
    //Array converted from php to javascript for customers items quantity
    var arrFoodQuantity = <?php echo json_encode($foodValue); ?>;
    //Index for the quantity
    let itemIndexQ = Object.keys(arrFoodQuantity);
    //Quantity number for the item
    let itemQ = Object.values(arrFoodQuantity);
    console.log("YES THIS IS THE QUANTITY INDEX"+itemIndexQ);
    
    //Array converted from php to javascript for customers items name
    var arrFoodName = <?php echo json_encode($foodNameCon); ?>;
    //Index for the name for the customers item they picked
    let foodNameIndex = Object.keys(arrFoodName);
    //The food name for the customers item they picked
    let foodName = Object.values(arrFoodName);
    console.log("YES THIS IS FOOD NAME"+foodNameIndex);

    //Get price for the food
    
    
    
    
    
    
    
    

    
    //Database Array for Item Name and Price
    //Database Item Name Array
    
    const itemNames = sessionStorage.getItem('itemName');
    const finalItemNames = JSON.parse(itemNames);
    //console.log("Database Names"+finalItemNames);
    
    //Database Item Cost
    const itemsValue = sessionStorage.getItem('value');
    const finalItemValue = JSON.parse(itemsValue);
    //finalItemValue.reverse();
    console.log("DATABASE COST"+finalItemValue);

    
    //Length of Databse 
   /* for (var i=0; i < finalItemNames.length; i++){
        //console.log("D"+ arrFoodName[i]);
        //console.log("C"+ finalItemNames[i]);
        //const findPrice = finalItemNames.filter(finalItemNames[i] == arrFoodName.includes(finalItemNames[i]));
        //Trying to get values from database
        if (finalItemNames[i] == arrFoodName[i]){
            //console.log("FINDING PRICE:"+finalItemNames[i]);
        }
    }*/
    //ADDING COUNT FIRST IN ORDER TO REMOVE ELEMENTS 
    //const varCOUNTNAME = finalItemNames.length;
    //console.log("FOUND:"+findPrice);
    var a = 0;
    var count = 0;
    const  arrIndex = 0;
    const arrNames = [];
    const costOfItem = [];
    var namesArray = arrNames.concat(finalItemNames);
    for(var i=0; i < namesArray.length;i++){
        var count=0;
        console.log("COUNTING HOW MUCH FOR LOOPS"+ i);
        console.log("COUNTING D Name"+ finalItemNames[i]);
        console.log("COUNTING C Name"+ arrFoodName[i]);
        const findV = arrFoodName.includes(finalItemNames[i]);
        console.log(findV);
        if (findV == true){
            console.log("COST IS:"+finalItemValue[i]);
            costOfItem.push(finalItemValue[i]);
        }
        /*if (findV == false){
            var indexOfV = finalItemNames.indexOf(finalItemNames[i]);
            console.log("FALSE I"+indexOfV);
            console.log("FALSE A"+finalItemNames);
            console.log("FALSE IA"+finalItemNames[i]);
            //const a = removeItem(finalItemValue[i],finalItemValue);
            //finalItemValue.pop();
            //finalItemNames.pop();
            //finalItemValue.splice(indexOfV,1);
            //finalItemNames.splice(indexOfV,1);
            console.log("ARRAYAFTERREMOVAL"+finalItemValue);
            //const findV = arrFoodName.includes(finalItemNames[i])
        }*/
        console.log(finalItemValue);
        //const findC = arrFoodName[i].includes(finalItemNames);
        //console.log(findC);
        //console.log("D"+ arrFoodName[i]);
        //console.log("C"+ finalItemNames[i]);
        //for (var a=0; a < arrFoodName.length; a++){
        //while(finalItemNames[i] != lengthA){
        //console.log("FINDING PRICE:"+arrFoodName[i]);
       /* if (arrFoodName[a] == arrFoodName[i]){
            console.log("FOUND IT FINALLY"+ arrFoodName[i]);
            //console.log("INDEX OF NAME"+indexName);
            var IndexForName = finalItemNames.findexIndex(arrFoodName[i]);

            }
        while (arrFoodName[a] !=  finalItemNames[count]){
            
            if (a > arrFoodName.length){
                    //a = 0;
            }
            if(count > finalItemNames.length){
                    i=0;
            }
        //console.log("WHILE LOOP D:"+finalItemNames[count])
        //console.log("WHILE LOOP C:"+arrFoodName[a])
        count = count+1;
        }
        a= a+1;
        
        if (arrFoodName[a] == arrFoodName[i]){
            console.log("FOUND IT FINALLY"+ arrFoodNames[i]);
            }
            count=0;*/
        }

    
    
    //Array for reading in final cost
    const finalItemCosts = <?php echo json_encode($ItemCostFinal); ?>;

    

    //console.log("Original"+itemNameCustomer+"<br>");
    //console.log("Original"+valueCustomer+"<br>");
    var finalCost = 0;
    var finalTicket = 0;

    //var arrayForItemsQuantities = [];

    //const ticketsQuantity = JSON.stringify(arrayForItemsQuantities);
    //const q = sessionStorage.setItem('arrayForItemsQuantities',ticketsQuantity);
    //console.log("PPPPPPPPPP"+q);

    //var arrQ = <?php //echo json_encode($arrQuantity); ?>;
    //Seperated Name and Item Quantity
    //let itemQ = Object.keys(arrQ);
    //let valueQ = Object.values(arrQ);

    //const ticketsQuantity = JSON.stringify(itemQ);
    //const arrayForItemsQuantities= sessionStorage.setItem('qP',ticketsQuantity);
    //console.log("PPPPPPPPPP"+arrayForItemsQuantities);

    //const quantityItem = sessionStorage.setItem('arrayForItemsQuantities');
    //const arrayQ = JSON.parse(quantityItem);
    //console.log("QUANTITY FOR THIS ARRAY IS "+arrayQ);
    var arrayForItemsQuantities= [];
    
    var arrayForItemNames = [];
    //var costOfItem = [];
    //Calculate Price for Items
    /*for(var i = 0; i < valueCustomer.length;i++){
        
        if(valueCustomer[i] != 0){
        console.log("Quantity !!!!"+valueCustomer[i]);
            var countType =0;
            let lengthFoodItems = finalItemNames.length;
            console.log("Length"+lengthFoodItems);
            let measure = -1;
            while(measure != lengthFoodItems){
                //Increment Meaure to get index for database food items
                measure = measure + 1;
                    console.log("countType"+valueCustomer[measure])
                    if (itemNameCustomer[i] == finalItemNames[measure]){
                        console.log(valueCustomer[i] + "value LOOP QUantity");
                        console.log(itemNameCustomer[i] + "value LOOP Customer");
                        console.log(finalItemValue[measure] + "value LOOP Value");
                        costOfItem.push(finalItemValue[measure]);
                        arrayForItemNames.push(itemNameCustomer[i]);
                        arrayForItemsQuantities.push(valueCustomer[i]);
                        //arrayForItemsQuantities[i]= itemNameCustomer[i];
                        }
                     
            }
                        
                    }
    }*/
    
    //testing new value for total price
    var totalVal = 0;
    //Defining Item cost
    
    
    //Array for ticket cost
    var finalTicket = [];

    //Costs For the tickets
    var ticketCostArray = [];
    //New Calulating Price

    var sum = 0;
    /*for(var i = 0; i < ticketCost.length;i++){
          finalCost += Number(ticketCost[i]);
    }*/
    
    for(var i = 0; i < itemQ.length;i++){
                    
                }
    function displayChart(){

    
            var finalItemCost = 0;
            var html = "<table border='1|1' class='table'>";
            setTimeout(() => {
                html += "<thread>";
                html +="<tr>";
                html += "<td>"+"Quantity/Ticket Type"+"</td>";
                html += "<td>"+"Item/Seat Number"+"</td>";
                html += "<td>"+"Delete Row"+"</td>";
                html += "<td>"+"Minus"+"</td>";
                html += "<td>"+"Add"+"</td>";
                //Add cost
                html += "<td>"+"Cost Per Item"+"</td>";
                html += "<td>"+"Final Item Cost"+"</td>";

                
                html += "</tr>";
                
                html += "</thread>";
                var inc = 0;
                //Tickets
                var costs=0;
                
                //var TotalTicket = 0;
                let nullTicket = null;
                console.log(ticketsCosts);
                if(CticketType != nullTicket){
                for(var i = 0; i < CticketType.length;i++){
                    html +="<tr>";
                    html += "<td>"+ CticketType[i] +"</td>";
                    html += "<td>"+ CticketNumber[i] +"</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteTicket(${i})'>Delete</button>` + "</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                    //cost
                    var countType = 0;
                    while(countType != 3){
                        console.log("countType"+ticketTypeList[countType])
                        if(CticketType[i] == ticketTypeList[countType]){
                                html += "<td>"+ ticketsCosts[countType] +"</td>";
                                ticketCostArray.push(ticketsCosts[countType]);
                                console.log("ArrayPush"+ticketCostArray);
                                //Calulate final cost
                                //TotalTicket = TotalTicket + Number(ticketsCosts[i]);
                                finalItemCost = finalItemCost + Number(ticketsCosts[countType]);
                        }
                        countType = countType+1;
                    }
                    

                    //html += TotalTicket;
                    html += "<td>"+ " " +"</td>";
                    html += "</tr>";
                    inc = inc + 1; 
                    console.log("ArrayPushYes"+ticketCostArray);     
            }
        }

                
                //Concessions
                for(var i = 0; i <itemQ.length;i++){
                            console.log(i + "YES THIS IS CURRENT VALUE:"+itemQ[i] + "<br>");
                            console.log(itemQ);
                            console.log(foodName);
                            html +="<tr>";
                            html += "<td>"+ itemQ[i] +"</td>";
                            html += "<td>"+ foodName[i] +"</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteButton(${i})'>Delete</button>` + "</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='minusButton(${i})'>-</button>` + "</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='addButton(${i})'>+</button>` + "</td>";
                    //Cost
                            html += "<td>"+ costOfItem[i] +"</td>";
                            totalVal= itemQ[i]*costOfItem[i];
                            html += "<td>"+ totalVal+"</td>";
                            finalItemCost = finalItemCost + totalVal;
                            //finalTicket.push(finalItemCost);
                            html += "</tr>";
                    
                    
                    //totalPrice = totalPrice + finalItemValue[i];

                

                /*for(var i = 0; i <arrayForItemNames.length;i++){
                            console.log(i + "YES THIS IS CURRENT VALUE:"+valueCustomer[i] + "<br>");
                            console.log(arrayForItemsQuantities);
                            console.log(arrayForItemNames[i]);
                            html +="<tr>";
                            html += "<td>"+ arrayForItemsQuantities[i] +"</td>";
                            html += "<td>"+ arrayForItemNames[i] +"</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteButton(${i})'>Delete</button>` + "</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='minusButton(${i})'>-</button>` + "</td>";
                            html += "<td>" + `<button type="button" class="btn btn-danger" onclick='addButton(${i})'>+</button>` + "</td>";
                    //Cost
                            html += "<td>"+ costOfItem[i] +"</td>";
                            totalVal= arrayForItemsQuantities[i]*costOfItem[i];
                            html += "<td>"+ totalVal+"</td>";
                            finalItemCost = finalItemCost + totalVal;
                            //finalTicket.push(finalItemCost);
                            html += "</tr>";*/
                    
                    
                    //totalPrice = totalPrice + finalItemValue[i];
                    inc = inc + 1;
                    costs = costs+1;
                    
                    
                }
                
        html += "</table>";
        html += "<table>";
        html +="<tr>";
                html += "<td width=845px>"+"Final Price: $"+ finalItemCost +"</td>";
        html +="</tr>";
        
        html += "</table>";
        //Set finalItemCost to zero so when added
        //const finalItemCost = 0;
        document.getElementById("testArr").innerHTML = html},200);
            }
            console.log("ArrayPushYesMoreMore"+ticketCostArray);  
        displayChart();

    //BUTTON FUNCTIONS  
    function deleteButton(i) {
        //Minus for FinalCost for the item
        //Removing finalCost value
        const final= Number(finalCost) - Number(costOfItem[i]);
        finalCost = final;

        alert(i);
        itemQ.splice(i,1);
        foodName.splice(i,1);
        costOfItem.splice(i,1);
        console.log(itemQ);
        console.log(foodName);
        //sessionStorage.removeItem("ticketName")
        displayChart();
        
    }

    

    function minusButton(i) {
        if (itemQ[i] == 1){
            displayChart();
        }else{
        //Set finalItemCost to zero
        
        var finalItemCost = 0;
        console.log("MINUS BUTTON" + finalItemCost);
        //Removing final cost for item
        const final = Number(finalCost) - Number(totalVal);
        finalCost = final;
        //Add to cost count for item
        const sum = Number(costOfItem[i])-Number(finalItemValue[i]);
        //finalItemCosts[i] = sum;
        
        itemQ[i] = itemQ[i]-1;
        displayChart();
        
    }
    }

    function addButton(i) {
        if (itemQ[i] == 10){
        displayChart();
    }else{
        //Removing finalCost value
        const final= Number(finalCost) - Number(costOfItem[i]);
        finalCost = final;
        console.log(finalCost);
        var addOne =1;
        console.log("addButton"+addOne);
        //Add to cost count for item
        const sum = Number(finalItemValue[i])+Number(costOfItem[i]);
        //finalItemCost[i] = sum;
        console.log("SUM"+sum);
        //Updating finalCost
        const added= Number(finalCost) + Number(sum);
        finalCost= added;
        itemQ[i] = ++itemQ[i];
        //Updating array value for next page
        displayChart();}
    }
        function deleteTicket(i) {
        //Minus for FinalCost for the ticket
        //Removing finalCost value
        const final = Number(finalTicket[i]) - Number(ticketsCosts[i]);
        finalCost = final;
        
         
        alert(i);
        //ticketsCosts.splice(i,1);
        CticketType.splice(i,1);
        CticketNumber.splice(i,1);
        console.log(CticketType);
        console.log(CticketNumber);
        sessionStorage.removeItem(CticketNumber);
        sessionStorage.removeItem(CticketType);
        //sessionStorage.removeItem("CticketNum");
        //sessionStorage.removeItem("CticketType");


        //Updates the session storage

        //Removes type
        delete CticketType["remove"];
        sessionStorage.setItem('ticketTypes', JSON.stringify(CticketType));


        //Removes Number
        delete CticketNumber["removeYes"];
        sessionStorage.setItem('ticketName', JSON.stringify(CticketNumber));

        //Removes Cost
        //delete ticketsCosts["removeYes"];
        //sessionStorage.setItem('costPerTicket', JSON.stringify(ticketCosts));

        displayChart();
        //Deleting from session array
        
        //console.log("YES" + finalTickets);
    }
    //console.log("ARRAY ITEM"+itemName);

    console.log("A"+ticketCostArray);
    </script>
    
<script>

/*
function saveThis(){
//Customer Ticket Number, Type, Cost From Database
//Ticket Number
const ticketNumCustomerYes = sessionStorage.setItem('ticketName');
const ticketNumberFinal = JSON.parse(ticketNumCustomerYes);
console.log(ticketNumberFinal);

//Customer Array For ticket Type
const ticketTypeCustomerYes = sessionStorage.setItem('ticketTypes');
const CticketType = JSON.parse(ticketTypeCustomerYes);
console.log(CticketType);

//Ticket Cost
//Ticket Cost
const ticketCost = sessionStorage.setItem('costPerTicket');
const ticketsPerP = JSON.parse(ticketCost);
console.log("TICKET PIRCE FOR "+ticketsPerP);


//Customer Item's Quantity, Name, Cost
//Customer's Item Quantity
const ticketsQuantity = JSON.stringify(arrayForItemsQuantities);
sessionStorage.setItem('arrayForItemsQuantities',ticketsQuantity);

//Customer's Item Quantity
const quantityItem = sessionStorage.setItem('arrayForItemsQuantities');
const itemQuantitys = JSON.parse(quantityItem);
console.log(itemQuantitys);

//Tickets Name
const ticketsName = JSON.stringify(arrayForItemNames);  //Need For Diagram
sessionStorage.setItem('arrayForItemNames',ticketsName);

const nameItem = sessionStorage.setItem('arrayForItemNames');
const ItemNames = JSON.parse(nameItem);
console.log(ItemNames);

//DEFINING-Customer's Items Cost
const costForItem = JSON.stringify(costOfItem);
sessionStorage.setItem('costOfItem',costForItem);

//Cost per Item
const itemsValue = sessionStorage.setItem('costOfItem');
const finalItemValue = JSON.parse(itemsValue);


    
}
*/
const itemAmount = JSON.stringify(itemQ);
        sessionStorage.setItem('itemQ',itemAmount);


        //Item Quantity, Item, and Item Cost going to FinalPayment.php
        //Item Amount
        const itemNumber = sessionStorage.getItem('itemQ');
        const finalItemQuantity = JSON.parse(itemNumber);
        console.log("FINAL ITEM QUANTITY"+finalItemQuantity);

//Item Names
const itemNameFinalPay = JSON.stringify(foodName);
sessionStorage.setItem('foodName',itemNameFinalPay);


    //Item Quantity, Item, and Item Cost going to FinalPayment.php
        //Item Name
        const itemNamed = sessionStorage.getItem('foodName');
        const customerFinalCostOrder = JSON.parse(itemNamed);
        console.log("FINAL CUSTOMER NAME"+customerFinalCostOrder);

//Item's Customer Cost
const finalPayment = JSON.stringify(costOfItem);
sessionStorage.setItem('costOfItem',finalPayment);


    //Item Quantity, Item, and Item Cost going to FinalPayment.php
        //Item Name
        const itemCosts = sessionStorage.getItem('costOfItem');
        const customerFinalCosts = JSON.parse(itemCosts);
        console.log("FINAL CUSTOMER Costs"+ customerFinalCosts);

        //Cutomer Number
        const numberOFCustomerTicket = JSON.stringify(foodName);
        sessionStorage.setItem('foodName',numberOFCustomerTicket);

        const ticketOrderNumber = sessionStorage.getItem('ticketName');
        const CticketForThisOrder = JSON.parse(ticketOrderNumber);
        console.log("NUMBER"+CticketForThisOrder);

function save(){

/*//ticket seat number
const ticketsNum = JSON.stringify(ticketName);
sessionStorage.setItem('ticketName',ticketsNum);
//ticket type
const ticketsType = JSON.stringify(valueT);
sessionStorage.setItem('valueT',ticketsType);
//ticket cost
const ticketsItemCost = JSON.stringify(ticketCost);
sessionStorage.setItem('ticketCost',ticketsItemCost);


//Ticket name and price going to FinalPayment.php
const ticketList = sessionStorage.getItem('ticketName');
const finalTickets = JSON.parse(ticketList);
console.log(finalTickets);

const ticketCostList = sessionStorage.getItem('valueT');
const finalTicketType = JSON.parse(ticketCostList);
console.log(finalTicketType);

const ticketFinalCost = sessionStorage.getItem('ticketCost');
const finalTicketPrice = JSON.parse(ticketFinalCost);
console.log(finalTicketPrice);
*/
        //Quantity of Items
        const itemAmount = JSON.stringify(itemQ);
        sessionStorage.setItem('itemQ',itemAmount);


        //Item Quantity, Item, and Item Cost going to FinalPayment.php
        //Item Amount
        const itemNumber = sessionStorage.getItem('itemQ');
        const finalItemQuantity = JSON.parse(itemNumber);
        console.log(finalItemQuantity);
        
        //Item Names
        const itemNameFinalPay = JSON.stringify(foodName);
        sessionStorage.setItem('foodName',itemNameFinalPay);


        //Item Quantity, Item, and Item Cost going to FinalPayment.php
        //Item Name
        const itemNamed = sessionStorage.getItem('foodName');
        const finalItemNames = JSON.parse(itemNamed);
        console.log(finalItemNames);
        
        


}
</script>
</section>
<input type="submit" onclick="save()" value="Submit">
</form>
</body>
</html>