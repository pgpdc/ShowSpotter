<?php
session_start();
?>
   
<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Form</title>
        <link rel="stylesheet" href="concessions.css">
</head>
<body>
        <h1>Concessions</h1>
        <h2>Food and Drink Options:</h2>
        <h3>For drink: It is self-service and provided on site at your theatre location</h3>
    <!--<form action="FinalPayment.php"method="post">-->
    <form action="saveTickets.php"method="post">
    
    

    <?php
    if (isset($_POST['tickets'])){
        $_SESSION['tickets'] = $_POST['tickets'];
    }





    //Getting Values from mySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn-> connect_error){
        die("Connection Error");
    }
    
    //read in food and drink Items
    $sql = "SELECT foodItem,foodPrice FROM foodprices";
    $result = $conn->query($sql);
    
   
    $food= array();
    $a = 0;
    if ($result->num_rows >0){
    while($row = $result->fetch_assoc()){
                
                //echo $row['foodItem'];
                
                $food[$a] = $row['foodItem'];
 
                $a = $a + 1;
                //echo "<br>";
    }
}           
     //Loop-For customer selection of food and drink
     $a=0;
     foreach ($food as $f) 
     {
        //$foodName = array();
        //$carry = $_POST[$foodName[$f]];
        $stringPrint = $f;
        $splitCapital = preg_split('/(?=[A-Z])/',$stringPrint);
        $capital = implode(' ',$splitCapital);
        
        //echo "Select how may you want for ".$word.":";
        echo "<label for='$f'>Select how may $capital(s)you would like to purchase:<br></label>";
        //echo "<select name='foodVal[$f]'>
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
    
    ?>
    <input type="submit" value="Submit">
    </form>
</body>
        </html>


