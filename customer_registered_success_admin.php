<?php

require 'connection.php';
$conn = Connect();

function GetImageExtension($imagetype)
{
    if (empty($imagetype)) {
        return false;
    }

    switch ($imagetype) {
        case 'assets/img/users_id/bmp':return '.bmp';
        case 'assets/img/users_id/gif':return '.gif';
        case 'assets/img/users_id/jpeg':return '.jpg';
        case 'assets/img/users_id/png':return '.png';
        default:return false;
    }
}

$customer_name = $conn->real_escape_string($_POST['customer_name']);
$customer_username = $conn->real_escape_string($_POST['customer_username']);
$customer_email = $conn->real_escape_string($_POST['customer_email']);
$customer_phone = $conn->real_escape_string($_POST['customer_phone']);
$customer_address = $conn->real_escape_string($_POST['customer_address']);
$customer_password = $conn->real_escape_string($_POST['customer_password']);
$role = $conn->real_escape_string($_POST['role']);
$status = "approve";

if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name = $_FILES["uploadedimage"]["name"];
    $temp_name = $_FILES["uploadedimage"]["tmp_name"];
    $imgtype = $_FILES["uploadedimage"]["type"];
    $ext = GetImageExtension($imgtype);
    $imagename = $_FILES["uploadedimage"]["name"];
    $target_path = "assets/img/users_id/" . $imagename;

    if (move_uploaded_file($temp_name, $target_path)) {

        $query = "INSERT into users(customer_name,customer_username,customer_email,customer_phone,customer_address,customer_password,status,id_image,role) VALUES('" . $customer_name . "','" . $customer_username . "','" . $customer_email . "','" . $customer_phone . "','" . $customer_address . "','" . $customer_password . "','" . $status . "','" . $target_path . "','" . $role . "')";
        $success = $conn->query($query);
    }
}

if (!$success) {
    die("Couldnt enter data: " . $conn->error);
} else {
    echo "<script> alert('User has been added successfully') </script>";
    header("refresh:1;url=all_users.php");
}

$conn->close();

?>
