<!DOCTYPE HTML>

<html>
<?php

  include("header.php");

  $key = "";

  $connection = mysqli_connect("localhost","root","root","polititrack");
  $res = mysqli_query($connection, "select * from users where token =\"" . $_SESSION['token'] . "\"");
  $row = mysqli_fetch_assoc($res);

  try{
    if(!$row){
        throw new Exception("Invalid Token");
    }

    if(!$row["zip"]){
        throw new Exception("This user does not have a ZIP code added to their account!");
    }

  }
  catch(Exception $e){
    echo "Error : " . $e->getMessage() . "<br />";
    mysqli_close($connection);
    include("login.php");
    die();
  }



$connection = mysqli_connect("localhost","root","root","polititrack");
$res = mysqli_query($connection, "select * from users where token =\"" . $_SESSION['token'] . "\"");
$row = mysqli_fetch_assoc($res);

try{
  if(!$row){
      throw new Exception("Invalid Token");
  }
}
catch(Exception $e){
  echo "Error : " . $e->getMessage();
}

$data = file_get_contents("https://www.googleapis.com/civicinfo/v2/voterinfo?key=".$key."&address=".urlencode($row["street"])."+".urlencode($row["state"])."+".urlencode($row["zip"])."&electionId=2000");
$data = json_decode($data);

foreach($data->contests as $contest){
  if($contest->type == "General"){
    echo "<h3>" . $contest->district->name . " " . $contest->office . "</h3>";

    foreach($contest->candidates as $candidate){
      echo "<a href=candidate.php?name=".urlencode($candidate->name)."&party=".urlencode($candidate->party)."&state=".str_replace(" ", "_", $row["state"]).">" . $candidate->name . ", " . $candidate->party . "</a>";
      echo"<br/>";
    }
  }

  echo "<br/>";
}


mysqli_close($connection);

 ?>

<body>
<br /><br />






</body>

</html>
