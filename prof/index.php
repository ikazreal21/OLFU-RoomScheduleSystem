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
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLFU</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/user.css">
    <link rel="stylesheet" href="../assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
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

            <?php
if (isset($_SESSION['login_client'])) {
    ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#">Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="addroom.php">Add Room</a></li>
             

              <li> <a href="clientview.php">schedule list</a></li>
              <li> <a href="pending_bookings_admin.php">Pending Schedules</a></li>
              <li> <a href="pending_users.php">Pending Users</a></li>
              <li> <a href="all_users.php">Users</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <?php
} else if (isset($_SESSION['login_prof'])) {
    ?>
                        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"> Welcome <?php echo $_SESSION['login_prof']; ?></a>
                    </li>
                    <li> <a href="../schedule/schedule.php?id=<?php echo $_SESSION['login_prof_id'] ?>"> View Schedule</a></li>
                    <li> <a href="pending_bookings.php"> Pending Schedules</a></li>
                    <li> <a href="mybookings.php"> Schedule History</a></li>
                    <li>
                        <a href="../logout.php"> Logout</a>
                    </li>
</li>
                </ul>
            </div>

            <?php
} else {
    ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Login</a>
                    </li>
                </ul>
            </div>
                <?php }
?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: green">OLFU-CCS</h1>
                            <p class="intro-text">
                            </p>
                            <a href="#sec2" class="btn btn-circle page-scroll blink">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Rooms</h3>
<br>
        <section class="menu-content">
            <?php
$sql1 = "SELECT * FROM room WHERE car_id";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $car_id = $row1["car_id"];
        $car_name = $row1["car_name"];
        $car_nameplate = $row1["car_nameplate"];
        $car_img = $row1["car_img"];
        $fare = $row1["car_fare"];


        ?>
            <a href="booking.php?id=<?php echo ($car_id) ?>">
            <div class="sub-menu">


            <img class="card-img-top" src="../<?php echo $car_img; ?>" alt="Card image cap">
            <h5><b> <?php echo $car_name; ?> </b></h5>
            <h5><b> <?php echo $car_nameplate; ?> </b></h5>


            </div>
            </a>
            <?php }} else {
    ?>
<h1> NO ROOMS SCHEDULED </h1>
                <?php
}
?>
        </section>

    </div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCuoe93lQkgRaC7FB8fMOr_g1dmMRwKng&callback=myMap" type="text/javascript"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="../assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>

</html>