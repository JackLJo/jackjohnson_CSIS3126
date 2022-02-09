<!DOCTYPE HTML>

<html>

  <h3>
  <?php

  $errormessage .= ($_POST["email"] == "" ? "You must enter an email. <br/>":"");
  $errormessage .= (strlen($_POST["pw"]) <= 7 ? "You must enter a password with atleast 7 characters <br/>":"");
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
  ?>


  <?php

  $connection = mysqli_connect("localhost","root","root","polititrack");
  session_start();


  $email = mysqli_real_escape_string($connection, $_POST["email"]);
  $password = md5(mysqli_real_escape_string($connection, $_POST["pw"]));
  $state = mysqli_real_escape_string($connection, $_POST["state"]);
  $street = mysqli_real_escape_string($connection, $_POST["street"]);
  $zip = mysqli_real_escape_string($connection, $_POST["zip"]);


  $res = mysqli_query($connection, "select * from users where email = \"".$email."\"");
  $row = mysqli_fetch_assoc($res);

  if($row){
    echo "This email is in use. Please try again...<br /><br />";
    die();
  }
  else{
    $res = mysqli_query($connection, "insert into users (email, password, zip, street, state) values ('$email', '$password', '$zip', '$street', '$state')");

    echo "Successfully registered user! <br /><br />Please <a href=\"login.php\">Log in!</a>";
  }

  mysqli_close($connection);

  ?>

</body>
</html>
