<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';

$user_id = $_SESSION['user_id'];
//CONCAT(CAST(calendar_events.date as varchar(20)),CAST(calendar_events.id as varchar(20))) = ?";
$sql = "SELECT * FROM calendar_events WHERE CONCAT(CAST(calendar_events.date as varchar(20)),CAST(calendar_events.id as varchar(20))) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST['record']);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
$events[] = $result->fetch_assoc();

echo json_encode($events);
?>
