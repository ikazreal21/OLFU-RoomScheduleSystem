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

} else if (isset($_SESSION['login_depthead'])) {
    header("location: ../depthead/index.php"); //Redirecting
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
                        <a href="#">Welcome <?php echo $_SESSION['login_secretary']; ?></a>
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

    <?php $login_client = $_SESSION['login_secretary'];

$sql1 = "SELECT * FROM users WHERE role = 'faculty' and status = 'approve'";

$result1 = $conn->query($sql1);

// echo '<pre>';
// var_dump(mysqli_fetch_assoc($result1));
// echo '<pre>';

if (mysqli_num_rows($result1) > 0) {
    ?>
<div class="container">
      <div class="jumbotron">
        <h1 class="text-center">Faculty</h1>
      </div>
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
<th width="15%">View Schedule</th>
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
    <a href="../schedule/schedule.php?id=<?php echo $row["user_id"] ?>"> View Schedule </a></td>
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