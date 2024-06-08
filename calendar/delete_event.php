<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';
require 'event.php';

$event_id = $_POST['event_id'];
$idUzytkownika = $_SESSION['user_id'];

if (Event::delete($conn, $event_id, $idUzytkownika)) {
    echo "Event deleted successfully";
} else {
    echo "Error deleting event: " . $conn->error;
}
$conn->close();
?>
