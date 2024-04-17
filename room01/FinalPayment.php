<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
        <link rel="stylesheet" href="FinalPayment.css">
</head>
<body>
        <h1>Checkout Form</h1>
        <h2>Checkout Cart:</h2>
        <div id="testArray"></div>
        <script type="text/javascript">
        //Ticket name and price going to FinalPayment.php
        const ticketList = sessionStorage.getItem('ticketName');
        const finalTickets = JSON.parse(ticketList);
        console.log(ticketList);
        console.log(finalTickets);

        const ticketCostList = sessionStorage.getItem('valueT');
        const finalTicketType = JSON.parse(ticketCostList);
        console.log(finalTicketType);

        const ticketFinalCost = sessionStorage.getItem('ticketCost');
        const finalTicketPrice = JSON.parse(ticketFinalCost);
        console.log(finalTicketPrice);

        //Item Quantity
         const itemNumber = sessionStorage.getItem('value');
         const finalItemQuantity = JSON.parse(itemNumber);
         console.log(finalItemQuantity);
        //Item Name
        const itemNames = sessionStorage.getItem('itemName');
        const finalItemNames = JSON.parse(itemNames);
        console.log(finalItemNames);
        //Item Cost
        //Item Amount
        const itemsCost = sessionStorage.getItem('finalItemCosts');
        const finalItemCost = JSON.parse(itemsCost);
        console.log(finalItemCost);
        //finalCost
        const finalTotalCost = sessionStorage.getItem('finalCost');
        const itemsTotal = JSON.parse(finalTotalCost);
        
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
                
                for(var i = 0; i < finalTickets.length;i++){
                    console.log(finalTickets[i]);
                    if (finalTickets[i] != 0){
                    html +="<tr>";
                    html += "<td>"+ finalTickets[i] +"</td>";
                    html += "<td>"+ finalTicketType[i] +"</td>";
                    html += "<td>"+ finalTicketPrice[i] +"</td>";
                    html += "</tr>";
                    inc = inc + 1; 
                    }
                    
            }

            for(var i = 0; i < finalItemQuantity.length;i++){
                    console.log(finalItemQuantity[i]);
                    if (finalItemQuantity[i] != 0){
                    html +="<tr>";
                    html += "<td>"+ finalItemQuantity[i] +"</td>";
                    html += "<td>"+ finalItemNames[i] +"</td>";
                    html += "<td>"+ finalItemCost[i] +"</td>";
                    html += "</tr>";
                    inc = inc + 1; 
                    }
                    
            }  
                /*for(var i = 0; i < valueT.length;i++){
                    html +="<tr>";
                    html += "<td>"+ valueT[i] +"</td>";
                    html += "<td>"+ ticketName[i] +"</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick='deleteTicket(${i})'>Delete</button>` + "</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                    html += "<td>" + `<button type="button" class="btn btn-danger" onclick=''></button>` + "</td>";
                    //Cost
                    html += "<td>"+ ticketCost[i] +"</td>";
                    html += "<td>"+ " " +"</td>";
                    html += "</tr>";
                    inc = inc + 1; 
                    
            }*/
            html += "</table>";
        html += "<table>";
        html +="<tr>";
                html += "<td width=845px>"+"Total Price:"+ itemsTotal.toFixed(2) +"</td>";
        html +="</tr>";
        html += "</table>"
        document.getElementById("testArray").innerHTML = html},200);
            }
        //displayChart();
        displayChart();
        </script>
        
<!--<button onclick="removeIndex('Adult')"> Delete Index </button>-->



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
