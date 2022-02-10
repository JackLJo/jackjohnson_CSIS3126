<!DOCTYPE HTML>
<?php
  session_start();

  $news_api_key = "";
  $google_civ_key = "";

  $connection = mysqli_connect("localhost","root","root","polititrack");
  $res = mysqli_query($connection, "select * from users where token =\"" . $_SESSION['token'] . "\"");
  $row = mysqli_fetch_assoc($res);

  $split_name = explode(" ", $_GET['name']);
  unset($split_name[1]);
  if(count($split_name) == 4){
    unset($split_name[3]);
  }
  $name = implode(" ", $split_name);

  try{
    if(!$row){
        throw new Exception("Invalid Token");
    }
  }
  catch(Exception $e){
    echo "Error : " . $e->getMessage();
    mysqli_close($connection);
    include("login.php");
    die();
  }

?>
<html>
<title>
  <?php echo $_GET['name']; ?> | Polititrack
</title>

<head>
  <h1>
    <?php echo $_GET['name']; ?>
  </h1>

  <h2>
    <?php echo $_GET['party']; ?>
  </h2>
  <h3>
    Summary:
  </h3>
  <?php

    $html = file_get_contents("https://ballotpedia.org/".str_replace(' ', '_', $name));
    $start = stripos($html, '<b>' . $name . '</b>');
    $end = stripos($html, '</p>', $offset = $start);
    $length = $end - $start;
    $htmlSection = substr($html, $start, $length);

    echo $htmlSection;

  ?>
  <h3>
    News:
  </h3>
</head>
<body>
<?php



    $news = file_get_contents("https://newsapi.org/v2/everything?q=".urlencode($name)."+".urlencode($_GET["party"])."&searchIn=title,description&sortBy=popularity&language=en&apiKey=".$news_api_key);

    $news = json_decode($news);

    if(!$news->articles){
      echo "This candidate could not be found in the news..";
    }

    for($i = 0; $i < 3 ; $i++){
      echo "<a href =" . $news->articles[$i]->url .">". $news->articles[$i]->title . "<br/> <font size=\"-1\">" . $news->articles[$i]->description . "</font></a> <br/><br/>";
    }




    mysqli_close($connection);
  ?>
</body>
</html>
