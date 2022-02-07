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




<h1>

</h1>

<?php
$key = "";
$sampleAddress = "";

$data = file_get_contents("https://www.googleapis.com/civicinfo/v2/voterinfo?key=".$key."&address=".urlencode($sampleAddress)."&electionId=2000");
$data = json_decode($data);

foreach($data->contests as $contest){
  if($contest->type == "General"){

    echo "<h3>" . $contest->district->name . " " . $contest->office . "</h3>";


    foreach($contest->candidates as $candidate){
      echo "<a href=candidate.php?name=".urlencode($candidate->name).">" . $candidate->name . ", " . $candidate->party . "</a>";

      echo"<br/>";
    }
  }

  echo "<br/>";
}




 ?>

<body>
<br /><br />

<a href="profile.php">Your profile</a><br/>




</body>

</html>
