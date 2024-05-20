<!DOCTYPE html>
<html>

<?php
session_start();
require '../connection.php';
$conn = Connect();

if (isset($_SESSION['login_customer'])) {
    header("location: ../customer_index.php"); //Redirecting
} else if (isset($_SESSION['login_client'])) {
    header("location: ../index.php"); //Redirecting
} else if (isset($_SESSION['login_secretary'])) {
    header("location: ../secretary/index.php"); //Redirecting
} else if (isset($_SESSION['login_depthead'])) {
    header("location: ../depthead/index.php"); //Redirecting
} else if (isset($_SESSION['login_prof'])) {
    // header("location: ../prof/index.php"); //Redirecting
} else if (isset($_SESSION['login_dean'])) {
    header("location: ../dean/index.php"); //Redirecting
}

if (!isset($_SESSION['login_prof'])) {
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/img/P.png.png">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/w3css/w3.css">
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bookingconfirm.css" />
</head>

<body>

<?php

function GetImageExtension($imagetype)
{
    if (empty($imagetype)) {
        return false;
    }

    switch ($imagetype) {
        case '../assets/img/reciept_image/bmp':return '.bmp';
        case '../assets/img/reciept_image/gif':return '.gif';
        case '../assets/img/reciept_image/jpeg':return '.jpg';
        case '../assets/img/reciept_image/png':return '.png';
        default:return false;
    }
}

$customer_username = $_SESSION["login_prof"];
$car_id = $conn->real_escape_string($_POST['hidden_carid']);
$rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
$day = date('l', strtotime($_POST['rent_start_date']));
// $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
$time_start = $_POST['time_start'];
$time_end =  $_POST['time_end'];

$timestamp = strtotime($time_start);

// Add the hours (in seconds)
$newTimestamp = $timestamp + (2 * 3600);

// Convert the new timestamp back to a formatted time string
$newTime = date('H:i:s', $newTimestamp);

$booking_status = "pending";

$error = "";

// function dateDiff($start, $end)
// {
//     $start_ts = strtotime($start);
//     $end_ts = strtotime($end);
//     $diff = $end_ts - $start_ts;
//     return round($diff / 86400);
// }

// $err_date = dateDiff("$rent_start_date", "$rent_end_date");

$sql0 = "SELECT * FROM room WHERE car_id = '$car_id'";
$result0 = $conn->query($sql0);

if (mysqli_num_rows($result0) > 0) {
    while ($row0 = mysqli_fetch_assoc($result0)) {
        $fare = $row0["car_fare"];
    }
}

$sql0 = "SELECT * FROM prof_schedule WHERE day_of_week = '$day' and time = '$time_start' and time = '$newTime' and room_id = '$car_id'";
$result1 = $conn->query($sql0);

// echo '<pre>';
// var_dump($result1);
// echo '<pre>';

if (mysqli_num_rows($result1) > 0) {
    $error = "Room is already booked on this day and time. Please select another day or time.";
}


if (empty($error)) {
    $sql1 = "INSERT into schedules(customer_username,car_id,booking_date,rent_start_date,day_of_week,time_start,time_end,booking_status)
    VALUES('" . $customer_username . "','" . $car_id . "','" . date("Y-m-d") . "','" . $rent_start_date . "','" . $day . "','" . $time_start . "','" . $newTime . "','". $booking_status . "')";
    $result1 = $conn->query($sql1);
        
} else {
    echo "<script>alert('This Room is used for lecture booked on this day and time. Please select another day or time.')</script>";
    header("refresh:1;url=booking.php?id=$car_id");
    exit();
}

    // echo '<pre>';
    // var_dump($result1);
    // echo '<pre>';

    // echo '<pre>';
    // var_dump($result2);
    // echo '<pre>';
    // $sql3 = "UPDATE driver SET driver_availability = 'no' WHERE driver_id = '$driver_id'";
    // $result3 = $conn->query($sql3);

    $sql4 = "SELECT * FROM  room c, users cl, schedules rc WHERE c.car_id = '$car_id' AND cl.customer_username = rc.customer_username";
    $result4 = $conn->query($sql4);

    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            $id = $row["user_id"];
            $car_name = $row["car_name"];
            $car_nameplate = $row["car_nameplate"];
            // $driver_name = $row["driver_name"];
            // $driver_gender = $row["driver_gender"];
            // $dl_number = $row["dl_number"];
            // $driver_phone = $row["driver_phone"];
            // $client_name = $row["client_name"];
            // $client_phone = $row["client_phone"];
        }
    }

    if (!$result1) {
        die("Couldnt enter data: " . $conn->error);
    }

    ?>
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   OLFU | CCS </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="customer_index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"></span> Welcome <?php echo $_SESSION['login_prof']; ?></a>
                    </li>
                    <li> <a href="pending_bookings.php"> Pending Schedules</a></li>
                    <li> <a href="mybookings.php"> Schedule History</a></li>

                    <li>
                        <a href="logout.php"></span> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <div class="jumbotron">
         <h1 class="text-center" style="color: green;"></span> Schedule Request on Pending.</h1>
        </div>
    </div>
    <br>






    <div class="container">
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Your schedule has been received and placed into review processing system and wait for Approval check Pending Tab for Infomation.</h3>
                <br>
                <br>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Room Name: </strong> <?php echo $car_name; ?></h4>
                <br>
                <h4> <strong>Room Number:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo date('M d, Y', strtotime($rent_start_date)); ?></h4>
                <br>
                <br>
                <h4> <strong>Time Start: </strong> <?php echo date('h:i a', strtotime($time_start)); ?></h4>
                 <br>
                 <h4> <strong>Time End: </strong> <?php echo date('h:i a', strtotime($newTime)); ?></h4>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
        </div>
    </div>
</body>
    <!-- <div class="container">
        <div class="jumbotron" style="text-align: center;">
            You have selected an incorrect date.
            <br><br>
        </div>
    </div> -->
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> OLFU | CCS</h5>
            </div>
        </div>
    </div>
</footer>

</html>