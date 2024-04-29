<!DOCTYPE html>
<html>
  <head>
    <title>Seat Reservation</title>
    <meta charset="utf-8">
    <script src="1reservation.js"></script>
    <link rel="stylesheet" href="1reservation.css">
  </head>
  <body>
    <?php
    session_start();
    // (A) FIXED IDS FOR THIS DEMO CHANGE TO USER ID FOR LOGIN
    $sessid = 1;
    $userid = 999;
    $date = $_GET["date"];
    $time = $_GET["time"];
    $id = $_GET["id"];
    echo $date;
    echo "\n";
    echo $time;
    echo "\n";
    echo "room";
    echo $id;
    echo "Name " . $_SESSION["name"];
    // (B) GET SESSION SEATS
    require "seatreservelib.php";
    $seats = $_RSV->get($sessid, $time, $date, $id);
    ?>

    <!-- (C) DRAW SEATS LAYOUT -->
    <div id="layout"><?php
    foreach ($seats as $s) {
      if ($s["time"] === $time) {
        // Seat is taken
        printf("<div class='seat taken'>%s</div>", $s["seat_id"]);
    } else {
        // Seat is available
        printf("<div class='seat' onclick='reserve.toggle(this)'>%s</div>", $s["seat_id"]);
    }
    }
    ?></div>

    <!-- (D) LEGEND -->
    <div id="legend">
      <div class="seat"></div> <div class="txt">Open</div>
      <div class="seat taken"></div> <div class="txt">Taken</div>
      <div class="seat selected"></div> <div class="txt">Your Selected Seats</div>
    </div>

    <!-- (E) SAVE SELECTION -->
    <form id="ninja" method="post" action="FinalPayment.php">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
      <input type="hidden" name="time" value="<?=$time?>">
      <input type="hidden" name="date" value="<?=$date?>">
      <input type="hidden" name="id" value="<?=$id?>">
    </form>
    <button id="go" onclick="reserve.save()">Reserve Seats</button>
  </body>
</html>