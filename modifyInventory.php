<?php
session_start();
if ($_SESSION["admin"] != TRUE) {
    header("location: index.php");
    exit();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['foodItem']) && isset($_POST['change']) && isset($_POST['price'])) {
        $foodItem = $_POST['foodItem'];
        $change = $_POST['change'];
        $price = $_POST['price'];

        $sql = "UPDATE foodprices SET inventory = ?, foodPrice = ? WHERE foodItem = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ids", $change, $price, $foodItem);
            mysqli_stmt_execute($stmt);
        }
    }

    if (isset($_POST['newFoodItem']) && isset($_POST['newInventory']) && isset($_POST['newPrice'])) {
        $newFoodItem = $_POST['newFoodItem'];
        $newInventory = $_POST['newInventory'];
        $newPrice = $_POST['newPrice'];

        $sql = "INSERT INTO foodprices (foodItem, inventory, foodPrice) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sii", $newFoodItem, $newInventory, $newPrice);
            mysqli_stmt_execute($stmt);
        }
    }

    if (isset($_POST['deleteFoodItem'])) {
        $deleteFoodItem = $_POST['deleteFoodItem'];

        $sql = "DELETE FROM foodprices WHERE foodItem = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $deleteFoodItem);
            mysqli_stmt_execute($stmt);
        }
    }
}

$sql = "SELECT * FROM foodprices";
$result = mysqli_query($link, $sql);

echo "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        table {
            margin-bottom: 50px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        form {
            margin-bottom: 20px;
        }
        .admin-home-button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }
        .admin-home-button:hover {
            background-color: #0056b3;
        }
        .button-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<div class='button-container'>
        <a href='admin.php' class='admin-home-button'>Admin Home</a>
    </div>
";

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Food Item</th><th>Inventory</th><th>Price</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["foodItem"] . "</td>";
        echo "
            <form method='post' action=''>
                <input type='hidden' name='foodItem' value='" . $row["foodItem"] . "' />
                <td>
                <input type='number' name='change' value='" . $row["inventory"] . "' />
                </td><td>
                <input type='number' step='0.01' name='price' value='" . $row["foodPrice"] . "' />
                </td><td>
                <input type='submit' value='Update' />
                </td>
            </form>
        ";
        echo "
            <form method='post' action=''>
            <td>
                <input type='hidden' name='deleteFoodItem' value='" . $row["foodItem"] . "' />
                <input type='submit' value='Delete' />
                </td>
            </form>
        ";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "
<form method='post' action=''>
    <label for='newFoodItem'>New Food Item:</label>
    <input type='text' id='newFoodItem' name='newFoodItem' required>
    <label for='newInventory'>Inventory:</label>
    <input type='number' id='newInventory' name='newInventory' required>
    <label for='newPrice'>Price:</label>
    <input type='number' step='0.01' id='newPrice' name='newPrice' required>
    <input type='submit' value='Add New Item'>
</form>
";

echo "
</body>
</html>
";

mysqli_close($link);
