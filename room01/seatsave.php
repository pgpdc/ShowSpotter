<?php
// (A) LOAD LIBRARY
require "seatreservelib.php";

// (B) SAVE
$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
echo "SAVED";