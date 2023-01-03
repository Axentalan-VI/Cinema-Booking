<?php
session_start();
include_once 'connect.php';

class Movie
{

   public $theater_id;
   public $title;
   public $poster;
   public $trailer;

   function __construct($theater_id, $title, $poster, $trailer)
   {
      $this->theater_id = $theater_id;
      $this->title = $title;
      $this->poster = $poster;
      $this->trailer = $trailer;
   }
}

class Soon_Movies
{


   public $title;
   public $poster;
   public $trailer;

   function __construct($title, $poster, $trailer)
   {
      $this->title = $title;
      $this->poster = $poster;
      $this->trailer = $trailer;
   }
}

$query = "Select * from Movies ;";
$result = $conn->query($query);

$movies = array();

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      array_push($movies, new Movie($row['movie_theater_num'], $row['movie_title'], $row['movie_poster'], $row['movie_trailer']));
   }
} else {
   echo "0 results";
}

$query = "Select * from Soon_Movies";
$result = $conn->query($query);
$soon_movies = array();
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      array_push($soon_movies, new Soon_Movies($row['movie_title'], $row['movie_poster'], $row['movie_trailer']));
   }
} else {
   echo "0 results";
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Cinema Booking Website</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
   <link rel="stylesheet" href="css/stylecss.css">
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
   <section id="movielist">
      <div id="movies-nav" class="movie-nav">
         <div class="showing2" onclick="show_movies()" style="padding-right: 20px;">Now Showing</div>
         <div class="coming_soon" onclick="show_soon()">Coming Soon</div>
      </div>
      <ul class="mlist" id="mlist1">
         <?php
         for ($i = 0; $i < count($movies); $i++) {
            echo '<li>
                <div class="contanier">
               <img class="swiper2" src="' . $movies[$i]->poster . '">
               <div class="middle">
               <h5 class="movie_title">' . $movies[$i]->title . '</h5>
               <a class="showinfo" href="movie_info.php?id=' . $movies[$i]->theater_id . '">BOOK NOW</a>
               </div>
               </div>
               </li>';
         }
         ?>
      </ul>
      <ul class="mlist" id="mlist2" style="display: none;">

         <?php
         for ($i = 0; $i < count($soon_movies); $i++) {
            echo '<li>
                <div class="contanier">
                     <img class="swiper2" src="' . $soon_movies[$i]->poster . '">
                     <div class="middle">
                        <h5 class="movie_title">' . $soon_movies[$i]->title . '</h5>
                        <a class="showinfo" target="_blank" href="' . $soon_movies[$i]->trailer . '">TRAILER</a>
                     </div>
                  </div>
            </li>';
         }
         ?>
      </ul>
   </section>
   <footer>
      <div class="footer">
         <div class="row">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
         </div>
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
      const slide1 = document.getElementById('mlist1');
      const slide2 = document.getElementById('mlist2');


      function show_movies() {
         slide2.style.display = "none";
         slide1.style.display = "block";


      }

      function show_soon() {
         slide1.style.display = "none";
         slide2.style.display = "block";

      }
   </script>
</body>

</html>