<?php include_once "connect.php";
session_start();


class user
{
    public $user_id;
    public $user_email;
    public $user_password;
    public $user_first_name;
    public $user_last_name;
    public $user_birthdate;



    function __construct($user_id, $user_email, $user_password, $user_first_name, $user_last_name, $user_birthdate)
    {
        $this->$user_id = $user_id;
        $this->$user_email = $user_email;
        $this->$user_password = $user_password;
        $this->$user_first_name = $user_first_name;
        $this->$user_last_name = $user_last_name;
        $this->$user_birthdate = $user_birthdate;
    }
}



//Create Account/Sign up

$FIRSTNAME = $_POST['FirstName'];
$LASTNAME = $_POST['LastName'];
$EMAIL = $_POST['SignUpEmail'];
$PASSWORD = $_POST['pwd'];
$DOB = $_POST['birthdate'];



$query = "INSERT INTO users (user_email, user_password,user_first_name,user_last_name,user_date_of_birth) VALUES ('$EMAIL','$PASSWORD','$FIRSTNAME','$LASTNAME','$DOB');";

if($conn->query($query)){
    $query="select user_id from users where user_email='$EMAIL' and user_password='$PASSWORD' and user_first_name='$FIRSTNAME' and user_last_name='$LASTNAME' and user_date_of_birth='$DOB'";
    $result = $conn->query($query);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        header("location: index.php");
       
    }


}



?>

