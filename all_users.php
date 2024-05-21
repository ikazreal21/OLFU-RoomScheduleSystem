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



<?php $login_client = $_SESSION['login_client'];

$sql1 = "SELECT * FROM users WHERE status = 'approve'";

$result1 = $conn->query($sql1);

// echo '<pre>';
// var_dump(mysqli_fetch_assoc($result1));
// echo '<pre>';

if (mysqli_num_rows($result1) > 0) {
    ?>

<div class="container">
      <div class="jumbotron">
        <h1 class="text-center">Users</h1>
      </div>
<a href="create_user_admin.php" class="btn btn-success">Add User</a>

</div>

    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="20%">Username</th>
<th width="15%">Name</th>
<th width="15%">Phone</th>
<th width="15%">Email</th>
<th width="15%">Address</th>
<th width="15%">ID </th>
<!-- <th width="15%">Actions</th> -->
</tr>
</thead>
<?php
while ($row = mysqli_fetch_assoc($result1)) {
        ?>
<tr>
<td><?php echo $row["customer_username"]; ?></td>
<td><?php echo $row["customer_name"]; ?></td>
<td><?php echo $row["customer_phone"] ?></td>
<td><?php echo $row["customer_email"] ?></td>
<td><?php echo $row["customer_address"] ?></td>
<td>
    <a href="view_pictures.php?src=<?php echo $row["id_image"]; ?>"> View ID </a></td>
    <!-- <td>
        <a href="approve_user.php?id=<?php echo $row["customer_username"]; ?>"> Approve </a>
        <a href="decline_user.php?id=<?php echo $row["customer_username"]; ?>"> Decline </a>
    </td> -->
</tr>
<?php }?>
                </table>
                </div>
        <?php } else {
    ?>
        <div class="container">
      <div class="jumbotron">
        <h1>No Users</h1>
        <p><?php echo $conn->error; ?> </p>
      </div>
    </div>

            <?php
}?>

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