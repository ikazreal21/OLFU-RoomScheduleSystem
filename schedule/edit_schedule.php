<?php

session_start();
require '../connection.php';
$conn = Connect();

$id = $_GET['id'] ?? 0;
$prof_id = $_GET['prof_id'] ?? 0;

// if ($id == 0) {
//     echo 'Invalid ID';
//     exit;
// }

$sql = "SELECT * from room";
$result1 = $conn->query($sql);
$result1 = $result1->fetch_all(MYSQLI_ASSOC);

$schedule = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    $room = $_POST['room'];
    $duration = $_POST['duration'];
    $online = isset($_POST['online']) ? true : false;

    $sql = "UPDATE prof_schedule SET day_of_week='$day', time='$time', subject_name='$subject', room='$room', duration=$duration, is_online='$online' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: schedule.php?id=$prof_id");
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $sql = "SELECT *, TIME_FORMAT(time, '%h:%i %p') AS time FROM prof_schedule WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $schedule = $result->fetch_assoc();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h1>Edit Schedule</h1>
        <?php if ($schedule): ?>
            <form method="post" action="">
                <label for="day">Day:</label>
                <select id="day" name="day">
                    <option selected value="<?php echo $schedule['day_of_week'] ?>"><?php echo $schedule['day_of_week'] ?></option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
                <label for="time">Time:</label>
                <select id="time" name="time" required>
                    <option selected value="<?php echo $schedule['time'] ?>"><?php echo $schedule['time'] ?></option>
                    <option value="08:00">08:00 AM</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 AM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                    <option value="17:00">05:00 PM</option>
                    <option value="18:00">06:00 PM</option>
                    <option value="19:00">07:00 PM</option>
                    <option value="20:00">08:00 PM</option>
                </select>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?php echo $schedule['subject_name'] ?>" required>
                <label for="room">Room:</label>
                <select id="room" name="room" required>
                    <option selected value="<?php echo $schedule['room'] ?>"><?php echo $schedule['room'] ?></option>
                    <?php foreach ($result1 as $room): ?>
                        <option value="<?= $room['car_name'] ?> - <?= $room['car_nameplate'] ?>"><?= $room['car_name'] ?> - <?= $room['car_nameplate'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="duration">Duration (hours):</label>
                <input type="number" id="duration" name="duration" min="2" value="<?php echo $schedule['duration'] ?>" required>
                <label for="online">Online:</label>
                <?php if ($schedule['is_online'] == true): ?>
                    <input type="checkbox" id="online" name="online" checked>
                <?php else: ?>
                    <input type="checkbox" id="online" name="online">
                <?php endif; ?>
                <button type="submit" class="btn">Update Schedule</button>
            </form>
        <?php else: ?>
            <p>Schedule not found</p>
        <?php endif; ?>
    </div>
</body>
</html>