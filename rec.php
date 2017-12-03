<?php
$servername = "localhost";
$username = "root";
$password = "DBplus03";
$database = "Anime";
$db = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()){
    echo "Database connection failed: " . mysqli_connect_error();
}
?>


<!DOCTYPE HTML>
<html>

<head>
  <title>cs411</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <style>
  body{background-image: url(111.png);background-size: 100%;background-repeat: repeat;position: relative;overflow-y: scroll;}
  table, th, td{
    border: 1px solid black;
  }
  </style>
</head>




<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <!-- class="logo_colour", allows you to change the colour of the text -->
        <h1><a href="index.html">Anime Recommendation Website</span></a></h1>
        <h2>A Product of DB+ Group.</h2>
      </div>

      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.html">Home</a></li>
          <li><a href="login.php">Profile</a></li>
          <li><a href="rating.php">Content Page</a></li>
          <li><a href = "chat.php">Chat</a></li>
          <li class="selected"><a href = "rec.php">Recommendation</a></li>

        </ul>
      </div>



    </div>
    <div id="site_content">
      
      <div id="content">



        <h2>Recommendation</h2>

        <div>
          Try this recommendation feature! Based on your previous preference, we can give you suggestions on your next 
          favorite animes. 
         </div>

         <form action="/rec.php" method="get">
           <!--<input type="button" value="Give me some!" name = "Submit" onclick="location='rec.php'" />-->
           <input type="submit" name="Submit" value="Give me some!">
         </form>
         <script> var userid = localStorage.getItem("userid"); </script>
         

          <?php

          session_start();
          if(isset($_GET['Submit'])) {
            //echo "button pressed";
            $user_id = $_SESSION["userid"];
            $user_name = $_SESSION["username"];
            echo "Hi " . $user_name . ":    ";
            echo "Here are what you may interested in: ";
            //echo $user_id;
            #$user_id = 8;
            $view = "CREATE VIEW Getrec AS SELECT A.anime_id as anime_id, U.user_id as user_id from user U, rating R, anime A where U.user_id=R.user_id and R.anime_id=A.anime_id order by R.rating desc limit 1"; 
            mysqli_query($db, $view);

            $search = "SELECT * from Getrec where user_id = '$user_id'";

           // mysqli_query($db,$search) or die('Error querying database.!');
            $result = mysqli_query($db, $search);
            $row = mysqli_fetch_array($result);
            //echo $row[0];
            // while( ){
            //   echo $row[0];
             }

          else
            echo "Please login and hit the botton!"; 
          
            //$output = passthru("python test.py $row[0]");
            //$python = `python helloworld.py`;
            //echo $output; 
            exec("python test.py $row[0]", $output);
            //var_dump($output);
            // echo "php: " . $output[0];
            // echo "php: " . $output[1];
            // echo "php: " . $output[2];

            $time_start = microtime(true);
            $recom = "SELECT * FROM anime WHERE anime_id = $output[0] or anime_id = $output[1] or anime_id = $output[2]"; 
            //mysqli_query($db,$recom) or die('Error querying database.!');
            $recresult = mysqli_query($db, $recom);

            $time_end = microtime(true);
            $time = $time_end - $time_start;
            echo "time: " . $time;
          ?> 

          <table style ='width:100%'>
         <tr>
             <th>Anime_ID</th>
             <th>Name</th>
             <th>Genre</th>
             <th>Type</th>
             <th>Episodes</th>
             <th>Rating</th>
         </tr>
         <?php while( $recrow = mysqli_fetch_array($recresult)): ?>
         <tr>
            <td><?php echo $recrow['anime_id']; ?></td>
            <td><?php echo $recrow['name']; ?></td>
            <td><?php echo $recrow['genre']; ?></td>
            <td><?php echo $recrow['type']; ?></td>
            <td><?php echo $recrow['episodes']; ?></td>
            <td><?php echo $recrow['rating']; ?></td>
        </tr>
        <?php endwhile ?>
       </table>
	



      </div>
    </div>
  </div>
</body>
</html>
