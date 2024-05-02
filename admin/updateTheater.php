<?php
session_start();
if (isset($_POST['theater'])) {
    $_SESSION['theater'] = $_POST['theater']; 
    echo "Session theater updated to: " . $_SESSION['theater'];
} else {
    echo "Theater value not received";
}
?>
