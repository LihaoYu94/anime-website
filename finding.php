<?php
$servername = "localhost";
$username = "root";
$password = "DBplus03";
$database = "Anime";
$db = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()){
    echo "Database connection failed: " . mysqli_connect_error();
}
session_start();
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
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on 
          <li><a href="index.html">Home</a></li>
          <li><a href="login.php">Profile</a></li>
          <li class="selected"><a href="finding.php">Content Page</a></li>
          <li><a href = "chat.php">Chat</a></li>
          <li><a href = "rec.php">Recommendation</a></li> -
          <li><a href="login.php">Profile</a></li>-->
          <li class="selected"><a href="finding.php">Admin page</a></li>

        </ul>
      </div>



    </div>
    <div id="site_content">
      
      <div id="content">



        <h2>Insert</h2>

         <form action="/finding.php" method="get">
           Name<br><input type="text" name="name" value=""> <br>
           Genre<br><input type="text" name="genre" value=""> <br>
           Type<br><input type="text" name="type" value=""> <br>
           Episodes<br><input type="text" name="episodes" value=""> <br>
           Rating<br><input type="text" name="rating" value=""> <br>
           <input type="submit" name="Submit">
         </form>

          <?php
          if(isset($_GET['Submit']) && !empty($_GET['name'])){
            $name = $_GET['name'];
            #$anime_id = !empty($_GET['anime_id'])? $_GET['anime_id']: NULL;
            $genre =$_GET['genre'];
            $type=$_GET['type'];
            $episodes =$_GET['episodes'];
            $rating =$_GET['rating'];
            $insert = "INSERT INTO anime 
            VALUES('1','$name','$genre','$type','$episodes','$rating','1')";
            if ($db->query($insert)==TRUE) 
            {
            echo "New record created successfully";
            $_GET['Submit'] = NULL;
            } 
            else 
            {
            echo "Error: " . $sql . "<br>" . $db->error;
            } 
          }
          else
            
            echo "Please enter an anime name to insert" 
          
         ?>

        <h2>Search</h2>

         <form action="/finding.php" method="get">
           Attribute<br>
           <input type="text" name="attr" value=""><br>
           Value<br>
           <input type="text" name="cond" value=""><br>
           Precise Search?<br>
           <input type="text" name="prec" value=""><br>
           <input type="submit" name="Submit1">
         </form>

          <?php
            if(isset($_GET['Submit1'])){
            $attr = $_GET['attr'];
            $cond = $_GET['cond'];
            $prec = $_GET['prec'];
            $_GET['Submit1'] = NULL; 
            if($prec == "F")
                $search = "SELECT * FROM anime WHERE $attr LIKE '%$cond%' LIMIT 10";
            else
                $search = "SELECT * FROM anime WHERE $attr = '$cond'";
	          mysqli_query($db,$search) or die('Error querying database.!');
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
             <th>Members</th>
         </tr>
         <?php while( $row = mysqli_fetch_array($result)): ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['episodes']; ?></td>
            <td><?php echo $row['rating']; ?></td>
            <td><?php echo $row['members']; ?></td>
        </tr>
        <?php endwhile ?>
       </table>

  
        <h2>Delete By Anime Name</h2>
        <form action="/finding.php" method="get">
         <input type="text" name="name" value=""><br>
         <input type="submit" name="Submit2">
        </form>

        <?php
        if(isset($_GET['Submit2'])){
          $name = $_GET['name'];
          $_GET['Submit2'] = NULL;
          $delete = "DELETE FROM anime 
          WHERE name='$name'";

          if ($db->query($delete)==TRUE) {
          echo "The record deleted successfully";

          } else {
          echo "Error: " . $sql . "<br>" . $db->error;
          } 
        } 
        ?>

        <h2>Update</h2>
	        <form action="/finding.php" method="get">
          Attribute to Change<br><input type="text" name="attr" value=""><br>
          Value to Change<br><input type="text" name="change"><br>
          Condition<br><input type="text" name="cond"><br>
          Value<br><input type="text" name="value"><br>
          <input type="submit" name="Submit3"><br>
          </form>

	        <?php
	        if(isset($_GET['Submit3'])){
          $attr = $_GET['attr'];
	        $change = $_GET['change'];
	        $cond = $_GET['cond'];
          $value = $_GET['value'];
          $_GET['Submit3'] = NULL;
          $update = "UPDATE anime SET $attr='$change' 
          WHERE $cond='$value'";

          if ($db->query($update)==TRUE) {
          echo "The record updated successfully";

          } else {
          echo "Error: " . $sql . "<br>" . $db->error;
          }
	        }
       	  ?>

        <form action="/login.php" method="get">
          <br> <br> <br>
        <input type="submit" name="Submit4", value = "Log out"><br>
        </form>
        <?php
          if(isset($_GET["Submit4"])){
            $_SESSION["login"] = 0;
          }
        ?>
	



      </div>
    </div>
  </div>
</body>
</html>
