<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['customer_username']) || empty($_POST['customer_password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$customer_username=$_POST['customer_username'];
$customer_password=$_POST['customer_password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT * FROM users WHERE customer_username='$customer_username' AND customer_password='$customer_password' LIMIT 1";

// To protect MySQL injection for Security purpose
// $stmt2 = $conn->prepare($query);
// $stmt2 -> bind_param("ss", $customer_username, $customer_password);
// $stmt2 -> execute();
// $stmt2 -> bind_result($customer_username, $customer_password);
// $stmt2 -> store_result();
// $stmt2->fetch();
$stmt2 = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($stmt2);


// echo '<pre>';
// var_dump($row);
// echo '<pre>';

if (mysqli_num_rows($stmt2) == 1) 
{
	
	if ($row['role'] == "admin") {
		$_SESSION['login_client']=$customer_username;
		header("Location:index.php");
		exit();
	}	
	else if($row['role'] == "customer") {
		$_SESSION['login_customer']=$customer_username;
		header("Location:customer_index.php");
		exit();
	} else if ($row['role'] == "secretary") {
		$_SESSION['login_secretary']=$customer_username;
		header("Location:secretary/index.php");
		exit();
	} else if ($row['role'] == "depthead") {
		$_SESSION['login_depthead']=$customer_username;
		header("Location:depthead/index.php");
		exit();
	} else if ($row['role'] == "faculty") {
		$_SESSION['login_prof']=$customer_username;
		$_SESSION['login_prof_id']=$row['user_id'];
		header("Location:prof/index.php");
		exit();
	} else if ($row['role'] == "dean") {
		$_SESSION['login_dean']=$customer_username;
		header("Location:dean/index.php");
		exit();
	}

} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>