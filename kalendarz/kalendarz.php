<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login-register/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link rel="stylesheet" href="kalendarz.css">
    <link href="https://fonts.googleapis.com/css2?family=Anek+Kannada:wght@400;600&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1>Event Calendar</h1>
    </header>
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>
    <button id="back-to-menu" onclick="location.href='../menu/menu.php';">Back to Menu</button> 

    <div id="event-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="event-name"></h2>
            <p><strong>Description:</strong> <span id="event-description"></span></p>
            <p><strong>Location:</strong> <span id="event-location"></span></p>
            <p><strong>Note:</strong> <span id="event-note"></span></p>
            <p><strong>Participating:</strong> <span id="event-participating"></span></p>
        </div>
    </div>
    <script src="kalendarz.js"></script>
</body>
</html>
