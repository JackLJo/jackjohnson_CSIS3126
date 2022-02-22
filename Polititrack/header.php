<!DOCTYPE HTML>

<html>

<?php
  session_start();
  try{
    if(!$_SESSION['token']){
      throw new Exception("You must be logged in to view this page.");
    }
  }
  catch(Exception $e){
    echo "Error : " . $e->getMessage() . "<br/><br/>";
    session_unset();
    session_destroy();
    include("login.php");
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
