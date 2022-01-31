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

  if($row){
    echo "Success!";
  }
  else{
    echo "Your email or password may be incorrect.";
  }

  mysqli_close($connection);

 ?>
</head>
</html>
