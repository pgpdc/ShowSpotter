<?php
class Reserve {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = null;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) HELPER FUNCTION - RUN SQL QUERY
  function query ($sql, $data=null) : void {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GET SEATS FOR GIVEN SESSION
  function get($sessid, $time, $date, $id) {
    $this->query(
        "SELECT DISTINCT sa.`seat_id`, r.`user_id`, r.`time`
        FROM `seats` sa
        LEFT JOIN `sessions` se USING (`room_id`)
        LEFT JOIN (
            SELECT `seat_id`, `user_id`, `time`
            FROM `reservations`
            WHERE `time` = ? AND `date` = ? AND `id` = ? -- Add the condition for date comparison
        ) r ON sa.`seat_id` = r.`seat_id`
        WHERE se.`session_id` = ?
        ORDER BY sa.`seat_id`", [$time, $date, $id, $sessid]
    );
    $sess = $this->stmt->fetchAll();
    if (empty($sess)) {
        // Create seats if none exist
        echo "Empty table; creating new seats.";
    }
    return $sess;
}


  // (E) SAVE RESERVATION
  function save ($sessid, $userid, $seats, $time, $date,$id) {
    $sql = "INSERT INTO `reservations` (`session_id`, `seat_id`, `user_id`, `time`,`date`, `id`) VALUES ";
    $data = [];
    foreach ($seats as $seat) {
      $sql .= "(?,?,?,?,?,?),";
      array_push($data, $sessid, $seat, $userid, $time, $date, $id);
    }
    $sql = substr($sql, 0, -1);
    $this->query($sql, $data);
    return true;
  }

 
}
// (F) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "indiana");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (G) NEW CATEGORY OBJECT
$_RSV = new Reserve();