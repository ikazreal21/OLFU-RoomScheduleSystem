<?php

session_start();
require '../connection.php';
$conn = Connect();

$id = $_GET['id'] ?? 0;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

$sql = "SELECT * from room";
$result = $conn->query($sql);
$result = $result->fetch_all(MYSQLI_ASSOC);


$sql = "SELECT * from users where role = 'faculty' and user_id = $id";
$result2 = $conn->query($sql);
$result2 = $result2->fetch_all(MYSQLI_ASSOC);
// echo '<pre>';
// var_dump($result2);
// echo '</pre>';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    $room = $_POST['room'];
    $duration = $_POST['duration'];
    $online = isset($_POST['online']) ? true : false;
    $prof_id = $result2[0]['id'];
    $prof_name = $result2[0]['customer_name'];

    
    $sql = "SELECT * from room where car_id = $room";
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $room_name = $result[0]['car_name'] . ' - ' . $result[0]['car_nameplate'];

    $sql = "SELECT * from prof_schedule where prof_id = $id and day_of_week = '$day' and time = '$time'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "Schedule already exists";

        $sql = "SELECT * from room";
        $result = $conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);

    } else {
        $sql = "INSERT INTO prof_schedule (room_id, prof_id, prof_name, subject_name, room, day_of_week, time, duration, is_online) VALUES ('$room', '$prof_id', '$prof_name', '$subject', '$room_name', '$day', '$time', $duration,'$online')";

        
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: schedule.php?id=$id");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h1>Add Schedule</h1>
        <?php if ($message): ?>
        <p><?php echo $message ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="day">Day:</label>
            <select id="day" name="day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
            <label for="time">Time:</label>
            <select id="time" name="time" required>
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
            <input type="text" id="subject" name="subject" required>
            <label for="room">Room:</label>
            <select id="room" name="room" required>
                <?php foreach ($result as $room): ?>
                    <option value="<?= $room['car_id'] ?>"><?= $room['car_name'] ?> - <?= $room['car_nameplate'] ?></option>
                <?php endforeach; ?>
            </select>
            <label for="duration">Duration (hours):</label>
            <input type="number" id="duration" name="duration" min="2" required>
            <label for="online">Online:</label>
            <input type="checkbox" id="online" name="online">
            <button type="submit" class="btn">Add Schedule</button>
        </form>
    </div>
</body>
</html>