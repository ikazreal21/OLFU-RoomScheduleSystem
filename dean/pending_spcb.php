<?php

session_start();
require '../connection.php';
$conn = Connect();

// $id = $_GET['id'] ?? 0;

// if ($id == 0) {
//     echo 'Invalid ID';
//     exit;
// }

$schedule_list = [];
$sql = "SELECT * FROM schedules s, room c where s.car_id = c.car_id and c.car_nameplate = 'AVR' and s.booking_status = 'pending'";
$result = $conn->query($sql);
// $row = $result->fetch_object();
// echo '<pre>';
// var_dump($row);
// echo '</pre>';


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $schedule_list[] = [
            'day_of_week' => $row['day_of_week'],
            'rent_start_date' => $row['rent_start_date'],
            'event_name' => $row['event_name'],
            'time_start' => $row['time_start'],
            'time_end' => $row['time_end'],
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
        <a href="index.php" class="btn">Back</a>
        <h1>SPCB AVR Event List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Book Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Event Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedule_list as $schedule): ?>
                    <!-- <?php echo $schedule[0] ?> -->
                    <tr>
                        <td><?php echo $schedule['id'] ?></td>
                        <td><?php echo $schedule['day_of_week'] ?></td>
                        <td><?php echo date('M d, Y', strtotime($schedule["rent_start_date"])); ?></td>
                        <td><?php echo date('h:i A', strtotime($schedule["time_start"])); ?></td>
                        <td><?php echo date('h:i A', strtotime($schedule["time_end"])); ?></td>
                        <td><?php echo $schedule['event_name'] ?></td>
                        <td class="actions">
                            <a href="approve.php?id=<?= $schedule['id'] ?>&prof_id=<?php echo $id  ?>" onclick="return confirm('Are you sure you want to Approve this schedule?')">Approve</a>
                            <a href="decline.php?id=<?= $schedule['id'] ?>&prof_id=<?php echo $id  ?>" onclick="return confirm('Are you sure you want to Decline this schedule?')">Decline</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>