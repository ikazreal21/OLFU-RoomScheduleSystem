<?php
require '../connection.php';
$conn = Connect();

$id = $_GET['id'] ?? '';
$prof_id = $_GET['prof_id'] ?? '';


$sql1 = "DELETE from prof_schedule WHERE id = '$id' ";
$result1 = $conn->query($sql1);
header("location: list_schedule.php?id=$prof_id")
?>