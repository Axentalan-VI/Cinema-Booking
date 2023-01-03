<?php
session_start();

include_once "connect.php" ?>


<?php

class user
{
   public $user_id;
   public $user_name;
   public $user_email;
   public $user_password;
   public $user_first_name;
   public $user_last_name;



   function __construct($user_id, $user_name, $user_email, $user_password)
   {
      $this->$user_id = $user_id;
      $this->$user_name = $user_name;
      $this->$user_email = $user_email;
      $this->$user_password = $user_password;
   }
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
   <title></title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="css/Login.css" rel="stylesheet">

</head>
<header>
   <a class="logo" href="index.php">Cinema Booking Website</a>
   <nav>
      <ul class="nav">
         <li><a href="index.php">HOME</a></li>
         <li><a href="movies.php">MOVIES</a></li>
      </ul>
   </nav>
</header>
<body>
   <h2>Welcome to Movie Booking Website</h2>
   <div class="container" id="container">
      <div class="form-container sign-up-container">
         <form name="form" action="insert.php" method="POST">
            <h1>Create Account</h1>
            <input id="FirstName" type="text" name="FirstName" placeholder="First Name" required />
            <input id="LastName" type="text" name="LastName" placeholder="Last Name" required />
            <input type="date" id="birthdate" name="birthdate">
            <input id="SignUpEmail" type="email" name="SignUpEmail" placeholder="Email" required />
            <input id="pwd" type="password" name="pwd" placeholder="Password" onchange="passwordcheck(document.form.pwd)" required />
            <span id="passworderror" style="visibility:hidden;">Please Input a password with At least 1 capital letter and a minimum of 8 characters</span>
            <button id="submit" type="submit">Sign Up</button>



         </form>
      </div>
      <div class="form-container sign-in-container">
         <form action="signin.php" method="POST">
            <h1>Sign in</h1>
            <input id="signinmail" name="signinmail" type="email" placeholder="Email" required />
            <input id="signinpwd" name="signinpwd" type="password" placeholder="Password" required />
            <button>Sign In</button>
         </form>
      </div>
      <div class="overlay-container">
         <div class="overlay">
            <div class="overlay-panel overlay-left">
               <h1>Already Signed Up ?</h1>
               <br>
               <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
               <h1>Not Signed In ?</h1>
               <br>
               <button class="ghost" id="signUp">Sign Up</button>
            </div>
         </div>
      </div>
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

   <script src="js/login.js"></script>
</body>

</html>