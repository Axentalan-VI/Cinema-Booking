<?php
include_once 'connect.php';

$id=$_GET['id'];

$query = "Delete From Reservation Where reservation_id = $id;";
if($conn->query($query)){
    header("location: profile.php");
}
else{
    echo "somting went wrong";
    header("loction:profile.php");

}

?>