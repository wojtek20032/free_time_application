<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM calendar_events WHERE idUzytkownika = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
?>
