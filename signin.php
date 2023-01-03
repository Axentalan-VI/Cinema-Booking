<?php include_once "connect.php";
session_start();





$SIGNINEMAIL = $_POST['signinmail'];
$SIGNINPASSWORD = $_POST['signinpwd'];




$query2 = "SELECT * FROM users WHERE user_email = '$SIGNINEMAIL' AND user_password = '$SIGNINPASSWORD'";
$sqlconnection2 = $conn->query($query2);
if ($sqlconnection2->num_rows > 0) {
    $row = $sqlconnection2->fetch_assoc();
    $_SESSION['user_id'] = $row['user_id'];
    header("location: index.php");
} else {
    header("location: Login.php");
}





?>