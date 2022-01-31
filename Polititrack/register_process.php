<!DOCTYPE HTML>

<html>
<body>

  <?php
  $connection = mysqli_connect("localhost","root","root","polititrack");
  session_start();


  $email = mysqli_real_escape_string($connection, $_POST["email"]);
  $password = md5(mysqli_real_escape_string($connection, $_POST["pw"]));

  $res = mysqli_query($connection, "select * from users where email = '$email'");
  $row = mysqli_fetch_assoc($res);

  if($row){
    echo "This email is in use. Please try again...<br /><br />";
    die();
  }
  else{
    $res = mysqli_query($connection, "insert into users (email, password) values ('$email' '$pw')");
  }

  mysqli_close($connection);

  ?>

</body>
</html>
