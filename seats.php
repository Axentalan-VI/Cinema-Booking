<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: Login.php");
}

include "connect.php";




$showtime_id = $_GET['showtime_id'];
$movie_id = $_GET['movie_id'];


$query = "SELECT movie_title FROM Movies WHERE movie_theater_num = '$movie_id'";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['movie_title'];
} else {
    echo "0 results";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/seats.css" />
    <title>Movie Seat Booking</title>
</head>

<body onload="seat(<?php if (isset($showtime_id)) {
                        echo $showtime_id;
                    } ?>,<?php if (isset($movie_id)) {
                                echo $movie_id;
                            } ?>)">
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
    <div class="movie-container"><?php if (isset($title)) {
                                        echo $title;
                                    } ?> -Theater
    </div>

    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>N/A</small>
        </li>

        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>

        <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
        </li>
    </ul>

    <div class="container" name="container">
        <div class="screen"></div>
        <div class="row">
            <div class="seat" id="A1"></div>
            <div class="seat" id="B1"></div>
            <div class="seat" id="C1"></div>
            <div class="seat" id="D1"></div>
            <div class="seat" id="E1"></div>
            <div class="seat" id="F1"></div>
            <div class="seat" id="G1"></div>
            <div class="seat" id="H1"></div>
        </div>
        <div class="row">
            <div class="seat" id="A2"></div>
            <div class="seat" id="B2"></div>
            <div class="seat" id="C2"></div>
            <div class="seat" id="D2"></div>
            <div class="seat" id="E2"></div>
            <div class="seat" id="F2"></div>
            <div class="seat" id="G2"></div>
            <div class="seat" id="H2"></div>
        </div>

        <div class="row">
            <div class="seat" id="A3"></div>
            <div class="seat" id="B3"></div>
            <div class="seat" id="C3"></div>
            <div class="seat" id="D3"></div>
            <div class="seat" id="E3"></div>
            <div class="seat" id="F3"></div>
            <div class="seat" id="G3"></div>
            <div class="seat" id="H3"></div>
        </div>

        <div class="row">
            <div class="seat" id="A4"></div>
            <div class="seat" id="B4"></div>
            <div class="seat" id="C4"></div>
            <div class="seat" id="D4"></div>
            <div class="seat" id="E4"></div>
            <div class="seat" id="F4"></div>
            <div class="seat" id="G4"></div>
            <div class="seat" id="H4"></div>
        </div>

        <div class="row">
            <div class="seat" id="A5"></div>
            <div class="seat" id="B5"></div>
            <div class="seat" id="C5"></div>
            <div class="seat" id="D5"></div>
            <div class="seat" id="E5"></div>
            <div class="seat" id="F5"></div>
            <div class="seat" id="G5"></div>
            <div class="seat" id="H5"></div>
        </div>
        <div class="row">
            <div class="seat" id="A6"></div>
            <div class="seat" id="B6"></div>
            <div class="seat" id="C6"></div>
            <div class="seat" id="D6"></div>
            <div class="seat" id="E6"></div>
            <div class="seat" id="F6"></div>
            <div class="seat" id="G6"></div>
            <div class="seat" id="H6"></div>
        </div>
    </div>

    <p class="text">
        You have selected <span id="count">0</span>

    </p>
    <a class="payment" onclick="send_info(<?php if (isset($movie_id)) {
                                                echo $movie_id;
                                            } ?>,<?php if (isset($showtime_id)) {
                                                        echo $showtime_id;
                                                    } ?>)">payment</a>


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

    <script src="js/seats.js"></script>
    <script src="js/jquery.min.js"></script>

</body>

</html>