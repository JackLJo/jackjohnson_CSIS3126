<!DOCTYPE HTML>

<html>

  <h3>
  <?php

  $connection = mysqli_connect("localhost","root","root","polititrack");

  $res = mysqli_query($connection, "select * from users where username = \"".mysqli_real_escape_string($connection, $_POST["username"])."\"");
  $row = mysqli_fetch_assoc($res);

  if($row){
    $errormessage .= "The username " . $_POST["username"] . " is already in use. Please use a different one.";
  }

  $res = mysqli_query($connection, "select * from users where email = \"".mysqli_real_escape_string($connection, $_POST["email"])."\"");
  $row = mysqli_fetch_assoc($res);

  if($row){
    $errormessage .= "The email " . $_POST["username"] . " is already in use. Please use a different one.";
  }


  $errormessage .= ($_POST["email"] == "" ? "You must enter an email. <br/>":"");
  $errormessage .= ($_POST["username"] == "" ? "You must enter a username. <br/>":"");
  $errormessage .= (strlen($_POST["pw"]) < 7 ? "You must enter a password with atleast 7 characters <br/>":"");
  $errormessage .= (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false?"You must enter a valid email address.<br/>":"");
  $errormessage .= (preg_match('/^[0-9]{5}(-[0-9]{4})?$/', $_POST['zip']) ? "" : "You must enter a valid ZIP code.<br/>");
  $errormessage .= (strlen($_POST['state']) == 0 ? "You must select a state.<br/>" : "");

  if(strlen($errormessage) > 0){

    echo $errormessage;
  ?>
</h3>

<body>

  <?php
    include("register.php");
    die();
  }
  session_start();



  $email = mysqli_real_escape_string($connection, $_POST["email"]);
  $username = mysqli_real_escape_string($connection, $_POST["username"]);
  $password = md5(mysqli_real_escape_string($connection, $_POST["pw"]));
  $state = mysqli_real_escape_string($connection, $_POST["state"]);
  $street = mysqli_real_escape_string($connection, $_POST["street"]);
  $zip = mysqli_real_escape_string($connection, $_POST["zip"]);

  $res = mysqli_query($connection, "insert into users (email, username, password, zip, street, state) values ('$email', '$username', '$password', '$zip', '$street', '$state')");

  echo "Successfully registered user! <br /><br />Please <a href=\"login.php\">Log in!</a>";

  mysqli_close($connection);

  ?>

</body>
</html>
