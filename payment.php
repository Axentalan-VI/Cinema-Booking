<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("location: Login.php");
}
include "connect.php";

$movie_id = $_GET['tid'];
$showtime_id = $_GET['stid'];
$num_seats = $_GET['num_seats'];
$seats_id = $_GET['seats_id'];


$query = "SELECT movie_title FROM Movies WHERE movie_theater_num = '$movie_id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $title = $row['movie_title'];
} else {
  echo "0 results";
}

$query = "SELECT showtime_date,showtime_hour,showtime_price FROM Showtime WHERE showtime_id = '$showtime_id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $date = $row['showtime_date'];
  $hour = $row['showtime_hour'];
  $price = $row['showtime_price'];
} else {
  echo "0 results";
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cinema Booking Website</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/payment.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

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

  <body>
    <main class="page payment-page">
      <section class="payment-form dark">
        <div class="container">
          <div class="block-heading">
            <h2 style="color:#FFBF00">Payment</h2>
          </div>

          <form name="form">
            <div class="products">
              <h3 class="title">Ticket</h3>
              <div class="item">
                <span class="price"><?php if (isset($num_seats)) {
                                      echo $num_seats;
                                    } ?> Tickets </span>
                <p class="item-name"><?php if (isset($title)) {
                                        echo $title;
                                      } ?></p>
                <span class="item-answer"><?php if (isset($seats_id)) {
                                            echo $seats_id;
                                          } ?></span>
                <p class="item-description">Seats Number :</p>
                <span class="item-answer"><?php if (isset($movie_id)) {
                                            echo $movie_id;
                                          } ?></span>
                <p class="item-description">Theater Number :</p>
                <span class="item-answer"><?php if (isset($date)) {
                                            echo $date;
                                          } ?></span>
                <p class="item-description">Date :</p>
                <span class="item-answer"><?php if (isset($hour)) {
                                            echo date('h:i', strtotime($hour));
                                          } ?>PM</span>
                <p class="item-description">Showtime :</p>

              </div>
              <div class="total">Total<span class="price"><?php if (isset($num_seats) and isset($price)) {
                                                            echo $num_seats * $price;
                                                          } ?> EGP</span></div>
            </div>
            <div class="card-details">
              <h3 class="title" style="margin-bottom: 30px;">Credit Card Details</h3>
              <div class="row">

                <div class="form-group col-sm-7">
                  <label for="name">Card Holder</label>
                  <input id="card-holder" type="text" name="name" maxlength="22" minlength="2" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1" onchange="Name_Validation(document.form.name)">
                  <div id="name_error" style="visibility:hidden;">*Please enter a valid card holder</div>
                </div>
                <div class="form-group col-sm-5">
                  <label for="expiry">Expiration Date</label>
                  <div class="input-group expiration-date">
                    <input type="text" id="expiry" name="expiry" class="form-control" placeholder="MM/YY" aria-label="MM/YY" aria-describedby="basic-addon1" onchange="Expiry_Validation(document.form.expiry)">
                    <div id="expiry_error" style="visibility:hidden;">*Please enter a valid expiration date</div>
                  </div>
                </div>
                <div class="form-group col-sm-8">
                  <label for="card-number">Card Number</label>
                  <input id="card-number" name="number" type="text" pattern="\d*" maxlength="16" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1" onchange="creditCardValidation(document.form.number)" />
                  <div id="number_error" style="visibility:hidden;">*Please enter a valid credit card number</div>
                </div>
                <div class="form-group col-sm-4">
                  <label for="cvv">CVV</label>
                  <input id="cvv" name="cvv" type="text" pattern="\d*" class="form-control" placeholder="CVV" aria-label="Card Holder" aria-describedby="basic-addon1" onchange="CVV_Validation(document.form.cvv)">
                  <div id="cvv_error" style="visibility:hidden;">*Please enter a valid CVC number</div>
                </div>
                <div class="form-group col-sm-12">
                  <button type="button" class="btn btn-primary btn-block" style="position:relative; bottom:20px;" onclick="Validation()">Proceed</button>
                  <div id="mssg" style="visibility:hidden;">*Please enter all card informtion</div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
    </main>




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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
      const number_error = document.getElementById("number_error");
      const cvv_error = document.getElementById("cvv_error");
      const expiry_error = document.getElementById("expiry_error");
      const name_error = document.getElementById("name_error");
      const mssg = document.getElementById("mssg");
      const name = document.getElementById("card-holder");
      const cvv = document.getElementById("cvv");
      const expiry = document.getElementById("expiry");
      const namber = document.getElementById("card-number");
      var num_seats = <?php if (isset($num_seats)) {
                        echo $num_seats;
                      } ?>;
      var seats_id = "<?php if (isset($seats_id)) {
                        echo $seats_id;
                      } ?>";
      var movie_id = <?php if (isset($movie_id)) {
                        echo $movie_id;
                      } ?>;
      var shid = <?php if (isset($showtime_id)) {
                    echo $showtime_id;
                  } ?>;
      var date = "<?php if (isset($date)) {
                    echo $date;
                  } ?>";
      var hour = "<?php if (isset($hour)) {
                    echo $hour;
                  } ?>";
      var total = <?php if (isset($num_seats) and isset($price)) {
                    echo $num_seats * $price;
                  } ?>;



      function creditCardValidation(creditCradNum) {
        var regEx = /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/;
        var regEx2 = /^4[0-9]{12}(?:[0-9]{3})?$/;

        if (creditCradNum.value.match(regEx) || creditCradNum.value.match(regEx2)) {
          number_error.style = "visibility: hidden;color:red;font-size:10px;";

          return true;
        } else {
          number_error.style = "visibility: visible;color:red;font-size:10px;";
          return false;
        }
      }

      function CVV_Validation(cvc) {
        var regEx = /^[0-9]{3,4}$/;


        if (cvc.value.match(regEx)) {
          cvv_error.style = "visibility: hidden;color:red;font-size:10px;";
          return true;
        } else {
          cvv_error.style = "visibility: visible;color:red;font-size:10px;";
          return false;
        }
      }

      function Expiry_Validation(expairy_date) {
        var regEx = /^((0[1-9])|(1[0-2]))[\/\\]((2[3-9])|(3[0-9]))$/;

        if (expairy_date.value.match(regEx)) {
          expiry_error.style = "visibility: hidden;color:red;font-size:10px;";
          return true;
        } else {
          expiry_error.style = "visibility: visible;color:red;font-size:10px;";

          return false;
        }
      }

      function Name_Validation(name) {
        var regEx = /^[a-zA-Z ]*$/;

        if (name.value.match(regEx)) {
          name_error.style = "visibility: hidden;color:red;font-size:10px;";
          return true;
        } else {
          name_error.style = "visibility: visible;color:red;font-size:10px;";

          return false;
        }
      }

      function Validation() {
        if (number_error.style.visibility == "visible" ||
          expiry_error.style.visibility == "visible" || cvv_error.style.visibility == "visible" || name_error.style.visibility == "visible" || namber.value == "" || name.value == "" || expiry.value == "" || cvv.value == "") {
          mssg.style = "visibility: visible;color:red;font-size:10px;";

        } else {
          mssg.style = "visibility: hidden;color:red;font-size:10px;";


          $.post("store_booking.php", {
            seats: seats_id,
            numseats: num_seats,
            movieid: movie_id,
            showtimeid: shid,
            price: total,
          }, function(data, status) {
            alert(data);
          });

          setTimeout(() => {
            window.location.href = "index.php";
          }, 2000);




        }
      }
    </script>

  </body>