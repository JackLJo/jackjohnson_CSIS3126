<!DOCTYPE HTML>

<html>

<?php
  session_start();
    if(!$_SESSION['token']){
      echo "
      Oops! You do not have access to this page..
      <br/>
      Please <a href=login.php>login.</a>
      <br />
      <br/>
      <a href=register.php>Create a new account</a>
      ";
      die();
    }
 ?>

<head>
<h2>
<a href="home.php">Home</a>
&emsp;&emsp;
<a href="profile.php">Your profile</a>
&emsp;&emsp;
<a href="map.php">Map</a>
&emsp;&emsp;
<a href="logout.php">Logout</a>
<br/>
</h2>
</head>
</html>
