<html>
<head>
<?php
    session_start();
?>
<link rel="stylesheet" href="StylesCustomer/customerInfo.css">
</head>
<body>
    <?php
    include "databaseConnectBilling.php";
    ?>
    <h1>Enter Payment</h1>
    <form action="checkout.php" method="post">
        <p>
            <label for="username">Username:</label>
            <input type="varchar" name="username" id="username">
        </p>
        <p>
            <label for="cardName">Card Name:</label>
            <input type="varchar" name="cardName" id="cardName" minlength="1" required>
        </p>
        <p>
            <label for="creditNum">Credit Card Number:</label>
            <input type="varchar" name="creditNum" id="creditNum" minlength="8"minlength="19">
        </p>
        <p>
            <label for="expDate">Experation Date:</label>
            <input type="date" name="expDate" id="expDate" value="2024-05-06" min="2024-05-02" max="2027-1-01" required>
        </p>
        <p>
            <label for="cvv">Cvv:</label>
            <input type="int" name="cvv" id="cvv" tabindex="-1">
        </p>
        <p>
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name"minlength="1" required>
        </p>
        <p>
            <label for="address">Address:</label>
            <input type="varchar" name="address" id="address"minlength="1" required>
        </p>
        <p>
            <label for="city">City:</label>
            <input type="text" name="city" id="city"minlength="1" required>
        </p>
        <p>
            <label for="state">State:</label>
            <input type="text" name="state" id="state"minlength="2" maxlength="2" required>
        </p>
        <p>
            <label for="zipCode">Zip Code:</label>
            <input type="int" name="zipCode" id="zipCode" minlength="5" maxlength="5" required>
        </p>
        <p>
            <label for="billSame">Is billing address the same as your home address:</label>
            <input type="text" name="billSame" id="billSame" minlength="2" maxlength="3" required>
        <br>
            <input type="submit" value="submit">
        </p>
</body>
</html>

