<?php
require 'connection.php';
$conn = Connect();

$id = $_GET['id'] ?? '';


$sql1 = "UPDATE schedules SET 	booking_status='decline' WHERE id = '$id' ";
$result1 = $conn->query($sql1);
header("location: pending_bookings_admin.php")
?>