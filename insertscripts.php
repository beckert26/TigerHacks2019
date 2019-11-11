<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$log_directory="scripts";

$servername = "localhost";
$username = "th2019";
$password = "brett";
$dbname = "Movie";
$x=0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

foreach(glob($log_directory.'/*.*') as $file) {
    $x++;
    $file= str_replace("'", "\'", $file);
    $title=substr($file, 8, strlen($file)-12);
    echo $x . ".) " . $title . " <br>";
    $sql= "Insert into Movie_Scripts(movie_title, movie_path)
          Values('".$title."','". $file."')";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<br>";
}

mysqli_close($conn);
?>
