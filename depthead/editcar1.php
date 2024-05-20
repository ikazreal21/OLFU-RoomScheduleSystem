<!DOCTYPE html>
<html>
<?php
session_start();

if (isset($_SESSION['login_customer'])) {
    header("location: ../customer_index.php"); //Redirecting
} else if (isset($_SESSION['login_client'])) {
    header("location: ../index.php"); //Redirecting
} else if (isset($_SESSION['login_secretary'])) {
    header("location: ../secretary/index.php"); //Redirecting
} else if (isset($_SESSION['login_depthead'])) {
    // header("location: ../depthead/index.php"); //Redirecting
} else if (isset($_SESSION['login_prof'])) {
    header("location: ../prof/index.php"); //Redirecting
} else if (isset($_SESSION['login_dean'])) {
    header("location: ../dean/index.php"); //Redirecting
}

?>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="../assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="../assets/css/customerlogin.css">
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../assets/css/clientpage.css" />
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: green">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   OLFU | CCS </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#">Welcome <?php echo $_SESSION['login_depthead']; ?></a>
                    </li>
                    <li>
                        <a href="addroom.php">Add Rooms</a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php

require '../connection.php';
$conn = Connect();


$car_name = $conn->real_escape_string($_POST['car_name']);
$car_nameplate = $conn->real_escape_string($_POST['car_nameplate']);
$car_fare = $conn->real_escape_string($_POST['car_fare']);
$car_id = $conn->real_escape_string($_POST['car_id']);

// $query = "INSERT into cars(car_name,car_nameplate,ac_price,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $car_availability ."')";
// $success = $conn->query($query);

if (isset($_POST['submit'])) {

        $query = "UPDATE room SET car_name = '$car_name', car_nameplate = '$car_nameplate', car_fare = '$car_fare' WHERE car_id = '$car_id'";
        $success = $conn->query($query);
}

// Taking car_id from cars

// $query1 = "SELECT car_id from cars where car_nameplate = '$car_nameplate'";

// $result = mysqli_query($conn, $query1);
// $rs = mysqli_fetch_array($result, MYSQLI_BOTH);
// $car_id = $rs['car_id'];

// $query2 = "INSERT into clientcars(car_id,client_username) values('" . $car_id . "','admin')";
// $success2 = $conn->query($query2);

if (!$success) {?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        Room with the same Room number already exists!
        <?php echo $conn->error; ?>
        <br><br>
        <a href="addroom.php" class="btn btn-default"> Go Back </a>
</div>
<?php
} else {
    header("location: addroom.php"); //Redirecting
}

$conn->close();

?>

    </body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> OLFU</h5>
                </div>
            </div>
        </div>
</footer>
</html>