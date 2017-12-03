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

    #wrapper {
    position: relative;
    margin:15px auto;
    padding-bottom:25px;
    background:#EBF4FB;
    width:700px;
    height: 400px;
    background: rgba(0,0,0,0);  }

    #chatbox {
      position:absolute;
      left:20px;
      text-align:left;
      
      margin-bottom:25px;

      padding:10px;
      background:#fff;
      height:270px;
      width:430px;
      border:1px solid #ACD8F0;
      overflow:auto; }
    #search_people {
      position: absolute;
      left:20px;
      margin-top:0px;
      width:430px;
      border:1px solid #ACD8F0; }

    #usermsg {
      position: absolute;
      padding:10px;
      left:20px;
      margin-top:300px;
      width:430px;
      border:1px solid #ACD8F0; }
      
    #submitmsg {
      position: absolute;
      margin-top: 340px;
      left: 20px;
      width: 60px; }

    .error { color: #ff0000; }

    #menu1 { padding:12.5px 25px 12.5px 25px;
            height:10px; width:500px;

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
                <li class="selected"><a href = "chat.html">Chat</a></li>
                 <li><a href = "rec.php">Recommendation</a></li>
              </ul>
      </div>

      <div id="site_content">
          <div id ="wrapper"> 
              <input name="search_people" type="text" placeholder="Who are you look for" id="search_people" size="63" value = "" />
              <div id="menu1">
                  <p class="welcome">Welcome, <?php echo $_SESSION['username']; ?>. You are now chatting with</p>
                  
              </div>
              
              
              <div id="chatbox"></div>
               
              
              <input name="usermsg" type="text" placeholder="Say something" id="usermsg" size="63" />
              <button id="submitmsg" >Send</button>
          </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script type="text/javascript">
          //jquery document
          $(document).ready(function(){
            var chatInterval = 1000;
            var $chatOutput = $("#chatbox");
            var $chatInput = $("#usermsg");
            var $chatSend =$("#submitmsg");
            

            function sendMsg(){
              var toName = $("#search_people").val();
              if (toName != ''){
                var chatInputSting = $chatInput.val();
                $.get("./write.php",{
                  text: chatInputSting,
                  toName: toName
                });
                retrieveMsg();
              }
            
            } 

            function retrieveMsg(){

              var toName = $("#search_people").val();
              if(toName != ''){
                $.get("./read.php",{toName: toName},function(data){
                  $chatOutput.html(data);
                });
              }
            }

            $chatSend.click(function(){
              sendMsg();
              $chatInput.val('');
            })

            setInterval(function(){
              retrieveMsg();
            },chatInterval); 
          });
      
          </script>
</body>
</html>
