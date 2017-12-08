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
          <li class="selected"><a href="rating.php">Content Page</a></li>
          <li><a href = "chat.php">Chat</a></li>
           <li><a href = "rec.php">Recommendation</a></li>
        </ul>
      </div>



    </div>
    <div id="site_content">
      
      <div id="content">



        <h2>Rate an Anime</h2>

         <form action="/rating.php" method="get">
          <!--  Anime Name to Insert<br><input type="text" name="name" value=""> <br>
           Rating<br><input type="text" name="rating" value=""> <br>
           <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="Submit" value="button" /></p > -->
           <!--<input type="submit" name="Submit">-->

          <div class="form_settings">

          <p><span>Anime Name to Rate</span><input type="text" name="name" value="" /></p>
          <p><span>Your Rating</span><input type="text" name="rating" value="" /></p>
          <p style="padding-top: 5px" align="left"><input class="submit" type="submit" name="Submit" value="Insert!" /></p >
        </div>
         </form>

          <?php
          if(isset($_GET['Submit']) && !empty($_GET['name'])){
            
            //echo $userid;
            $stmt = $db->prepare("INSERT INTO rating VALUES(?, ?, ?)");

            $stmt->bind_param("iid", $userid, $anime_id_, $rating);

            session_start();
            $userid = $_SESSION["userid"];

            $name = $_GET['name'];

            $rating = $_GET['rating'];
            $getaid = "SELECT anime_id FROM anime WHERE name = '$name'";

            $result = mysqli_query($db, $getaid);
            $anime_id = mysqli_fetch_array($result);
            $anime_id_ =  $anime_id[0];
            //echo $anime_id[0];

            // $insert = "INSERT INTO rating 
            // VALUES('$userid', '$anime_id[0]', '$rating')";
            $_GET['Submit'] = NULL;
            
            $stmt->execute();
            echo "New rating inserted successfully! ";
            $stmt->close();


          }
          else
            
            echo "Please enter an anime name and a score to insert. " 
          
         ?>

  

        <h2>Update My Rating</h2>
	        <form action="/rating.php" method="get">
            <div class="form_settings">
<!--           Anime Name to Update<br><input type="text" name="name" value=""><br>
          Rating to Change<br><input type="text" name="rating"><br>
          <input type="submit" name="Submit3"><br> -->
          <p><span>Anime Name to Rate</span><input type="text" name="name" value="" /></p>
          <p><span>Your New Rating</span><input type="text" name="rating" value="" /></p>
          <p style="padding-top: 5px" align="left"><input class="submit" type="submit" name="Submit3" value="Update!" /></p >
        </div>
          </form>

	        <?php
	        if(isset($_GET['Submit3'])){

            $name = $_GET['name'];
          $rating = $_GET['rating'];
          $_GET['Submit3'] = NULL;

            session_start();
          $userid = $_SESSION["userid"];
          //echo $userid;
          $name = $_GET['name'];

          //$rating = $_GET['rating'];
          $getaid = "SELECT anime_id FROM anime WHERE name = '$name'";

          $result = mysqli_query($db, $getaid);
          $anime_id = mysqli_fetch_array($result);

          $update = "UPDATE rating SET rating = '$rating' 
          WHERE user_id='$userid' and anime_id = '$anime_id[0]'";

          if ($db->query($update)==TRUE) {
          echo "The record updated successfully. ";

          } else {
          echo "Error: " . $sql . "<br>" . $db->error;
          }
	        }
       	  ?>



        <h2>Delete My Rating</h2>
        <form action="/rating.php" method="get">
<!--           Anime Name to Delete<br>
         <input type="text" name="name" value=""><br>
         <input type="submit" name="Submit2"> -->
         <div class="form_settings">

          <p><span>Anime Name to Delete</span><input type="text" name="name" value="" /></p>
          <p style="padding-top: 5px" align="left"><input class="submit" type="submit" name="Submit2" value="Delete!" /></p >
        </div>
        </form>

        <?php
        if(isset($_GET['Submit2'])){
          $name = $_GET['name'];
          $_GET['Submit2'] = NULL;


          session_start();
          $userid = $_SESSION["userid"];
          //echo $userid;
          $name = $_GET['name'];

          //$rating = $_GET['rating'];
          $getaid = "SELECT anime_id FROM anime WHERE name = '$name'";

          $result = mysqli_query($db, $getaid);
          $anime_id = mysqli_fetch_array($result);

          $delete = "DELETE FROM rating 
          WHERE anime_id = '$anime_id[0]' and user_id = '$userid'";

          if ($db->query($delete)==TRUE) {
          echo "The record deleted successfully.";

          } else {
          echo "Error: " . $sql . "<br>" . $db->error;
          } 
        } 
        ?>




        <h2>Get Anime Info</h2>

         <form action="/rating.php" method="get">
          <div class="form_settings">
