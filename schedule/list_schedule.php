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


$schedule_list = [];
$sql = "SELECT *, TIME_FORMAT(time, '%h:%i %p') AS time FROM prof_schedule where prof_id = $id";
$result = $conn->query($sql);
// $row = $result->fetch_object();
// echo '<pre>';
// var_dump($row);
// echo '</pre>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $schedule_list[] = [
            'day_of_week' => $row['day_of_week'],
            'time' => $row['time'],
            'subject' => $row['subject_name'],
            'room' => $row['room'],
            'duration' => $row['duration'],
            'online' => $row['is_online'],
            'id' => $row['id'],
        ];
    }
}


// echo '<pre>';
// var_dump($schedule_list);
// echo '</pre>';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .btn {
            text-decoration: none;
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="schedule.php?id=<?php echo $id  ?>" class="btn">Back</a>
        <h1>Schedule List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Subject</th>
                    <th>Room</th>
                    <th>Duration (hours)</th>
                    <th>Online</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule_list as $schedule): ?>
                    <!-- <?php echo $schedule[0] ?> -->
                    <tr>
                        <td><?php echo $schedule['id'] ?></td>
                        <td><?php echo $schedule['day_of_week'] ?></td>
                        <td><?php echo $schedule['time'] ?></td>
                        <td><?php echo $schedule['subject'] ?></td>
                        <td><?php echo $schedule['room'] ?></td>
                        <td><?php echo $schedule['duration'] ?></td>
                        <?php if ($schedule['online']): ?>
                            <td>Online</td>
                        <?php else: ?>
                            <td>Offline</td>
                        <?php endif; ?>
                        <td class="actions">
                            <a href="edit_schedule.php?id=<?= $schedule['id'] ?>&prof_id=<?php echo $id  ?>">Edit</a>
                            <a href="delete.php?id=<?= $schedule['id'] ?>&prof_id=<?php echo $id  ?>" onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>