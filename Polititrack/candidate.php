<!DOCTYPE HTML>
<?php
  session_start();

  $news_api_key = "a45cb211e1eb4d159d3c5b3ae44ba4ad";
  $google_civ_key = "AIzaSyCFEsS-7b9psbDHXd5x9gviJxTSuzsAbxs";

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
      mysqli_close($connection);
      include("login.php");
      die();
    }





?>
<html>
<title>
  <?php echo $_GET['name']?> | Polititrack
</title>

<head>
  <h1>
    <?php echo $_GET['name']; ?>
  </h1>

  <h2>
    <?php
      $state = str_replace('_', ' ', $_GET['state']);
      echo $state . ", " . $_GET['party'];
      ?>
  </h2>

  <h3>
    Summary:
  </h3>


  <?php

    $split_name = explode(" ", $_GET['name']);

    foreach($split_name as &$namePart){
      if(strcmp($namePart, "Jr.") === 0){
        $namePart = "";
      }
    }

    $name = implode(" ", $split_name);

    $data = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&prop=info&list=prefixsearch&pssearch=".urlencode($name)."&format=json");
    $data = json_decode($data);

    

    if(count($data->query->prefixsearch)!= 0){
      foreach($data->query->prefixsearch as $item){

        similar_text($name, $item->title, $perc);




        if($perc > 90){
          $doc = new DOMDocument();
          $doc->loadHTML(file_get_contents("https://en.wikipedia.org?curid=$item->pageid"));

          $summary = $doc->getElementsByTagName('p');


          for($i = 0; $i < $summary->length ; $i++){
            if(strlen($summary->item($i)->nodeValue) < 3){
                continue;
            }

            echo $summary->item($i)->nodeValue;
            break;
          }
        }
      }
    }
    else{

      echo "We could not find information regarding this candidate. <br/>";
    }





     //
     // echo "<pre>";
     // var_dump($data);
     // echo "</pre>";
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




    //loginRequestWiki(getLoginTokenWiki());




    mysqli_close($connection);
  ?>
</body>
</html>
