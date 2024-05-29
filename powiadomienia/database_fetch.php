<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: ../login-register/index.php');
    exit();
}
require '../db.php';

$id = $_SESSION['user_id'];
$query = "SELECT * FROM `calendar_events`WHERE idUzytkownika = ? ORDER BY `calendar_events`.`date` DESC ";
$prep = $conn->prepare($query);
$prep->bind_param("i", $id);
$prep->execute();
$result = $prep->get_result();

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
?>