<!--            Attribute<br>
           <input type="text" name="attr" value=""><br>
           Value<br>
           <input type="text" name="cond" value=""><br>
           Precise Search?<br>
           <input type="text" name="prec" value=""><br>
           <input type="submit" name="Submit1"> -->

           <p><span>Attribute</span><input type="text" name="attr" value="" /></p>
           <p><span>Value</span><input type="text" name="cond" value="" /></p>
           <p><span>Want Precise Search?</span><input type="text" name="prec" value="" /></p>
           <p style="padding-top: 5px" align="left"><!-- <span></span> --><input class="submit" type="submit" name="Submit1" value="Get Info!" /></p >
         </div>
         </form>

          <?php
            if(isset($_GET['Submit1'])){
            $attr = $_GET['attr'];
            $cond = $_GET['cond'];
            $prec = $_GET['prec'];
            $_GET['Submit1'] = NULL; 
            if($prec == "F")
                $search = "SELECT name, genre, type, episodes,rating FROM anime WHERE $attr LIKE '%$cond%' LIMIT 10";
            else
                $search = "SELECT name, genre, type, episodes,rating FROM anime WHERE $attr = '$cond'";
            //mysqli_query($db,$search) or die('Error querying database.!');
            $result = mysqli_query($db, $search);
            #while($row = mysqli_fetch_array($result)){
            #    echo $row['anime_id'] . ' ';
            #    echo $row['name'] . ' ';
            #    echo $row['genre']. ' ';
            #    echo $row['type']. ' ';
            #    echo $row['episodes'].' ';
            #    echo $row['rating']; 
            #    echo "<br>";  
           #}
          }
         ?>

         <table style ='width:100%'>
         <tr>
             <th>Name</th>
             <th>Genre</th>
             <th>Type</th>
             <th>Episodes</th>
             <th>Rating</th>
         </tr>
         <?php while( $row = mysqli_fetch_array($result)): ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['episodes']; ?></td>
            <td><?php echo $row['rating']; ?></td>

        </tr>
        <?php endwhile ?>
       </table>



        <h2>Want to know how many people like this anime? </h2>

         <form action="/rating.php" method="get">
           <!-- Anime -->
           <!-- <input type="text" name="name" value=""><br> -->
           <!-- <form action="#" method="post"> -->


           <!--<input type="submit" name="Submit10">-->
	   <div class="form_settings">
      <p><span>Anime to explore</span><input type="text" name="name" value="" /></p>
	     <p style="padding-top: 5px" align="left"><!-- <span></span> --><input class="submit" type="submit" name="Submit10" value="Submit!" /></p >
	   </div>

         </form>

         <?php
            if(isset($_GET['Submit10'])){
            $name = $_GET['name'];
            // $cond = $_GET['cond'];
            // $prec = $_GET['prec'];
            $_GET['Submit10'] = NULL; 
            // if($prec == "F")
            //     $search = "SELECT * FROM anime WHERE $attr LIKE '%$cond%' LIMIT 10";
            // else
            // $approx = "alter session set approx_for_aggregation = 'TRUE'"; 
            // $approx2 = "approx_for_count_distinct = 'TRUE'";

            // mysqli_query($db, $approx);
            // mysqli_query($db, $approx2);

            //$index = "CREATE INDEX ``"

            $searcha = "SELECT A.name, count(distinct(user_id)) FROM anime A, rating R 
             WHERE A.anime_id = R.anime_id and R.rating > 6 and A.name LIKE '%$name%'";
            //mysqli_query($db,$search) or die('Error querying database.!');
            $resulta = mysqli_query($db, $searcha);
            //$row = mysqli_fetch_array($resulta);
            //echo $row[0];
            #while($row = mysqli_fetch_array($result)){
            #    echo $row['anime_id'] . ' ';
            #    echo $row['name'] . ' ';
            #    echo $row['genre']. ' ';
            #    echo $row['type']. ' ';
            #    echo $row['episodes'].' ';
            #    echo $row['rating']; 
            #    echo "<br>";  
           #}
          }
         ?>


         <table style ='width:100%'>
         <tr>
             <th>Anime Name</th>
             <th>#People Like</th>

         </tr>
         <?php while( $row = mysqli_fetch_array($resulta)): ?>
         <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>

        </tr>
        <?php endwhile ?>
       </table>



        <h2>See what's the most popular (TOP 20) anime! </h2>

         <form action="/rating.php" method="get">
          <div class="form_settings">
           <p style="padding-top: 5px" align="left"><!-- <span></span> --><input class="submit" type="submit" name="Submit11" value="Get Top 20!" /></p >
         </div>
           <!-- <input type="submit" name="Submit11"> -->
         </form>

         <?php
            if(isset($_GET['Submit11'])){
            // $cond = $_GET['cond'];
            // $prec = $_GET['prec'];
            $_GET['Submit11'] = NULL; 
            // if($prec == "F")
            //     $search = "SELECT * FROM anime WHERE $attr LIKE '%$cond%' LIMIT 10";
            // else
            // $approx = "alter session set approx_for_aggregation = 'TRUE'"; 
            // $approx2 = "approx_for_count_distinct = 'TRUE'";

            // mysqli_query($db, $approx);
            // mysqli_query($db, $approx2);

            $index = "CREATE INDEX `rating_id` ON  `anime`(`anime_id`)";

            $resindx = mysqli_query($db, $index);

            $searcha = "select A.name, COUNT(R.user_id) as num_like from anime A inner join rating R on A.anime_id = R.anime_id where R.rating > 7 GROUP BY A.name ORDER BY COUNT(R.user_id) DESC LIMIT 20"; 

            //mysqli_query($db,$search) or die('Error querying database.!');
            $resulta = mysqli_query($db, $searcha);
            //$row = mysqli_fetch_array($resulta);
            //echo $row[0];
            #while($row = mysqli_fetch_array($result)){
            #    echo $row['anime_id'] . ' ';
            #    echo $row['name'] . ' ';
            #    echo $row['genre']. ' ';
            #    echo $row['type']. ' ';
            #    echo $row['episodes'].' ';
            #    echo $row['rating']; 
            #    echo "<br>";  
           #}
          }
         ?>


         <table style ='width:100%'>
         <tr>
             <th>Anime Name</th>
             <th>#People Like</th>

         </tr>
         <?php while( $row = mysqli_fetch_array($resulta)): ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['num_like']; ?></td>

        </tr>
        <?php endwhile ?>
       </table>




      </div>
    </div>
  </div>
</body>
</html>
