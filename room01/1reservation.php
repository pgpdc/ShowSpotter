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
    // (A) FIXED IDS FOR THIS DEMO
    $sessid = 1;
    $userid = 999;

    // (B) GET SESSION SEATS
    require "seatreservelib.php";
    $seats = $_RSV->get($sessid);
    ?>

    <!-- (C) DRAW SEATS LAYOUT -->
    <div id="layout"><?php
    foreach ($seats as $s) {
      $taken = is_numeric($s["user_id"]);
      printf("<div class='seat%s'%s>%s</div>",
        $taken ? " taken" : "",
        $taken ? "" : " onclick='reserve.toggle(this)'",
        $s["seat_id"]
      );
    }
    ?></div>

    <!-- (D) LEGEND -->
    <div id="legend">
      <div class="seat"></div> <div class="txt">Open</div>
      <div class="seat taken"></div> <div class="txt">Taken</div>
      <div class="seat selected"></div> <div class="txt">Your Selected Seats</div>
    </div>

    <!-- (E) SAVE SELECTION -->
    <form id="ninja" method="post" action="seatsave.php">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
    </form>
    <button id="go" onclick="reserve.save()">Reserve Seats</button>
  </body>
</html>