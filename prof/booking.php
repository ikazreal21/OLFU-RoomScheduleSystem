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
                    <li> <a href="../schedule/schedule.php?id=<?php echo $_SESSION['login_prof_id'] ?>"> View Schedule</a>
                </li>
                    <li> <a href="pending_bookings.php"> Pending Schedules</a></li>
                    <li> <a href="mybookings.php"> Schedule History</a></li>
                    <li>
                        <a href="../logout.php"> Logout</a>
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


<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" enctype="multipart/form-data" method="POST">
        <br style="clear: both">
          <br>

        <?php
            $car_id = $_GET["id"];
            $sql1 = "SELECT * FROM room WHERE car_id = '$car_id'";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $car_name = $row1["car_name"];
                    $car_nameplate = $row1["car_nameplate"];
                    $car_fare = $row1["car_fare"];
                }
            }

        ?>
          <!-- <div class="form-group"> -->
              <h5> Selected Room:&nbsp;  <b><?php echo ($car_name); ?></b></h5>
         <!-- </div> -->

          <!-- <div class="form-group"> -->
            <h5> Room Number:&nbsp;<b> <?php echo ($car_nameplate); ?></b></h5>
            <h5> Course:&nbsp;<b> <?php echo ($car_fare); ?></b></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d")?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo ($today); ?>" required="">
            <br>
          <br>
        <?php $today = date("h:i:sa")?>
          <label><h5>Start Date:</h5></label>
            <select id="time" name="time_start" required>
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
            <br>
          <label><h5>Duration:</h5></label>
          <input type="number" name="time_end" min="2" required>
          <br>
          <?php if ($car_nameplate == "AVR"): ?>
          <label><h5>Event Name:</h5></label>
          <br>
          <textarea name="event_name" id="" rows="5" style="width: 561px; height: 121px;"></textarea>
          <br>
          <br>
          <?php endif; ?>
          <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">

           <input type="submit"name="submit" value="Submit">
        </form>

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