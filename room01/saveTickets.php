<?php session_start() ?>

<!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="concessions.css">
        <style>
            table {
                width: 60%;
                margin: 0 auto;
                font-size: 20px;
                border: 1px solid black;
            }
            td {
                border: 5px solid black;
                background-color: lightgrey;
                font-weight: lighter;
            }

            th,
            td {
                text-align: center;
                padding: 10px;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <?php 
        require("../navbar.php"); 
        ?>
        
        <form action="FinalPayment.php" method="post">
        <?php
            $i = 0;
            //Array for final cost
            $ItemCostFinal = array();
            $foodNameCon = array();
            $foodValue = array();
            //Loop through to get customer items and quantity
            if (isset($_POST['foodVal'])) {
                $foodValueFirst = $_POST['foodVal'];
                foreach ($foodValueFirst as $f => $num) {
                    if ($num != 0) {
                        array_push($foodNameCon, $f);
                        array_push($foodValue, $num);
                        array_push($ItemCostFinal, $num);
                    }
                    $i = $i + 1;
                }

            }
            $arrQuantity = array();
            ?>
            <section>
                <h1>Edit Cart</h1>
                <p id="Empty"></p>
                <br>
                <label for="ItemO"></label>
                <label for="Num"></label>
                <p id="testArr"></p>

                <script type="text/javascript">
                    
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
                    const ticketList = sessionStorage.getItem('ticketNameData');
                    const ticketTypeList = JSON.parse(ticketList);
                    console.log("DATA" + ticketTypeList);
                    //Ticket Cost from database
                    const ticketCostList = sessionStorage.getItem('costPerTicket');
                    const ticketsCosts = JSON.parse(ticketCostList);

                    //Array converted from php to javascript for customers items quantity
                    var arrFoodQuantity = <?php echo json_encode($foodValue); ?>;
                    //Index for the quantity
                    let itemIndexQ = Object.keys(arrFoodQuantity);
                    //Quantity number for the item
                    let itemQ = Object.values(arrFoodQuantity);
                    //Array converted from php to javascript for customers items name
                    var arrFoodName = <?php echo json_encode($foodNameCon); ?>;
                    //Index for the name for the customers item they picked
                    let foodNameIndex = Object.keys(arrFoodName);
                    //The food name for the customers item they picked
                    let foodName = Object.values(arrFoodName);

                    //Database Array for Item Name and Price
                    //Database Item Name Array
                    const itemNames = sessionStorage.getItem('itemNameDatabase');
                    const databaseFoodNames = JSON.parse(itemNames);
                    console.log("Database Names" + databaseFoodNames);
                    //Database Item Cost
                    const itemsValue = sessionStorage.getItem('value');
                    const finalItemValue = JSON.parse(itemsValue);
                    //finalItemValue.reverse();
                    console.log("DATABASE COST" + finalItemValue);


                    //Check and reads file as empty if no items
                    function readEmpty(){
                        
                        document.getElementById("Empty").innerHTML = "Empty Cart";
                        document.getElementById("Empty").style.textAlign="center";
                        document.getElementById("Empty").style.fontSize="Large";
                        window.stop();

                    }
                    checkEmpty();
                    function checkEmpty(){
                    var numTicketCheck = 1;
                    console.log("Reading to set as null food"+foodName);
                    console.log("Reading to set as null ticket"+CticketType);
                    var numFoodCheck = foodName.length;
                    if(CticketNumber != null){
                    var numTicketCheck = CticketType.length;
                    }
                    console.log("Reading to set as null check"+numFoodCheck);
                    if((numFoodCheck == 0)&&((CticketNumber==null)||(numTicketCheck == 0))){
                        readEmpty();
                        document.getElementById("submit").style.display = "none";

                    
                   
                    }
                }

                    





                    var a = 0;
                    var count = 0;
                    const arrIndex = 0;

                    const arrNames = [];
                    const costOfItem = [];
                    customerFinalARRAYS = [];
                    customerIndividual = [];

                    for (var i = 0; i < itemQ.length; i++) {

                        console.log(i + "YES THIS IS CURRENT VALUE:" + itemQ[i] + "<br>");
                        console.log(itemQ);
                        customerIndividual.push(itemQ);
                        customerFinalARRAYS.push(foodName[i]);

                    }

                    //Calculate Costs
                    const finalItemsArray = [];
                    //Database Count
                    let lengthDatavalue = databaseFoodNames.length;
                    //Cusotmer Count
                    let multiplyDataCustomer = customerFinalARRAYS.length;
                    console.log("LENGTH:" + multiplyDataCustomer + " Database " + lengthDatavalue);
                    let looping = multiplyDataCustomer * lengthDatavalue;
                    let loopingGo = multiplyDataCustomer * lengthDatavalue;
                    var a = 0;
                    var i = 0;
                    
                    for (var loop = 0; loop <= looping; loop++) {
                        if (databaseFoodNames[i] == customerFinalARRAYS[a]) {
                            console.log("IF LOOP DATABASE name val" + finalItemValue[i]);
                            console.log("IF LOOP CUSTOMER name val" + customerFinalARRAYS[a]);
                            finalItemsArray.push(finalItemValue[i]);
                        }
                        i = i + 1;
                        if (i == lengthDatavalue) {
                            a = a + 1;
                            i = 0;
                        }
                    }

                    var finalCost = 0;
                    var finalTicket = 0;

                    var arrayForItemsQuantities = [];
                    var arrayForItemNames = [];

                    
                    //Array for ticket cost
                    var finalTicket = [];
                    //Costs For the tickets
                    var ticketCostArray = [];

                    //Used for multiplication of item cost and item amount
                    var totalVal = 0;
                    var sum = 0;

                    function displayChart() {

                        var finalItemCost = 0;
                        var html = "<table border='1|1' class='table'>";
                        setTimeout(() => {
                            html += "<thread>";
                            html += "<tr>";

                            html += "<td>" + "Quantity/Ticket Type" + "</td>";
                            html += "<td>" + "Item/Seat Number" + "</td>";
                            html += "<td>" + "Delete Row" + "</td>";
                            html += "<td>" + "Minus" + "</td>";
                            html += "<td>" + "Add" + "</td>";
                            //Add cost
                            html += "<td>" + "Cost Per Item" + "</td>";
                            html += "<td>" + "Final Item Cost" + "</td>";
                            html += "</tr>";
                            html += "</thread>";

                            var inc = 0;
                            var costs = 0;
                            let nullTicket = null;

                            if (CticketType != nullTicket) {
                                for (var i = 0; i < CticketType.length; i++) {
                                    html += "<tr>";
                                    html += "<td>" + CticketType[i] + "</td>";
                                    html += "<td>" + CticketNumber[i] + "</td>";
                                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteTicket(${i})'>Delete</button>` + "</td>";
                                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                                    //cost
                                    var countType = 0;
                                    while (countType != 3) {
                                        console.log("countType" + ticketTypeList[countType])
                                        if (CticketType[i] == ticketTypeList[countType]) {
                                            html += "<td>" + "$" + Number(ticketsCosts[countType]).toFixed(2) + "</td>";
                                           
                                            ticketCostArray.push(ticketsCosts[countType]);
                                            console.log("ArrayPush" + ticketCostArray);
                                            
                                            //Calulate final cost
                                            finalItemCost = finalItemCost + Number(ticketsCosts[countType]);
                                        }
                                        countType = countType + 1;
                                    }

                                    html += "<td>" + " " + "</td>";
                                    html += "</tr>";
                                    inc = inc + 1;
                                    console.log("ArrayPushYes" + ticketCostArray);
                                }
                            }

                            //Concessions
                            for (var i = 0; i < itemQ.length; i++) {
                                console.log(i + "YES THIS IS CURRENT VALUE:" + itemQ[i] + "<br>");
                                console.log(itemQ);
                                console.log(foodName);
                                html += "<tr>";
                                html += "<td>" + itemQ[i] + "</td>";
                                html += "<td>" + foodName[i] + "</td>";

                                html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteButton(${i})'>Delete</button>` + "</td>";
                                html += "<td>" + `<button type="button" class="btn btn-danger" onclick='minusButton(${i})'>-</button>` + "</td>";
                                html += "<td>" + `<button type="button" class="btn btn-danger" onclick='addButton(${i})'>+</button>` + "</td>";
                                //Cost
                                html += "<td>" + "$" + finalItemsArray[i] + "</td>";
                                totalVal = itemQ[i] * finalItemsArray[i];
                                html += "<td>" + "$" + Number(totalVal).toFixed(2) + "</td>";
                                finalItemCost = finalItemCost + totalVal;

                                inc = inc + 1;
                                costs = costs + 1;

                            }
                            html += "</table>";
                            html += "<table>";
                            html += "<td width=845px>" + "Final Price: $" + finalItemCost.toFixed(2) + "</td>";
                            html += "</tr>";
                            html += "</table>";
                            document.getElementById("testArr").innerHTML = html
                        }, 200);
                    }

                    displayChart();

                    //BUTTON FUNCTIONS-For the diagram such as delete add minus 
                    function deleteButton(i) {
                        //Minus for FinalCost for the item
                        const final = Number(finalCost) - Number(costOfItem[i]);
                        finalCost = final;

 
                        finalItemsArray.splice(i, 1);
                        itemQ.splice(i, 1);
                        foodName.splice(i, 1);
                        costOfItem.splice(i, 1);
                        console.log(itemQ);
                        console.log(foodName);
                        checkEmpty();
                        displayChart();
                    }

                    function minusButton(i) {
                        if (itemQ[i] == 1) {
                            displayChart();
                        } else {
                            //Set finalItemCost to zero
                            var finalItemCost = 0;

                            //Removing final cost for item
                            const final = Number(finalCost) - Number(totalVal);
                            finalCost = final;
                            //Add to cost count for item
                            const sum = Number(costOfItem[i]) - Number(finalItemValue[i]);

                            //finalItemCosts[i] = sum;
                            itemQ[i] = itemQ[i] - 1;
                            displayChart();

                        }
                    }

                    function addButton(i) {
                        if (itemQ[i] == 10) {
                            displayChart();
                        } else {
                            //Removing finalCost value
                            const final = Number(finalCost) - Number(costOfItem[i]);
                            finalCost = final;

                            var addOne = 1;

                            //Add to cost count for item
                            const sum = Number(finalItemValue[i]) + Number(costOfItem[i]);
                            console.log("SUM" + sum);

                            //Updating finalCost
                            const added = Number(finalCost) + Number(sum);
                            finalCost = added;
                            itemQ[i] = ++itemQ[i];

                            displayChart();
                        }
                    }

                    function deleteTicket(i) {
                        //Removing finalCost value
                        const final = Number(finalTicket[i]) - Number(ticketsCosts[i]);
                        finalCost = final;
                        
                        CticketType.splice(i, 1);
                        CticketNumber.splice(i, 1);
                        console.log(CticketType);
                        console.log(CticketNumber);
                        sessionStorage.removeItem(CticketNumber);
                        sessionStorage.removeItem(CticketType);

                        //Removes type
                        delete CticketType["remove"];
                        sessionStorage.setItem('ticketTypes', JSON.stringify(CticketType));
                        //Removes Number
                        delete CticketNumber["removeYes"];
                        sessionStorage.setItem('ticketName', JSON.stringify(CticketNumber));
                        checkEmpty();
                        displayChart();
                    }

                    const itemAmount = JSON.stringify(itemQ);
                    sessionStorage.setItem('itemQ', itemAmount);
                    //Item Quantity, Item, and Item Cost going to FinalPayment.php
                    //Item Amount
                    const itemNumber = sessionStorage.getItem('itemQ');
                    const finalItemQuantity = JSON.parse(itemNumber);
                    console.log("FINAL ITEM QUANTITY" + finalItemQuantity);
                    //Item Names
                    const itemNameFinalPay = JSON.stringify(foodName);
                    sessionStorage.setItem('foodName', itemNameFinalPay);
                    //Item Quantity, Item, and Item Cost going to FinalPayment.php
                    //Item Name
                    const itemNamed = sessionStorage.getItem('foodName');
                    const customerFinalCostOrder = JSON.parse(itemNamed);
                    console.log("FINAL CUSTOMER NAME" + customerFinalCostOrder);
                    //Item's Customer Cost
                    const finalPayment = JSON.stringify(costOfItem);
                    sessionStorage.setItem('costOfItem', finalPayment);
                    //Item Quantity, Item, and Item Cost going to FinalPayment.php
                    //Item Name
                    const itemCosts = sessionStorage.getItem('costOfItem');
                    const customerFinalCosts = JSON.parse(itemCosts);
                    console.log("FINAL CUSTOMER Costs" + customerFinalCosts);
                    //Cutomer Number
                    const numberOFCustomerTicket = JSON.stringify(foodName);
                    sessionStorage.setItem('foodName', numberOFCustomerTicket);
                    const ticketOrderNumber = sessionStorage.getItem('ticketName');
                    const CticketForThisOrder = JSON.parse(ticketOrderNumber);
                    console.log("NUMBER" + CticketForThisOrder);

                    function save() {

                        //Quantity of Items
                        const itemAmount = JSON.stringify(itemQ);
                        sessionStorage.setItem('itemQ', itemAmount);
                        //Item Quantity, Item, and Item Cost going to FinalPayment.php
                        //Item Amount
                        const itemNumber = sessionStorage.getItem('itemQ');
                        const finalItemQuantity = JSON.parse(itemNumber);
                        console.log(finalItemQuantity);
                        //Item Names
                        const itemNameFinalPay = JSON.stringify(foodName);
                        sessionStorage.setItem('foodName', itemNameFinalPay);
                        //Item Quantity, Item, and Item Cost going to FinalPayment.php
                        //Item Name
                        const itemNamed = sessionStorage.getItem('foodName');
                        const finalItemNames = JSON.parse(itemNamed);
                        console.log(finalItemNames);
                        //Set datbase reading item names
                        const itemNames = sessionStorage.getItem('itemNameDatabase');
                        const databaseFoodNames = JSON.parse(itemNames);
                        console.log("Database Names" + databaseFoodNames);

                    }
                </script>

            </section>
            <input id="submit" type="submit" onclick="save()" value="Submit">
        </form>
    </body>

    </html>