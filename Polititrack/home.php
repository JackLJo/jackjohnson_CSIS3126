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




<h2>
<a href="profile.php">Your profile</a><br/>
</h2>

<?php
$key = "";
$sampleAddress = "";

$data = file_get_contents("https://www.googleapis.com/civicinfo/v2/voterinfo?key=".$key."&address=".urlencode($sampleAddress)."&electionId=2000");
$data = json_decode($data);

foreach($data->contests as $contest){
  if($contest->type == "General"){

    echo "<h3>" . $contest->district->name . " " . $contest->office . "</h3>";


    foreach($contest->candidates as $candidate){
      echo "<a href=candidate.php?name=".urlencode($candidate->name)."&party=".urlencode($candidate->party).">" . $candidate->name . ", " . $candidate->party . "</a>";

      echo"<br/>";
    }
  }

  echo "<br/>";
}




 ?>

<body>
<br /><br />






</body>

</html>
