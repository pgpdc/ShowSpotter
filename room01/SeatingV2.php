<!DOCTYPE html>
<html lange="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" contents="IE=edge" />
    <meta name="viewport" content="width=device-width, intital-scale=1.0" />
    <link rel="stylesheet" href="SeatingV2.css" />

    <title>ShowStopper</title>
  </head>
  <body>

  <?php
  session_start();
    // (A) FIXED IDS FOR THIS DEMO
    $sessid = 1;
    $userid = 999;
    $date = $_GET["date"];
    $time = $_GET["time"];
    $id = $_GET["id"];
    $count = 0;

    // (B) GET SESSION SEATS
    require "seatreservelib.php";
    $seats = $_RSV->get($sessid, $time, $date, $id);
    ?>

    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available Seats</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected Seats</small>
      </li>
      <li>
        <div class="seat sold"></div>
        <small>Sold Seats</small>
      </li>
    </ul>
    
    <div id="layout">
    <div class="screen">
      <?php
      
      foreach ($seats as $s) {
        if (($count % 9)== 0) {
          printf("</div>");
          printf("<div class='row'>");
        }
        $count +=1; 
        if ($s["time"] === $time) {
          // Seat is taken
          printf("<div class='seat sold'>%s</div>", $s["seat_id"]);
      } else {
          // Seat is available
          printf("<div class='seat' onclick='reserve.toggle(this)'>%s</div>", $s["seat_id"]);
      }
        /*$sold = is_numeric($s["user_id"]);
        printf("<div class='seat%s'%s>%s</div>",
          $sold ? " sold" : "",
          $sold ? "" : " onclick='reserve.toggle(this)'",
          $s["seat_id"]
      */
      }
      ?>
    </div>

    <script src="1reservation.js"></script>
    <form id="ninja" method="post" action="checkoutForm.php">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
      <input type="hidden" name="time" value="<?=$time?>">
      <input type="hidden" name="date" value="<?=$date?>">
      <input type="hidden" name="id" value="<?=$id?>">
    </form>
    <button id="go" onclick="reserve.save()">Reserve Seats</button>
  </body>
</html>
