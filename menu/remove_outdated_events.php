<?php
session_start();
require '../db.php';

$sql = "DELETE FROM calendar_events WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['record_to_be_deleted']);
$stmt->execute();
$result = $stmt->get_result();
?>
