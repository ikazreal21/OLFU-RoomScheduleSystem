<?php

session_start();
require '../connection.php';
$conn = Connect();

$id = $_GET['id'] ?? 0;

if ($id == 0) {
    echo 'Invalid ID';
    exit;
}

// $schedule = [
//     'Monday' => [
//         '09:00 AM' => ['subject' => 'Math 101', 'room' => 'Room 101', 'duration' => 2],
//         '11:00 AM' => ['subject' => 'Physics 201', 'room' => 'Room 303', 'duration' => 2],
//         '01:00 PM' => ['subject' => 'CS 202', 'room' => 'Room 505', 'duration' => 2],
//     ],
//     'Tuesday' => [
//         '09:00 AM' => ['subject' => 'Math 101', 'room' => 'Room 101', 'duration' => 2],
//         '11:00 AM' => ['subject' => 'Physics 201', 'room' => 'Room 303', 'duration' => 2],
//     ],
//     'Wednesday' => [
//         '09:00 AM' => ['subject' => 'CS 101', 'room' => 'Room 202', 'duration' => 2],
//         '01:00 PM' => ['subject' => 'Office Hours', 'room' => 'Room 404', 'duration' => 2],
//     ],
//     'Thursday' => [
//         '09:00 AM' => ['subject' => 'CS 101', 'room' => 'Room 202', 'duration' => 2],
//         '03:00 PM' => ['subject' => 'Math 202', 'room' => 'Room 606', 'duration' => 2],
//     ],
//     'Friday' => [
//         '11:00 AM' => ['subject' => 'CS 202', 'room' => 'Room 505', 'duration' => 2],
//         '03:00 PM' => ['subject' => 'Math 202', 'room' => 'Room 606', 'duration' => 2],
//     ]
// ];


$schedule = [];
$sql = "SELECT *, TIME_FORMAT(time, '%h:%i %p') AS time FROM prof_schedule where prof_id = $id";
$result = $conn->query($sql);

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $schedule[$row['day_of_week']][$row['time']] = [
            'subject' => $row['subject_name'],
            'room' => $row['room'],
            'duration' => $row['duration'],
            'online' => $row['is_online'],
            'id' => $row['id'],
        ];
    }
}


$daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
$hours = ['08:00 AM', '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM', '06:00 PM', '07:00 PM', '08:00 PM'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Schedule</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="top-links">
            <a href="../session_back.php" class="btn">Back</a>
            <?php if (!isset($_SESSION['login_prof']) && !isset($_SESSION['login_secretary'])): ?>
                    <a href="add_schedule.php?id=<?php echo $id ?>" class="btn">Add Schedule</a>
                    <a href="list_schedule.php?id=<?php echo $id ?>" class="btn">List of Schedule</a>
            <?php endif; ?>
        </div>
        <div class="header">
            <div class="hour-label"></div>
            <?php foreach ($daysOfWeek as $day): ?>
                <div class="day"><?= $day ?></div>
            <?php endforeach; ?>
        </div>
        <div class="body">
            <?php foreach ($hours as $hour): ?>
                <div class="hour">
                    <div class="hour-label"><?= $hour ?></div>
                    <?php foreach ($daysOfWeek as $day): ?>
                        <div class="slot">
                            <?php 
                            if (isset($schedule[$day][$hour])): 
                                $class = $schedule[$day][$hour]; ?>
                                <div class="class" style="height: <?= 50 * $class['duration'] ?>px;">
                                    <?= $class['subject'] ?><br><?= $class['room'] ?><br>
                                    <?php if ($class['online'] == true): ?>
                                        <span class="online">Online</span>
                                        <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
</body>
</html>