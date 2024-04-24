<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
        <link rel="stylesheet" href="FinalPayment.css">
        <?php
       //require "seatreservelib.php";
        //include "checkoutForm.php";
        //$_RSV->save($_SESSION["sessid"], $_SESSION["userid"], $_SESSION["seats"], $_SESSION["time"], $_SESSION["date"], $_SESSION["id"]);
        ?>
</head>
<body>
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
        <div id="testArray"></div>
        <script type="text/javascript">
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
    
        //Customers Item Name
        const nameItem = sessionStorage.getItem('foodName');
        const ItemNames = JSON.parse(nameItem);
        console.log(ItemNames);

        //Cost per Item
        const itemsValue = sessionStorage.getItem('costOfItem');
        const finalItemValue = JSON.parse(itemsValue);
        console.log(finalItemValue);

        //Ticket Type from database
        const ticketList = sessionStorage.getItem('ticketNameData');
        const ticketTypeList = JSON.parse(ticketList);
        console.log("DATA"+ticketTypeList);

        var ticketCostArray = [];

        //Check if array is null 
        let nullTicket=null;
        if(CticketType != nullTicket){
            
        for(var i = 0; i < CticketType.length;i++){
        var countType = 0;
        while(countType != 3){
            console.log("TESTL:" + CticketType[i]);
            console.log("TESTL:" + ticketTypeList[countType]);
            
            if(CticketType[i] == ticketTypeList[countType]){
                console.log("TEST:" + ticketsCosts[countType]);
                ticketCostArray.push(ticketsCosts[countType]);
                console.log("ArrayPush"+ticketCostArray);
                
                    }
        countType = countType + 1;
                }
            }
        }
        
        var Final = 0;

        var finalCost = 0; 
        function displayChart(){
            var html = "<table backgroundColor='white' border='1|1' class='table'>";
            setTimeout(() => {
                html += "<thread>";
                html +="<tr>";
                html += "<td>"+"Quantity/Ticket Type"+"</td>";
                html += "<td>"+"Item/Seat Number"+"</td>";
                html += "<td>"+"Cost"+"</td>";
                //Add cost
                //html += "<td>"+"Cost Per Item"+"</td>";
                //html += "<td>"+"Final Item Cost"+"</td>";
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
                html += "<td width=845px>"+"Total Price: $"+ finalCost.toFixed(2) +"</td>";
        html +="</tr>";
        html += "</table>"
        document.getElementById("testArray").innerHTML = html},200);
            }
        //displayChart();
        displayChart();
        </script>
        
<!--<button onclick="removeIndex('Adult')"> Delete Index </button>-->
<?php
//When submitted seat is reserved

?>

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
            <label for="address">Address:</label>
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
</body>
</html>


