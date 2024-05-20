<?php
session_start();
require 'connection.php';
$conn = Connect();

if (isset($_SESSION['login_customer'])) {
    header("location: customer_index.php"); //Redirecting
} else if (isset($_SESSION['login_client'])) {
    header("location: index.php"); //Redirecting
} else if (isset($_SESSION['login_secretary'])) {
    header("location: secretary/index.php"); //Redirecting
} else if (isset($_SESSION['login_depthead'])) {
    header("location: depthead/index.php"); //Redirecting
} else if (isset($_SESSION['login_prof'])) {
    header("location: prof/index.php"); //Redirecting
} else if (isset($_SESSION['login_dean'])) {
    header("location: dean/index.php"); //Redirecting
}

?>