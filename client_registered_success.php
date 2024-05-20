<html>

  <head>
    <title> Admin Signup | OLFU </title>
</head>

  <link rel="stylesheet" type = "text/css" href ="assets/css/manager_registered_success.css">
  <link rel="stylesheet" type = "text/css" href ="assets/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <body>

  <!--Back to top button..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  <!--Javacript for back to top button....................................................................-->
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

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
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="addroom.php">Add Room</a></li>

              <li> <a href="pending_bookings_admin.php">Pending Schedules</a></li>
              <li> <a href="pending_users.php">Pending Users</a></li>
              <li> <a href="all_users.php">Users</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
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
                    <li> <a href="pending_bookings.php"> Pending Bookings</a></li>
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

<?php

require 'connection.php';
$conn = Connect();

$client_name = $conn->real_escape_string($_POST['client_name']);
$client_username = $conn->real_escape_string($_POST['client_username']);
$client_email = $conn->real_escape_string($_POST['client_email']);
$client_phone = $conn->real_escape_string($_POST['client_phone']);
$client_address = $conn->real_escape_string($_POST['client_address']);
$client_password = $conn->real_escape_string($_POST['client_password']);

$query = "INSERT into clients(client_name,client_username,client_email,client_phone,client_address,client_password) VALUES('" . $client_name . "','" . $client_username . "','" . $client_email . "','" . $client_phone . "','" . $client_address . "','" . $client_password . "')";
$success = $conn->query($query);

if (!$success) {
    die("Couldnt enter data: " . $conn->error);
}

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Welcome $client_name!" ?> </h2>
		<h1>Your account has been created.</h1>
		<p>Login Now from <a href="clientlogin.php">HERE</a></p>
	</div>
</div>

    </body>
    <footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> Axl Rentals</h5>
            </div>
        </div>
    </div>
</footer>
</html>