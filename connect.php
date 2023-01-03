<?php
$conn=@new mysqli("localhost","root","", "MovieCinema");
if($conn->connect_errno > 0){
    echo "fail to connect...";
    echo $conn->connect_error;
    exit();
}


?>
