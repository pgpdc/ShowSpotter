<!DOCTYPE html>
<html>
<body>
<?php
// (A) LOAD LIBRARY
require "seatreservelib.php";

// (B) SAVE

$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
?>

<form method="POST" action="checkoutForm.php">
    How many adults:<input type="text" name="adult"><br>
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
</form>

</body>
</html>