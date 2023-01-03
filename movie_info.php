<?php include_once "connect.php";
session_start();


class Movie
{
    public $theater_id;
    public $title;
    public $poster;
    public $poster2;
    public $trailer;
    public $genre;
    public $runtime;
    public $releasedate;
    public $director;
    public $description;
    public $cast;

    function __construct($theater_id, $title, $poster, $poster2, $trailer, $genre, $runtime, $releasedate, $director, $description, $cast)
    {
        $this->theater_id = $theater_id;
        $this->title = $title;
        $this->poster = $poster;
        $this->poster2 = $poster2;
        $this->trailer = $trailer;
        $this->genre = $genre;
        $this->runtime = $runtime;
        $this->releasedate = $releasedate;
        $this->director = $director;
        $this->description = $description;
        $this->cast = $cast;
    }
}

class Showtime
{
    public $showtime_id;
    public $showtime_date;
    public $showtime_hour;
    public $showtime_price;
    function __construct($showtime_id, $showtime_date, $showtime_hour, $showtime_price)
    {
        $this->showtime_id = $showtime_id;
        $this->showtime_date = $showtime_date;
        $this->showtime_hour = $showtime_hour;
        $this->showtime_price = $showtime_price;
    }
}


$movie_id = $_GET['id'];

$query = "SELECT * FROM Movies WHERE movie_theater_num = '$movie_id'";
$trailerlink = $conn->query($query);


if ($trailerlink->num_rows > 0) {
    $row = $trailerlink->fetch_assoc();
    $movie = new Movie($row["movie_theater_num"], $row["movie_title"], $row["movie_poster"], $row["movie_poster2"], $row["movie_trailer"], $row["movie_genre"], $row["movie_runtime"], $row["movie_releasedate"], $row["movie_director"], $row["movie_description"], $row["movie_cast"]);
} else {
    echo 0;
}
$query2 = "SELECT * FROM Showtime WHERE theater_id = '$movie_id'";
$result = $conn->query($query2);

