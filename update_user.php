<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
}
$user_id = $_SESSION['user_id'];
include_once 'connect.php';

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$username=$_POST['username'];
$dob=$_POST['dob'];
$email=$_POST['email'];

$query = "Update users set user_first_name='$fname',user_last_name = '$lname',user_name= '$username',user_email= '$email',user_date_of_birth='$dob' Where user_id = '$user_id';";
if($conn->query($query)){
header("location: profile.php");

}else{
    echo $conn->error;
}



?>