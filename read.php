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

$spam_word_list = array("test","anal","anus","arse","ass","ballsack","balls","bastard","bitch","biatch","bloody",
						"blowjob","blow job","bollock","bollok","boner","boob","bugger","bum","butt",
						"buttplug","clitoris","cock","coon","crap","cunt","damn","dick","dildo","dyke","fag","feck",
						"fellate","fellatio","felching","fuck","f u c k","fudgepacker","fudge packer","flange","Goddamn",
						"God damn","hell","homo","jerk","jizz","knobend","knob end","labia", 
						"lmao","lmfao","muff","nigger","nigga","omg","penis","piss","poop","prick","pube","pussy","queer",
						"scrotum","sex","shit","s hit","sh1t","slut","smegma","spunk","tit","tosser","turd","twat","vagina","wank","whore");

$userId = (string)$_SESSION['userid'];

$fromid = $_SESSION['userid'];
$toName = $_GET["toName"];

$q = "SELECT user_id FROM user WHERE username = '$toName'";
$r = mysqli_query($db, $q) or die('Error querying database.!');
$row = mysqli_fetch_array($r);
if ($row[0] != 0){
	$toid = $row["user_id"];

	if($fromid <= $toid){
		$chatId = (string)$fromid . (string)$toid;
	}
	else{
		$chatId = (string)$toid . (string)$fromid;
	}

	$query = "SELECT * FROM chat WHERE chat_id ='$chatId'";
	mysqli_query($db,$query) or die('Error querying database.!');
	$result = mysqli_query($db, $query);
	$q1 = "SELECT username FROM user WHERE user_id = $fromid";

	$r1 = mysqli_query($db, $q1);

	$row = mysqli_fetch_array($r1);
	$fromusername = $row["username"];


	while($row = mysqli_fetch_array($result)){
	   $text = $row["message"];
	   // $output = "poi";
	   $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

	   $output = $text;
	   foreach ($words as &$word) {
    		if (in_array($word, $spam_word_list)) {
    			$output = "****";
			}
		}	
	   
	  
	   if($row["from_id"] == $fromid){
	   	echo "$fromusername:  $output";
	   }else{
	   	echo "$toName:  $output";
	   }
	   echo "<br>"; 

	}
}else{
	echo "No such user";
}



?>