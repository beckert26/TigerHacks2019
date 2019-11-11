<html lang="en">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Tiger Hacks 2019</title>
        <script src="Th19.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Th19.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    </head>
<body>
  <div id="searchWrapper">
  <h1 class="title">
                <span>V</span>
                <span>i</span>
                <span>b</span>
                <span>e</span>
                &nbsp
                <span>C</span>
                <span>h</span>
                <span>e</span>
                <span>c</span>
                <span>k</span>
                
    </h1>
    <div >
      <div id="apercent" class="diffpercent"></div>
      <div id="fpercent" class="diffpercent"></div>
      <div id="jpercent" class="diffpercent"></div>
      <div id="spercent" class="diffpercent"></div>
      <div id="anpercent" class="diffpercent"></div>
      <div id="cpercent" class="diffpercent"></div>
      <div id="tpercent" class="diffpercent"></div>
    </div>
    <div class="divsearch">
        <input id="search" type="text" placeholder="Search for a Movie..." onkeydown="call(event)" autocomplete="off">
        <button id="searchbutton" onclick="search()">Search</button>
    </div>
    
    <div id="searchResults">
      <ul id="resultslist">
            &nbsp
      </ul>
    </div>
  </div>

    <?php
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);

      $servername = "localhost";
      $username = "th2019";
      $password = "brett";
      $dbname = "Movie";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT movie_title FROM Movie_Scripts";
      $result = $conn->query($sql);
      $arr=[];
      while($row = $result->fetch_assoc()){
          array_push($arr, $row["movie_title"]);
      }

      mysqli_close($conn);
     ?>
     <script>
        var titleArray = <?php echo json_encode($arr); ?>;

        // Get the input field
        var input = document.getElementById("search");

        // Execute a function when the user releases a key on the keyboard
        input.addEventListener("keyup", function(event) {
          // Number 13 is the "Enter" key on the keyboard
          if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("searchbutton").click();
            search();
          }
        });
      
      
        window.onload = function () {
            document.getElementById("search").focus();
        };
     </script>

</body>
</html>
