<?php
include "connect.php";
$today= date("Y-m-d");
$tomorrow= date("Y-m-d", strtotime("+1 days"));
$after_tomorrow= date("Y-m-d", strtotime("+2 days"));
$yesterday = date("Y-m-d", strtotime("-1 days"));


$update = "UPDATE Showtime set showtime_date='$after_tomorrow' WHERE showtime_date = '$tomorrow'";
if ($conn->query($update)) {
    echo "done 2";
}
$update = "UPDATE Showtime set showtime_date='$tomorrow' WHERE showtime_date = '$today'";
if ($conn->query($update)) {
    echo "done 3";
}
$update = "UPDATE Showtime set showtime_date='$today' WHERE showtime_date = '$yesterday'";
if($conn->query($update)){
    echo "done 1";
}



$conn->close();
?>