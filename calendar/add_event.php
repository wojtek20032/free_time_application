<?php

require '../db.php';
require 'event.php';

$idUzytkownika = $_POST['idUzytkownika'];
$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];
$note = $_POST['note'];
$participating = isset($_POST['participating']) ? 1 : 0;


$event = new Event($name, $description, $date, $location, $note, $participating);
if ($event->save($conn, $idUzytkownika)) {
    echo "Event added successfully";
} else {
    echo "Error adding event.";
}

$conn->close();
?>
