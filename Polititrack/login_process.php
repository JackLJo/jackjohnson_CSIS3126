<!DOCTYPE HTML>

<html>
<head>
<?php


  $connection = mysqli_connect("localhost","root","root","polititrack");
  session_start();


  $email = mysqli_real_escape_string($connection, $_POST["email"]);
  $password = md5(mysqli_real_escape_string($connection, $_POST["pw"]));

  $res = mysqli_query($connection, "select * from users where email =\"" . $email . "\" and password = \"" . $password . "\"");
  $row = mysqli_fetch_assoc($res);

  $errormessage .= !$row ? "You're Email or password is incorrect. Please try again." : "" ;

  if(strlen($errormessage) > 0){
    echo $errormessage;
    include("login.php");
    die();
  }

  $token = bin2hex(random_bytes(16));


  session_start();

  $_SESSION["token"] = $token;


  mysqli_close($connection);

  header("Location: home.php");

 ?>
</head>
</html>
