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

<html>
<head>
 	<style>
 	table, th, td{
 		border: 1px solid black;
 	}
 	body{
 		background-image: url("https://images.unsplash.com/photo-1482977036925-e8fcaa643657?w=668&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D");
 	}	
 	</style>	
</head>

<h1> This is a demo from DB+ </h1>
<body>

<?php

/* $query = "SELECT name, genre, type FROM anime WHERE name='Gintama'";*/
 
# $insert = "INSERT INTO anime (anime_id,name,genre,type,episodes,rating,members) 
 #VALUES('001','Tom.B','commedy','TV','32','1','13342')";

# if ($db->query($insert)==TRUE) {
#    echo "New record created successfully";
# } else {
#     echo "Error: " . $sql . "<br>" . $db->error;
# }

#$query = "SELECT name,genre,type FROM anime WHERE name = 'Tom.B'";
# mysqli_query($db,$query) or die('Error querying database.');
# $result = mysqli_query($db,$query);
# $row = mysqli_fetch_array($result);
#echo $row['name'] . $row['genre'] . $row['type'] . '<br/>';"""
#mysqli_close($db);
$query = "SELECT * FROM anime";
mysqli_query($db,$query) or die('Error querying database.!');
$result = mysqli_query($db,$query);
#$row = mysqli_fetch_array($result); 
?>

<table style ='width:100%'>
<tr>
	<th>Anime ID</th>
	<th>Name</th>
	<th>Genre</th>
	<th>Type</th>
	<th>Episodes</th>
	<th>Rating</th>
	<th>Members</th>
</tr>	

<?php while( $row = mysqli_fetch_array($result)): ?>
<tr>
	<td><?php echo $row['anime_id']; ?></td>
	<td><?php echo $row['name']; ?></td>
	<td><?php echo $row['genre']; ?></td>
	<td><?php echo $row['type']; ?></td>
	<td><?php echo $row['episodes']; ?></td>
	<td><?php echo $row['rating']; ?></td>
	<td><?php echo $row['members']; ?></td>
</tr>
<?php endwhile ?>

</table>

</body>
</html>


























