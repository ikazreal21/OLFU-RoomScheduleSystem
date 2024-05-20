<!DOCTYPE html>
<html>

<?php
include 'session_client.php';?>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body>

      <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   CCS | ROOMS </a>
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
                        <a href="#"> <?php echo $_SESSION['login_client']; ?></a>
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
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li>
                        <a href="#">History</a>
                    </li>
                    <li>
                        <a href="logout.php"> Logout</a>
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

    <div class="container" style="margin-top: 65px;" >
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area" style="height: 23rem;">
                <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                <br style="clear: both">
                <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Provide Room Details. </h3>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Building Name" required autofocus="">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Room Number" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="car_fare" name="car_fare" placeholder="Course" required>
                </div>

                <div class="form-group">
                    <input name="uploadedimage" type="file">
                </div>
                <button type="submit" id="submit" name="submit" class="btn btn-success pull-right" style="margin-top:1rem;"> Submit for Schedule</button>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-12" style="float: none; margin: 0 auto;">
    <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Rooms </h3>
<?php
// Storing Session
$user_check = $_SESSION['login_client'];
$sql = "SELECT * FROM room";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
<div style="overflow-x:auto;">
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th width="40%"> Name</th>
        <th width="35%"> Room Number </th>
        <th width="20%"> Course </th>
        <th width="20%"> Edit </th>
      </tr>
    </thead>

    <?PHP
//OUTPUT DATA OF EACH ROW
    while ($row = mysqli_fetch_assoc($result)) {
        ?>

  <tbody>
    <tr>
      <td><?php echo $row["car_name"]; ?></td>
      <td><?php echo $row["car_nameplate"]; ?></td>
      <td><?php echo $row["car_fare"]; ?></td>
      <td><a href="editroom.php?id=<?php echo $row["car_id"]; ?>" class="btn btn-primary">Edit</a></td>
    </tr>
  </tbody>
  <?php }?>
  </table>
  </div>
    <br>
  <?php } else {?>
  <h4><center>NO ROOMS AVAILABLE</center> </h4>
  <?php }?>
        </form>
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