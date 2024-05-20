<?php
include 'session_customer.php';

$price = $_GET["price"] ?? '';

$sql1 = "SELECT * FROM room WHERE car_id";
$result1 = mysqli_query($conn, $sql1);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLFU-CCS Admin Homepage</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="">
                   OLFU | CCS </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="customer_index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li> <a href="pending_bookings.php"> Pending Schedules</a></li>
                    <li> <a href="mybookings.php"> Schedule History</a></li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">

        <h3 style="text-align:center;">ROOMS</h3>
        <form action="" method="get">
        <div class="row">
            
                </select>
            </div>
            <div class="form-group col-md-3">
             
            </div>
        </div>

        </form>
    <br>
        <section class="menu-content">
        <?php

        if($status_customer == 'approve') {
            if ($price == "<") {
                $sql1 = "SELECT * FROM room WHERE car_id";
            } else if ($price == ">") {
                $sql1 = "SELECT * FROM room WHERE car_id";
            } else {
                $sql1 = "SELECT * FROM room WHERE car_id";
            }

            $result1 = mysqli_query($conn, $sql1);

            // echo '<pre>';
            // var_dump($sql1);
            // echo '<pre>';

            // echo '<pre>';
            // var_dump($result1);
            // echo '<pre>';

            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $car_id = $row1["car_id"];
                    $car_name = $row1["car_name"];
                    $car_img = $row1["car_img"];
                    $fare = $row1["car_fare"];
                    $car_nameplate = $row1["car_nameplate"];


                    ?>
                        <a href="booking.php?id=<?php echo ($car_id) ?>">
                        <div class="sub-menu">


                        <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image cap">
                        <h5><b> <?php echo $car_name; ?> </b></h5>
                        <h5><b> <?php echo $car_nameplate; ?> </b></h5>

                


                        </div>
                        </a>
                        <?php }} else {
            ?>
            <h1> NO ROOMS AVAILABLE </h1>
                            <?php
            }
        } else if ($status_customer == 'decline') {
            echo "<h1> Your Account Has Been Decline Contact Admin for More Details axl@gmail.com </h1>";
        } else {
            echo "<h1> Your Account is Under Review </h1>";
        }
        ?>
        </section>

    </div>

    <!-- <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
    </div> -->


    <!-- Container (Contact Section) -->
    <!-- -->
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>