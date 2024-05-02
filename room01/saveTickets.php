<?php 
session_start()
?>

<DOCTYPE html>
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
        <?php require("../navbar.php"); ?>
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
                    //echo $num;
                    //echo "<br>";
                    if ($num != 0) {
                        array_push($foodNameCon, $f);
                        //echo $f;
                        //echo "<br>";
                        //echo $num;
                        array_push($foodValue, $num);
                        array_push($ItemCostFinal, $num);
                    }
                    $i = $i + 1;
                }

                foreach ($foodNameCon as $f => $num) {
                    //echo $f;
                    //echo "<br>Name:";
                    //echo $num;
                    //echo "<br>";
                }

                foreach ($foodValue as $f => $num) {
                    //echo $f;
                    //echo "<br>Number";
                    //echo $num;
                    //echo "<br>";
                }
            }
            $arrQuantity = array();
            ?>
            <section>
                <h1>Tickets</h1>
                </table>
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
                    //console.log(ticketsCosts);


                    //Customer Arrays for Item,Item Quantity

                    //Array converted from php to javascript for customers items quantity
                    var arrFoodQuantity = <?php echo json_encode($foodValue); ?>;
                    //Index for the quantity
                    let itemIndexQ = Object.keys(arrFoodQuantity);
                    //Quantity number for the item
                    let itemQ = Object.values(arrFoodQuantity);
                    console.log("YES THIS IS THE QUANTITY INDEX" + itemIndexQ);

                    //Array converted from php to javascript for customers items name
                    var arrFoodName = <?php echo json_encode($foodNameCon); ?>;
                    //Index for the name for the customers item they picked
                    let foodNameIndex = Object.keys(arrFoodName);
                    //The food name for the customers item they picked
                    let foodName = Object.values(arrFoodName);
                    console.log("YES THIS IS FOOD NAME" + foodNameIndex);

                    //Get price for the food










                    //Database Array for Item Name and Price
                    //Database Item Name Array

                    const itemNames = sessionStorage.getItem('itemName');
                    const finalItemNames = JSON.parse(itemNames);
                    console.log("Database Names" + finalItemNames);

                    //Database Item Cost
                    const itemsValue = sessionStorage.getItem('value');
                    const finalItemValue = JSON.parse(itemsValue);
                    //finalItemValue.reverse();
                    console.log("DATABASE COST" + finalItemValue);

                    var a = 0;
                    var count = 0;
                    const arrIndex = 0;

                    const arrNames = [];
                    const costOfItem = [];
                    //finalItemValue
                    //Database
                    //finalItemNames
                    //customer
                    //customerFinalCostOrder
                    customerFinalARRAYS = [];
                    customerIndividual = [];
                    for (var i = 0; i < itemQ.length; i++) {
                        console.log(i + "YES THIS IS CURRENT VALUE:" + itemQ[i] + "<br>");
                        console.log(itemQ);
                        customerIndividual.push(itemQ);
                        customerFinalARRAYS.push(foodName[i]);
                        console.log("CUSTOMER FOOD NAMES:" + foodName);
                    }


                    //Calculate Costs
                    const finalItemsArray = [];
                    //DatabASE Count
                    let lengthDatavalue = finalItemNames.length;
                    //Cusotmer Count
                    let multiplyDataCustomer = customerFinalARRAYS.length;
                    console.log("LENGTH:" + multiplyDataCustomer + " Database " + lengthDatavalue);
                    let looping = multiplyDataCustomer * lengthDatavalue;
                    let loopingGo = multiplyDataCustomer * lengthDatavalue;
                    var a = 0;
                    var i = 0;
                    for (var loop = 0; loop <= looping; loop++) {
                        console.log("LOOP FOR THE DATA BASE ITEM Name:" + finalItemNames[i]);
                        console.log("LOOP FOR THE DATA BASE ITEM VAL:" + customerFinalARRAYS[i]);
                        console.log("LOOP FOR THE ITEM VAL:" + finalItemValue[a]);
                        if (finalItemNames[i] == customerFinalARRAYS[a]) {
                            console.log("IF LOOP DATABASE name val" + finalItemValue[i]);
                            console.log("IF LOOP CUSTOMER name val" + customerFinalARRAYS[a]);
                            finalItemsArray.push(finalItemValue[i]);
                        }
                        i = i + 1;
                        if (i == lengthDatavalue) {
                            a = a + 1;
                            console.log("A" + a);
                            i = 0;
                        }
                    }






                    /*
                    
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
                            console.log(finalItemValue);
                        }
                    */

                    //Array for reading in final cost
                    const finalItemCosts = <?php echo json_encode($ItemCostFinal); ?>;



                    //console.log("Original"+itemNameCustomer+"<br>");
                    //console.log("Original"+valueCustomer+"<br>");
                    var finalCost = 0;
                    var finalTicket = 0;

                    var arrayForItemsQuantities = [];

                    var arrayForItemNames = [];

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

                    for (var i = 0; i < itemQ.length; i++) {

                    }

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

                            //
                            var inc = 0;
                            //Tickets
                            var costs = 0;

                            //var TotalTicket = 0;
                            let nullTicket = null;
                            console.log(ticketsCosts);
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
                                            //TotalTicket = TotalTicket + Number(ticketsCosts[i]);
                                            finalItemCost = finalItemCost + Number(ticketsCosts[countType]);
                                        }
                                        countType = countType + 1;
                                    }


                                    //html += TotalTicket;
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
                                //html += "</tr>";

                                inc = inc + 1;
                                costs = costs + 1;

                            }
                            html += "</table>";
                            html += "<table>";
                            //html +="<tr>";
                            html += "<td width=845px>" + "Final Price: $" + finalItemCost.toFixed(2) + "</td>";
                            html += "</tr>";
                            html += "</table>";
                            document.getElementById("testArr").innerHTML = html
                        }, 200);
                    }
                    //console.log("ArrayPushYesMoreMore"+ticketCostArray);  

                    displayChart();

                    //BUTTON FUNCTIONS-For the diagram such as delete add minus 
                    function deleteButton(i) {
                        //Minus for FinalCost for the item
                        //Removing finalCost value
                        const final = Number(finalCost) - Number(costOfItem[i]);
                        finalCost = final;

                        alert(i);
                        finalItemsArray.splice(i, 1);
                        itemQ.splice(i, 1);
                        foodName.splice(i, 1);
                        costOfItem.splice(i, 1);
                        console.log(itemQ);
                        console.log(foodName);
                        //sessionStorage.removeItem("ticketName")
                        displayChart();

                    }



                    function minusButton(i) {
                        if (itemQ[i] == 1) {
                            displayChart();
                        } else {
                            //Set finalItemCost to zero
                            var finalItemCost = 0;
                            console.log("MINUS BUTTON" + finalItemCost);

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
                            console.log(finalCost);
                            var addOne = 1;
                            console.log("addButton" + addOne);

                            //Add to cost count for item
                            const sum = Number(finalItemValue[i]) + Number(costOfItem[i]);

                            //finalItemCost[i] = sum;
                            console.log("SUM" + sum);

                            //Updating finalCost
                            const added = Number(finalCost) + Number(sum);
                            finalCost = added;
                            itemQ[i] = ++itemQ[i];

                            //Updating array value for next page
                            displayChart();
                        }
                    }

                    function deleteTicket(i) {
                        //Minus for FinalCost for the ticket
                        //Removing finalCost value
                        const final = Number(finalTicket[i]) - Number(ticketsCosts[i]);
                        finalCost = final;

                        alert(i);
                        //ticketsCosts.splice(i,1);
                        CticketType.splice(i, 1);
                        CticketNumber.splice(i, 1);
                        console.log(CticketType);
                        console.log(CticketNumber);
                        sessionStorage.removeItem(CticketNumber);
                        sessionStorage.removeItem(CticketType);
                        //sessionStorage.removeItem("CticketNum");
                        //sessionStorage.removeItem("CticketType");

                        //Removes type
                        delete CticketType["remove"];
                        sessionStorage.setItem('ticketTypes', JSON.stringify(CticketType));

                        //Removes Number
                        delete CticketNumber["removeYes"];
                        sessionStorage.setItem('ticketName', JSON.stringify(CticketNumber));
                        displayChart();
                    }


                    console.log("A" + ticketCostArray);
                </script>

                <script>
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

                    }
                </script>

            </section>
            <input type="submit" onclick="save()" value="Submit">
        </form>
    </body>

    </html>