<!DOCTYPE HTML>
<html>
<?php


  include("header.php");

  $connection = mysqli_connect("localhost","root","root","polititrack");
  $res = mysqli_query($connection, "select * from users where token =\"" . $_SESSION['token'] . "\"");
  $row = mysqli_fetch_assoc($res);

  try{
    if(!$row){
      throw new Exception("Invalid token.");
    }
  }
  catch(Exception $e){
    echo "Error : " . $e->getMessage;

    session_unset();
    session_destroy();
    header("Location: login.php");
  }




 ?>
