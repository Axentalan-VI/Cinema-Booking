<?php
session_start();
include_once 'connect.php';

class Movie
{

   public $theater_id;
   public $title;
   public $poster;
   public $poster2;
   public $trailer;

   function __construct($theater_id, $title, $poster, $poster2, $trailer)
   {
      $this->theater_id = $theater_id;
      $this->title = $title;
      $this->poster = $poster;
      $this->poster2 = $poster2;
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


$query = "Select * from Movies Where movie_theater_num between '1' and '5' ;";
$result = $conn->query($query);

$movies = array();


if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      array_push($movies, new Movie($row['movie_theater_num'], $row['movie_title'], $row['movie_poster'], $row['movie_poster2'], $row['movie_trailer']));
   }
} else {
   echo "0 results";
}

$query = "Select * from Soon_Movies Where movie_id in ('2','3','4','7','8');";
$result = $conn->query($query);

$soon_movies = array();


if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      array_push($soon_movies, new Soon_Movies($row['movie_title'], $row['movie_poster'], $row['movie_trailer']));
   }
} else {
   echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html>

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
   <section class="slider">
      <div class="swiper mySwiper">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <div class="banner2-content">
                  <h3>Now Showing</h3>
                  <h2><?php if (isset($movies[0]->title)) {
                           echo $movies[0]->title;
                        } ?></h2>
                  <a class="trailer" target="_blank" href="<?php if (isset($movies[0]->trailer)) {
                                                               echo $movies[0]->trailer;
                                                            } ?>">Watch Trailler</a>
                  <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[0]->theater_id)) {
                                                                  echo $movies[0]->theater_id;
                                                               } ?>">Book Now</a>
               </div>
               <img class="swiper1" src="<?php if (isset($movies[0]->poster2)) {
                                             echo $movies[0]->poster2;
                                          } ?>" alt="black_adam">
            </div>
            <div class="swiper-slide">
               <div class="banner2-content">
                  <h3>Now Showing</h3>
                  <h2><?php if (isset($movies[1]->title)) {
                           echo $movies[1]->title;
                        } ?></h2>
                  <a class="trailer" target="_blank" href="<?php if (isset($movies[1]->trailer)) {
                                                               echo $movies[1]->trailer;
                                                            } ?>">Watch Trailler</a>

                  <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[1]->theater_id)) {
                                                                  echo $movies[1]->theater_id;
                                                               } ?>">Book Now</a>
               </div>
               <img class="swiper1" src="<?php if (isset($movies[1]->poster2)) {
                                             echo $movies[1]->poster2;
                                          } ?>" alt="black_panther">
            </div>
            <div class="swiper-slide">
               <div class="banner2-content">
                  <h3>Now Showing</h3>
                  <h2><?php if (isset($movies[2]->title)) {
                           echo $movies[2]->title;
                        } ?></h2>
                  <a class="trailer" target="_blank" href="<?php if (isset($movies[2]->trailer)) {
                                                               echo $movies[2]->trailer;
                                                            } ?>">Watch Trailler</a>

                  <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[2]->theater_id)) {
                                                                  echo $movies[2]->theater_id;
                                                               } ?>">Book Now</a>
               </div>
               <img class="swiper1" src="<?php if (isset($movies[2]->poster2)) {
                                             echo $movies[2]->poster2;
                                          } ?>" alt="black_panther">
            </div>
         </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      </div>
   </section>
   <section class="movies">
      <div class="movie-nav">
         <div class="showing2" onclick="show_movies()">Now Showing</div>
         <div class="coming_soon" onclick="show_soon()">Coming Soon</div>
      </div>
      <div id="slide1" class="swiper mySwiper2">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($movies[2]->poster)) {
                                                echo $movies[2]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($movies[2]->title)) {
                                                echo $movies[2]->title;
                                             } ?></h5>
                     <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[2]->theater_id)) {
                                                                     echo $movies[2]->theater_id;
                                                                  } ?>">Book Now</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($movies[0]->poster)) {
                                                echo $movies[0]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($movies[0]->title)) {
                                                echo $movies[0]->title;
                                             } ?></h5>
                     <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[0]->theater_id)) {
                                                                     echo $movies[0]->theater_id;
                                                                  } ?>">Book Now</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($movies[1]->poster)) {
                                                echo $movies[1]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($movies[1]->title)) {
                                                echo $movies[1]->title;
                                             } ?></h5>
                     <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[1]->theater_id)) {
                                                                     echo $movies[1]->theater_id;
                                                                  } ?>">Book Now</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($movies[3]->poster)) {
                                                echo $movies[3]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($movies[3]->title)) {
                                                echo $movies[3]->title;
                                             } ?></h5>
                     <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[3]->theater_id)) {
                                                                     echo $movies[3]->theater_id;
                                                                  } ?>">Book Now</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($movies[4]->poster)) {
                                                echo $movies[4]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($movies[4]->title)) {
                                                echo $movies[4]->title;
                                             } ?></h5>
                     <a class="booknow" href="movie_info.php?id=<?php if (isset($movies[4]->theater_id)) {
                                                                     echo $movies[4]->theater_id;
                                                                  } ?>">Book Now</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
      </div>
      <div id="slide2" class="swiper mySwiper2" style="display: none;">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($soon_movies[0]->poster)) {
                                                echo $soon_movies[0]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($soon_movies[0]->title)) {
                                                echo $soon_movies[0]->title;
                                             } ?></h5>
                     <a class="showinfo" target="_blank" href="<?php if (isset($soon_movies[0]->trailer)) {
                                                                  echo $soon_movies[0]->trailer;
                                                               } ?>">TRAILER</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($soon_movies[4]->poster)) {
                                                echo $soon_movies[4]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($soon_movies[4]->title)) {
                                                echo $soon_movies[4]->title;
                                             } ?></h5>
                     <a class="showinfo" target="_blank" href="<?php if (isset($soon_movies[4]->trailer)) {
                                                                  echo $soon_movies[4]->trailer;
                                                               } ?>">TRAILER</a>
                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($soon_movies[1]->poster)) {
                                                echo $soon_movies[1]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($soon_movies[1]->title)) {
                                                echo $soon_movies[1]->title;
                                             } ?></h5>
                     <a class="showinfo" target="_blank" href="<?php if (isset($soon_movies[1]->trailer)) {
                                                                  echo $soon_movies[1]->trailer;
                                                               } ?>">TRAILER</a>

                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($soon_movies[3]->poster)) {
                                                echo $soon_movies[3]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($soon_movies[3]->title)) {
                                                echo $soon_movies[3]->title;
                                             } ?></h5>
                     <a class="showinfo" target="_blank" href="<?php if (isset($soon_movies[3]->trailer)) {
                                                                  echo $soon_movies[3]->trailer;
                                                               } ?>">TRAILER</a>

                  </div>
               </div>
            </div>
            <div class="swiper-slide">
               <div class="contanier">
                  <img class="swiper2" src="<?php if (isset($soon_movies[2]->poster)) {
                                                echo $soon_movies[2]->poster;
                                             } ?>">
                  <div class="middle">
                     <h5 class="movie_title"><?php if (isset($soon_movies[2]->title)) {
                                                echo $soon_movies[2]->title;
                                             } ?></h5>
                     <a class="showinfo" target="_blank" href="<?php if (isset($soon_movies[2]->trailer)) {
                                                                  echo $soon_movies[2]->trailer;
                                                               } ?>">TRAILER</a>

                  </div>
               </div>
            </div>
         </div>
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
      </div>
      <a id='btn1' class="viewall" style="font-weight: bold;" href="movies.php">View All Movies</a>
   </section>
   <div class="theater">
      <img class="theater_pic" src="images/theater.jpeg">
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
   <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
   <script>
      var swiper = new Swiper(".mySwiper", {
         slidesPerView: 1,
         spaceBetween: 30,
         autoplay: {
            delay: 4000,
            disableOnInteraction: false,
         },
         centeredSlides: true,
         loop: true,
         navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
         },


      });
   </script>
   <script>
      var swiper = new Swiper(".mySwiper2", {
         slidesPerView: 3,
         spaceBetween: 30,
         loopFillGroupWithBlank: true,
         pagination: {
            el: ".swiper-pagination",
         },
         navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
         }
      });
   </script>
   <script>
      const slide1 = document.getElementById('slide1');
      const slide2 = document.getElementById('slide2');
      const btn1 = document.getElementById('btn1');
      const btn2 = document.getElementById('btn2');

      function show_movies() {
         slide2.style.display = "none";
         slide1.style.display = "block";

         btn1.style.display = "block";
         btn2.style.display = "none";

      }

      function show_soon() {
         slide1.style.display = "none";
         slide2.style.display = "block";
         btn2.style.display = "block";
         btn1.style.display = "none";
      }
   </script>

   <script>
      function update_dates() {
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               if (this.responseText == "done 2done 3done 1") {
                  alert("done");
               } else {
                  alert("booking system not working right now please comeback later");
               }
            }
         };
         xmlhttp.open("GET", "update_dates.php", true);
         xmlhttp.send();
      }
   </script>
</body>

</html>