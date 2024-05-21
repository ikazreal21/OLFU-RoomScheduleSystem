<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
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
                        <a href="#"> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                <li> <a href="addroom.php">ADD ROOM</a></li>
              <li> <a href="clientview.php">SCHEDULE LIST</a></li>
              <li> <a href="pending_bookings_admin.php">PENDING SCHEDULES</a></li>
              <li> <a href="pending_users.php">PENDING USERS</a></li>
              <li> <a href="all_users.php">USERS</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"> Logout</a>
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


    <div class="container">
        </div>
    </div>

    <div class="container" style="margin-top: 1rem; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
               <center> <div class="panel-css"> Create Account </div> </center>
                <div class="panel-body">

                    <form role="form" action="customer_registered_success_admin.php" enctype="multipart/form-data" method="POST" >

                      <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_name"><span class="text-danger" style="margin-right: 5px;">*</span> Full Name: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_name" type="text" name="customer_name" placeholder="Your Full Name" required="" autofocus="">
                                    <span class="input-group-btn">
             
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row" >
                            <div class="form-group col-xs-12">
                                <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Your Username" required="">
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_email"><span class="text-danger" style="margin-right: 5px;">*</span> Email: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_email" type="email" name="customer_email" placeholder="Email" required="">
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_phone"><span class="text-danger" style="margin-right: 5px;">*</span> Phone: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_phone" type="text" name="customer_phone" placeholder="Phone" required="">
                                    <span class="input-group-btn">
                             

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_address" type="text" name="customer_address" placeholder="Address" required="">
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Password" required>
                                    <span class="input-group-btn">
                                    </span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span> Upload ID: </label>
                                <div class="input-group">
                                    <input class="form-control" id="uploadedimage" type="file" name="uploadedimage" placeholder="Your ID" required>
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="role"><span class="text-danger" style="margin-right: 5px;">*</span> Role: </label>
                                <div class="input-group">
                                    <select class="form-control" id="time" name="role" required>
                                            <option value="depthead">Department Head</option>
                                            <option value="dean">Dean</option>
                                            <option value="secretary">Secretary</option>
                                            <option value="faculty">Faculty</option>
                                    </select>
                                    <span class="input-group-btn">
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xs-4">
                          <button class="btn-css" type="submit">Submit</button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
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