<!DOCTYPE HTML>
<?php $news_api_key = ?>
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

    echo $name;

    $news = file_get_contents("https://newsapi.org/v2/everything?q=".urlencode($name)."&searchIn=title,description&apiKey=".$news_api_key);

    $news = json_decode($news);

    for($i = 0; $i < 3 ; $i++){
      echo $news->articles[$i]->title;
      echo "<br/>";
    }
  ?>
</body>
</html>
