<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
}
$user_id = $_SESSION['user_id'];
include "connect.php";

$num_seats=$_POST['numseats'];
$seats_id=$_POST['seats'];
$movie_id=$_POST['movieid'];
$showtime_id=$_POST['showtimeid'];
$price=$_POST['price'];

$query = "INSERT INTO Reservation (seats_id,num_of_seats,theater_id,showtime_id,user_id,total_price) VALUES ('$seats_id',$num_seats,$movie_id,$showtime_id,$user_id,$price)";



if ($conn->query($query)) {
    echo "Tickets Have been bought successfully";
} else {
    echo $conn->error;
}


?>
