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
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.html">Home</a></li>
          <li  class="selected"><a href="login.php">Profile</a></li>
          <li><a href="rating.php">Content Page</a></li>
          <li><a href = "chat.php">Chat</a></li>
          <li><a href = "rec.php">Recommendation</a></li>
        </ul>
      </div>



    </div>
    
    <div id="site_content">
    <?php if($_SESSION["login"] == 0) {?>
      <div id="content">

         <h2>Register</h2>

          <form action="/login.php" method="get">
            Create User Name<br><input type="text" name="name" value=""> <br>
            Create Password<br><input type="password" name="password" value=""> <br>
            <input type="submit" name="register"> <br>
          </form> 

          
          <?php
          if(isset($_GET['register']) && !empty($_GET['name']) && !empty($_GET['password'])){
            $name = $_GET['name'];
            $password = $_GET['password'];
            #$_GET['register'] = NULL; 
            #$anime_id = !empty($_GET['anime_id'])? $_GET['anime_id']: NULL;
            #$genre =$_GET['genre'];
            #$type=$_GET['type'];
            #$episodes =$_GET['episodes'];
            #$rating =$_GET['rating'];
            $search_user = "SELECT COUNT(1) FROM user WHERE '$name'=username";
            $search_result = mysqli_query($db, $search_user);
            $existuser = mysqli_fetch_array($search_result);

            if ($existuser[0] == 0) { 
              
            // $startt = ""
            // $userid = "SELECT MAX(user_id) FROM user";
            // #$uuu = $db->query($userid); 
            // mysqli_query($db, $userid);
            //$row = mysqli_fetch_array($uuu);
            // $result = $row[0];
            // $result++;
	           // $result = $result + 529;
            #echo "UUUUuuuuuuuu: " . $result; 
            $startt = "start transaction"; 
            $selectmax = "SELECT @A:=MAX(user_id) FROM user"; 

            $insert = "INSERT INTO user 
            VALUES(@A + 1, '$password','$name')";
            $commit = "commit"; 
            mysqli_query($db, $startt);
            mysqli_query($db, $selectmax);
            mysqli_query($db, $insert);
            if ($db->query($commit)==TRUE) {
            echo "New user created successfully";
            echo "User name: " . $name; 
            $_GET['register'] = NULL; 
            } 
            else {
            echo "Error: " . $sql . "<br>" . $db->error;
            } 
            }
            else{
              echo "Username already existed. Please try another one.";
            }

          }
          else

            echo "Please enter your information";
         ?>

         <h2>Log In</h2>

          <form action="/login.php" method="get">
            User Name<br><input type="text" name="name" value=""> <br>
            Password<br><input type="password" name="password" value=""> <br>
            <input type="submit" name="login" value="Log in"> <br>
          </form>


          <?php
            $login = 0;
            $_SESSION["login"] = $login;
          if(isset($_GET['login']) && !empty($_GET['name'])){
            
            $name = $_GET['name'];
            $password = $_GET['password'];
            $_GET['login'] = NULL; 
            $search_user = "SELECT COUNT(1) FROM user WHERE '$name'=username";
            $search_result = mysqli_query($db, $search_user);
            $row = mysqli_fetch_array($search_result);
            #echo $row[0]; 
            if ($row[0] == 0) { 
              echo "Username not existed";
            }

            else {
                $check_password = "SELECT COUNT(1) FROM user WHERE '$name'=username and '$password'=password";
                $check_result = mysqli_query($db, $check_password);
                $rownew = mysqli_fetch_array($check_result);

                if ($rownew[0] == 0) {
                    echo "Password not correct";
                }
                else{
                  $login = 1;
                  $getuserid = "SELECT user_id FROM user WHERE '$name'=username and '$password'=password";
                  $getuserid_q = mysqli_query($db, $getuserid);
                  $getuserid_f = mysqli_fetch_array($getuserid_q);
                  $userid = $getuserid_f[0];
                  $_SESSION["login"] = $login;
                  $_SESSION["userid"] = $userid;
                  $_SESSION["username"] = $name;
                  echo " Login successful! Exciting!";
                  if($_SESSION["username"] == "admin"){
                    header("Location:finding.php");
                  }
                  header("Refresh:0");
                }

            }
          }
         ?>
         <script>
              var val = "<?php echo $userid ?>";
              var val2 = "<?php echo $login ?>";
              var val3 = "<?php echo $name ?>"; 
              localStorage.setItem("userid", val);
              localStorage.setItem("login", val2); 
              localStorage.setItem("username", val3); 
          </script>
      </div>
    <?php } else {?>
    <h2>Hello, <?php echo $_SESSION['username']; ?></h2>
    <h2> To log out, please hit</h2>
    <form action="/login.php" method="get">
    <input type="submit" name="logout" value="Log out">
    </form>

    
    <?php  
    if(isset($_GET['logout'])) {
      $_SESSION["login"] = 0;
      header("Refresh:0");
    }} ?>

    

    </div>

    
  </div>
</body>
</html>
