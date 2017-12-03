
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


$fromid = $_SESSION['userid'];
$toName = $_GET["toName"];

$q = "SELECT user_id FROM user WHERE username = '$toName'";
$r = mysqli_query($db, $q) or die('Error querying database.!');
$row = mysqli_fetch_array($r);
$toid = $row["user_id"];

if($fromid <= $toid){
	$chatId = (string)$fromid . (string)$toid;
}
else{
	$chatId = (string)$toid . (string)$fromid;
}

$text = $_GET["text"];

echo $fromid;
echo $text;
echo $chatId;
//escaping is extremely important to avoid injections!
// $nameEscaped = htmlentities(mysqli_real_escape_string($db,$username)); //escape username and limit it to 32 chars
// $textEscaped = htmlentities(mysqli_real_escape_string($db, $text)); //escape text and limit it to 128 chars

$query = "INSERT INTO chat(chat_id, message, from_id) VALUES('$chatId','$text','$fromid')";
$db->query($query);

$db->close();


?>
