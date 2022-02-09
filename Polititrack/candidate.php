<!DOCTYPE HTML>
<?php
  $news_api_key = "";
  $google_civ_key = "";
  $sample_address = "02903";
?>
<html>
<head>
  <h1>
    <?php echo $_GET['name']; ?>
  </h1>

  <h2>
    <?php echo $_GET['party'];?>
  </h2>
  <h3>
    News:
  <h3>
</head>
<body>
<?php

    $split_name = explode(" ", $_GET['name']);
    unset($split_name[1]);
    $name = implode(" ", $split_name);

    $news = file_get_contents("https://newsapi.org/v2/everything?q=".urlencode($name)."&searchIn=title,description&sortBy=popularity&language=en&apiKey=".$news_api_key);

    $news = json_decode($news);

    for($i = 0; $i < 3 ; $i++){
      echo "<a href =" . $news->articles[$i]->url .">". $news->articles[$i]->title . "<br/> <font size=\"-1\">" . $news->articles[$i]->description . "</font></a> <br/><br/>";
    }

    $data = file_get_contents("https://www.googleapis.com/civicinfo/v2/representatives?key=")
  ?>
</body>
</html>
