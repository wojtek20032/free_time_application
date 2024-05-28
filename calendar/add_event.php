<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';
require 'event.php';

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];
$note = $_POST['note'];
$participating = isset($_POST['participating']) ? 1 : 0;

$event = new Event($name, $description, $date, $location, $note, $participating);
if ($event->save($conn, $user_id)) {
    echo "Event added successfully";
} else {
    echo "Error adding event.";
}

$conn->close();
?>
