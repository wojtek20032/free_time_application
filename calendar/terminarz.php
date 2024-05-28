<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../db.php';
    require 'event.php';

    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $note = $_POST['note'];
    $participating = isset($_POST['participating']) ? 1 : 0;

    $event = new Event($name, $description, $date, $location, $note, $participating);
    if ($event->save($conn, $user_id)) {
        echo "<script>alert('Event added successfully');</script>";
    } else {
        echo "<script>alert('Error adding event.');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link rel="stylesheet" href="terminarz.css">
</head>
<body>
    <div class="calendar-container" style="display: none;">
        <div id="calendar"></div>
    </div>

    <div class="buttons-container">
        <button id="showEventsButton" class="styled-button">Show Events</button>
        <button id="addEventButton" class="styled-button">Add Event</button>
        <button onclick="window.location.href='../menu/menu.php'" class="styled-button">Powrót do menu</button>
    </div>

    <div class="event-form" style="display: none;">
        <h2>Add Event</h2>
        <form id="eventForm" method="POST" action="terminarz.php">
            <input type="hidden" id="idUzytkownika" name="idUzytkownika" value="<?php echo $user_id; ?>"> 
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" placeholder="Event Name" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Event Description" required></textarea>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Location" required>
            <label for="note">Note:</label>
            <textarea id="note" name="note" placeholder="Note" required></textarea>
            <label>
                <input type="checkbox" id="participating" name="participating"> Participating
            </label>
            <button type="submit" class="styled-button">Add Event</button>
        </form>
    </div>
    <script src="terminarz.js"></script>
</body>
</html>