<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include './phpfsplit.php';

  $servername = "localhost";
  $username = "th2019";
  $password = "brett";
  $dbname = "Movie";

  $output;
  $partial = array();

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $title = $_GET['title'];
  $sql = "SELECT movie_path FROM Movie_Scripts WHERE Movie_Scripts.movie_title='" . $title . "'";

  $result = $conn->query($sql);
  $result = $result->fetch_assoc();
  $path = $result['movie_path'];

  mysqli_close($conn);

  $url = "http://ec2-13-58-249-208.us-east-2.compute.amazonaws.com/".$path;
  if(filesize($path)>=20000){
    $parts = fsplit($path, 20000);
    $pathg = './splits';
    $files = glob($pathg.'/'.$title.'.txt'.'.part*');
    //$fullMovie = [];
    $x=0;
    foreach($files as $part){
      exec("curl -X POST -u apikey:\"TFnDrFj6VkSnKPzNck2DOyNA4szVGCXWqakG27IWETvb\" --header \"Content-Type: text/plain\" --data-binary @".$part ." \"https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2017-09-21\"",$output);
      $partial = array_merge($partial, $output);
      //$partial = implode(" ", $output);
      //$fullMovie = json_encode($partial, true);
      //echo var_dump($fullMovie);
      //echo $x;
      //$x++;
      $fullMovie = json_encode($partial, true);
      $output = NULL;

    }
    $json_string = $fullMovie;
  }else{
    //make normal api call
     exec("curl -X POST -u apikey:\"TFnDrFj6VkSnKPzNck2DOyNA4szVGCXWqakG27IWETvb\" --header \"Content-Type: text/plain\" --data-binary @".$path ." \"https://gateway.watsonplatform.net/tone-analyzer/api/v3/tone?version=2017-09-21\"",$output);
     $json_string = json_encode($output);
  }
echo $json_string;
?>
