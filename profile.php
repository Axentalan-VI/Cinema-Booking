<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
}
$user_id = $_SESSION['user_id'];


include_once 'connect.php';





$query = "Select * from users Where user_id = $user_id;";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row['user_first_name'];
    $lname = $row['user_last_name'];
    $email = $row['user_email'];
    $dob = $row['user_date_of_birth'];
} else {
    echo "0 results";
}

class  Ticket
{

    public $seats_id;
    public $booking_id;
    public $total;
    public $theater_id;
    public $showtime_id;
    public $movie_title;
    public $showtime_date;
    public $showtime_hour;
}

$query = "Select * from Reservation Where user_id =  $user_id;";
$result = $conn->query($query);
$flag = $conn->query($query)->num_rows > 0;

$tickets = array();



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ticket = new Ticket();
        $ticket->seats_id = $row['seats_id'];
        $ticket->booking_id = $row['reservation_id'];
        $ticket->total = $row['total_price'];
        $ticket->theater_id = $row['theater_id'];
        $ticket->showtime_id = $row['showtime_id'];
        array_push($tickets, $ticket);
    }
} else {
    echo "0 results";
}

foreach ($tickets as $t) {

    $query = "Select movie_title from Movies Where movie_theater_num = $t->theater_id ;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $t->movie_title = $row['movie_title'];
    }
    $query = "Select showtime_date,showtime_hour from Showtime Where showtime_id = $t->showtime_id ;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $t->showtime_date = $row['showtime_date'];
        $t->showtime_hour = $row['showtime_hour'];
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/stylecss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title></title>
</head>

<body>
    <header>
        <a class="logo" href="index.php">Cinema Booking Website</a>
        <nav>
            <ul class="nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="movies.php">MOVIES</a></li>

            </ul>
        </nav>
        <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        ?>
            <a id="login" href="profile.php">Profile</a>
            <a id="login" href="logout.php">Logout</a>

        <?php } else { ?>
            <a id="login" href="Login.php">Login</a>

        <?php } ?>
    </header>
    <div class="header_title">
        Update Personel information
    </div>
    <form action="update_user.php" method="POST">
        <div>
            <label for="fname">First Name</label>
            <input type="text" name="fname" value="<?php if (isset($fname)) {
                                                        echo $fname;
                                                    } ?>">
        </div>
        <div>
            <label for="fname">Last Name</label>
            <input type="text" name="lname" value="<?php if (isset($lname)) {
                                                        echo $lname;
                                                    } ?>">
        </div>
        <div>
            <label for="fname">Date Of Birth</label>
            <input type="date" name="dob" value="<?php if (isset($dob)) {
                                                        echo date_format(date_create($dob), 'Y-m-d');
                                                    } ?>">
        </div>
        <div>
            <label for="fname">Email</label>
            <input type="email" name="email" value="<?php if (isset($email)) {
                                                        echo $email;
                                                    } ?>">
        </div>
        <button type="submit">Update</button>

    </form>




    <?php
    if ($flag) {



        echo '   <section class="ftco-section">
        <div class="header_title2">
            Booking History
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Seats ID</th>
                                    <th>Movie Title</th>
                                    <th>Showtime Date</th>
                                    <th>Showtime Hour</th>
                                    <th>Total Payed</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($tickets as $ticket) {
            $full_date = $ticket->showtime_date . ' ' . $ticket->showtime_hour;
            if ($full_date  < date("Y-m-d h:i:s")) {
                echo '<tr class="alert" role="alert">
                                    <th scope="row">' . $ticket->booking_id . '</th>
                                    <td>' . $ticket->seats_id . '</td>
                                    <td>' . $ticket->movie_title . '</td>
                                    <td>' . $ticket->showtime_date . '</td>
                                    <td>' . $ticket->showtime_hour . ' PM</td>
                                    <td>' . $ticket->total . ' EGP</td>
                                    <td>
                                        <a href="#" class="close" data-dismiss="alert" aria-label="Close" style="color:red; font-size:20px; visibility: hidden;">
                                            Delete
                                        </a>
                                    </td>
                                </tr>';
            } else {
                echo '<tr class="alert" role="alert">
                                    <th scope="row">' . $ticket->booking_id . '</th>
                                    <td>' . $ticket->seats_id . '</td>
                                    <td>' . $ticket->movie_title . '</td>
                                    <td>' . $ticket->showtime_date . '</td>
                                    <td>' . $ticket->showtime_hour . ' PM</td>
                                    <td>' . $ticket->total . ' EGP</td>
                                    <td>
                                        <a href="delete_booking.php?id=' . $ticket->booking_id . '" class="close" data-dismiss="alert" aria-label="Close" style="color:red; font-size:20px; visibility: visiable;">
                                            Delete
                                        </a>
                                    </td>
                                </tr>';
            }
        }
        echo '</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>';
    } else {
    }

    ?>



    <footer>
        <div class="footer">

            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>


</body>

</html>