$showtimes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($showtimes, new Showtime($row['showtime_id'], $row['showtime_date'], $row['showtime_hour'], $row['showtime_price']));
    }
} else {
    echo 0;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/movie_info.css">

</head>

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

<body>
    <div class="container pb-5 pe-5 ps-5 ">
        <div class="info">
            <div class="row">
                <div class="col-5">

                    <img src="<?php if (isset($movie->poster)) {
                                    echo $movie->poster;
                                } ?>" style="height:600px;width:400px;position:relative;left:60px;" class="rounded float-start mx-auto mt-5">
                </div>
                <div class="col-4 pt-5">
                    <h2><?php if (isset($movie->title)) {
                            echo $movie->title;
                        } ?></h2>



                    <div class="text-warning"><b><?php if (isset($movie->runtime)) {
                                                        echo $movie->runtime;
                                                    }
                                                    ?></b></div>

                    <br>

                    <section>
                        <p style="margin-bottom:2px;"> <b style="font-size: larger;">Release Date : </b><?php if (isset($movie->releasedate)) {
                                                                                                            echo $movie->releasedate;
                                                                                                        } ?></p>
                        <p>
                        <p></p>
                        <p style="margin-bottom:2px;"> <b style="font-size: larger;">Synopsis : </b><?php if (isset($movie->description)) {
                                                                                                        echo $movie->description;
                                                                                                    } ?>
                        </p>
                        <br>

                        <p style="margin-bottom:2px;"><b style="font-size: larger;">Director : </b><?php if (isset($movie->director)) {
                                                                                                        echo $movie->director;
                                                                                                    } ?></p>
                        <br>


                        <div>
                            <p style="margin-bottom:2px;"><b style="font-size: larger;">Cast : </b><?php if (isset($movie->cast)) {
                                                                                                        echo $movie->cast;
                                                                                                    } ?></p>
                            <p></p>
                        </div>

                        <div>
                            <p style="margin-bottom:2px;"><b style="font-size: larger;">Genre : </b><?php if (isset($movie->genre)) {
                                                                                                        echo $movie->genre;
                                                                                                    } ?></p>

                        </div>

                        <div class="row">
                            <a class="trailer" href="<?php if (isset($movie->trailer)) {
                                                            echo $movie->trailer;
                                                        }  ?>" target="_blank">Watch Trailer</a>
                        </div>

                    </section>
                </div>


            </div>
        </div>


        <div class="row">
            <div class="row pt-5 center">
                <section id="booking">
                    <h3 style="float:left; margin:20px 0px 20px 0px"><?php if (isset($movie->title)) {
                                                                            echo $movie->title;
                                                                        } ?> -Showtimes</h3>

                    <div class="container-fluid">
                        <hr class="style1">
                        <ul class="list-group list-group-horizontal">

                            <li class="list-group-item active" id="li1">
                                <a onclick="shows1()">Today</a>
                            </li>
                            <li class="list-group-item" id="li2">
                                <a onclick="shows2()">Tomorrow</a>
                            </li>
                            <li class="list-group-item" id="li3">
                                <a onclick="shows3()"><?php
                                                        $dayaftertomorrow = date("D d/m", strtotime("+2 days"));
                                                        echo $dayaftertomorrow; ?></a>
                            </li>
                        </ul>
                        <hr class="style1">
                    </div>

                </section>
            </div>
        </div>
    </div>



    <div id="s1">
        <ul class="time_info">
            <?php
            for ($j = 0; $j < count($showtimes); $j++) {
                if ($showtimes[$j]->showtime_date == date("Y-m-d")) {
                    echo '<ul>
            <li style="font-weight: bold; font-size:28px;">' . date('h:i', strtotime($showtimes[$j]->showtime_hour)) . ' pm</li>
            <li>' . $showtimes[$j]->showtime_price . ' EGP</li>
            <li><a style="color: black; font-weight:bold;" href="seats.php?showtime_id=' . $showtimes[$j]->showtime_id . '&movie_id=' . $movie_id . '">Buy Tickets</a></li>
        </ul>';
                }
            }
            ?>
        </ul>
    </div>
    <div id="s2" style="display:none">
        <ul class="time_info">
            <?php
            for ($j = 0; $j < count($showtimes); $j++) {
                if ($showtimes[$j]->showtime_date == date("Y-m-d", strtotime("+1 days"))) {
                    echo '<ul>
            <li style="font-weight: bold; font-size:28px;">' . date('h:i', strtotime($showtimes[$j]->showtime_hour)) . ' pm</li>
            <li>' . $showtimes[$j]->showtime_price . ' EGP</li>
            <li><a style="color: black; font-weight:bold;" href="seats.php?showtime_id=' . $showtimes[$j]->showtime_id . '&movie_id=' . $movie_id . '">Buy Tickets</a></li>
        </ul>';
                }
            }
            ?>
        </ul>
    </div>
    <div id="s3" style="display:none">
        <ul class="time_info">
            <?php
            for ($j = 0; $j < count($showtimes); $j++) {
                if ($showtimes[$j]->showtime_date == date("Y-m-d", strtotime("+2 days"))) {
                    echo '<ul>
            <li style="font-weight: bold; font-size:28px;">' . date('h:i', strtotime($showtimes[$j]->showtime_hour)) . ' pm</li>
            <li>' . $showtimes[$j]->showtime_price . ' EGP</li>
            <li><a style="color: black; font-weight:bold;" href="seats.php?showtime_id=' . $showtimes[$j]->showtime_id . '&movie_id=' . $movie_id . '">Buy Tickets</a></li>
        </ul>';
                }
            }
            ?>
        </ul>
    </div>

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


    <script>
        const s1 = document.getElementById("s1");
        const s2 = document.getElementById("s2");
        const s3 = document.getElementById("s3");
        const li1 = document.getElementById("li1");
        const li2 = document.getElementById("li2");
        const li3 = document.getElementById("li3");

        function shows1() {

            s1.style.display = "inline-block";
            li1.className = "list-group-item active";
            s2.style.display = "none";
            li2.className = "list-group-item";
            s3.style.display = "none";
            li3.className = "list-group-item";
        }

        function shows2() {

            s1.style.display = "none";
            li1.className = "list-group-item ";
            s2.style.display = "inline-block";
            li2.className = "list-group-item active";
            s3.style.display = "none";
            li3.className = "list-group-item ";
        }

        function shows3() {

            s1.style.display = "none";
            li1.className = "list-group-item ";
            s2.style.display = "none";
            li2.className = "list-group-item ";
            s3.style.display = "inline-block";
            li3.className = "list-group-item active";
        }
    </script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootsrap.js"></script>
</body>

</html>