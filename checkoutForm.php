<$DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
</head>
<body>
    <center>
        <h1>Checkout Form</h1>
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
            <label for="creditNum">Username:</label>
            <input type="varchar" name="creditNum" id="creditNum">
        </p>
        <p>
            <label for="expDate">Username:</label>
            <input type="varchar" name="expDate" id="expDate">
        </p>
        <p>
            <label for="cvv">Username:</label>
            <input type="int" name="cvv" id="cvv">
        </p>
        <p>
            <label for="name">Username:</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="address">Username:</label>
            <input type="varchar" name="address" id="address">
        </p>
        <p>
            <label for="city">Username:</label>
            <input type="text" name="city" id="city">
        </p>
        <p>
            <label for=state">Username:</label>
            <input type="text" name="state" id="state">
        </p>
        <p>
            <label for="zipCode">Username:</label>
            <input type="int" name="zipCode" id="zipCode">
        </p>
        <p>
            <label for="billSame">Username:</label>
            <input type="text" name="billSame" id="billSame">
        </p>
        <input type="submit" value="Submit">
</form>
</center>
</body>
</html>