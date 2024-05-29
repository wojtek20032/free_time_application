
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login-register/index.php');
    exit();
}
if (!isset($_POST['event_id'])) {
    echo "Error: Event ID not provided";
    exit();
}
require '../db.php';
require 'event.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id']; 
    $idUzytkownika = $_POST['idUzytkownika'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $note = $_POST['note'];
    $participating = isset($_POST['participating']) ? 1 : 0;

    $event = new Event($name, $description, $date, $location, $note, $participating);

if ($event->update($conn, $event_id, $idUzytkownika)) {
    echo "Event updated successfully";
} else {
    echo "Error updating event: " . $conn->error;
}
    $conn->close();
} else {
    echo 'Invalid request method';
}
?>

