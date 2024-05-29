<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';
require 'event.php';

$idUzytkownika = $_SESSION['user_id'];
$date = $_POST['date'];
$name = $_POST['name'];
$description = $_POST['description'];
$location = $_POST['location'];
$note = $_POST['note'];
$participating = $_POST['participating'];

$event = new Event($name, $description, $date, $location, $note, $participating);

if ($event->save($conn, $idUzytkownika)) {
    echo "Event added successfully";
} else {
    echo "Error adding event: " . $conn->error;
}
$conn->close();
?>
