<!DOCTYPE HTML>

<html>
<body>
  <?php


    $token = bin2hex(random_bytes(16));
    echo $token;
  //
  //
  // $key = "";
  // $address = "";
  //
  //
  //
  // $data = file_get_contents("https://www.googleapis.com/civicinfo/v2/voterinfo?&address=".urlencode($address)."&key=".$key."&electionId=2000");
  //
  // $data = json_decode($data);
  // echo "<pre>";
  //
  //
  // foreach($data->contests as $contest){
  //     echo $contest->name;
  //     echo "<br />";
  // }
  //
  //
  //
  //
   ?>


</body>
</html>
