<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();

$src = $_GET['src'] ?? '';

?>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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

              <li> <a href="clientview.php">Schedules</a></li>
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
} else if (isset($_SESSION['login_customer'])) {
    ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="customer_index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li> <a href="mybookings.php"> Pending Bookings</a></li>
                    <li> <a href="mybookings.php"> Booking History</a></li>

                    <li> <a href="prereturncar.php">Return My Car</a></li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
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
                                <li>
                                    <a href="customersignup.php">Sign Up</a>
                                </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php }
?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
      <div class="jumbotron">
      </div>
    </div>

    <div style="text-align:center">
        <img src="<?php echo $src; ?>" alt="" width="500" height="500">
    </div>

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