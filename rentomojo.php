
<?php 
error_reporting(0);

$conn = mysqli_connect("localhost","root","","rentmo");


if(isset($_POST['submit']))
{
    $cid=rand(9,1009);
	$com = $_POST['comment'];
	if($com != NULL){
		$query = "INSERT INTO `comment`(`id`,`comment`) VALUES ('$cid','$com')";
	
	$run= mysqli_query($conn, $query);
		if($run){
			
			echo '<script>window.open("rentomojo.php","_SELF")</script>';

		}else{
			echo "Error: " .$query. "<br>" . $conn->error;
		}
	}

}
if(isset($_POST['upvote']))
{
	$vary = $_POST['upvote1'];

	$query = "select * from `comment` where `id` = '". $vary ."'";
	$result = mysqli_query($conn,$query);

	while($row=mysqli_fetch_array($result)){
		$upvote=$row['up'];
	}
	$upvote = $upvote+1;
	$query ="UPDATE `comment` SET `up`='$upvote' WHERE id='".$vary."'";
	
	
	$RESULT =mysqli_query($conn,$query);
	if($RESULT)
	{
		echo '<script>window.open("rentomojo.php","_SELF")</script>';
		
	}
}

if(isset($_POST['downvote']))
{
	$vary = $_POST['downvote1'];
	$query = "select * from `comment` where `id` = '". $vary ."'";
	$result = mysqli_query($conn,$query);

	while($row=mysqli_fetch_array($result)){
		$downvote=$row['down'];
	}
	$downvote = $downvote+1;
	$query ="UPDATE `comment` SET `down`='$downvote' WHERE id='".$vary."'";
	
	
	$RESULT =mysqli_query($conn,$query);
	if($RESULT)
	{
		echo '<script>window.open("rentomojo.php","_SELF")</script>';
		
	}
}


?>




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

div.relative {
  position: relative;
  width: 800px;
  height: 500px;
  border: 3px solid #73AD21;
  margin-top: 40px;
  margin-left: 250px;
  margin-right: 100px;
  margin-bottom: 50px;
  overflow: scroll;
}

div.comment {
  position: relative;
  
  margin-top: 20px;
  margin-left: 20px;
  margin-right: 20px;
  margin-bottom: 400px;
} 

.button {
  background-color: #FF0000; /* Green */
  border: none;
  color: white;
  padding: 12px 30px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #FF0000;
}

.button1:hover {
  background-color: #FF0000;
  color: white;
}

 <script>
 
 function count(){
	var counter = 0;
	counter++;
	console.log( counter);
	 
 }
 
 </script>

</style>
</head>
<body>

<div class="topnav"></div>


	<div class="relative" style="border: 3px solid #73AD21;">
		<div class = "comment">	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<textarea class="form-control" rows="3" placeholder="Type a Comment..." name="comment" style="width:740px; height:68px;"></textarea>
			<div class="col-lg-9">
				<button class="button button1" name="submit" style="margin-left:593px;">Comment</button>
			</div>
			</form>
			
			
			<?php
			echo '<br><br><br><br>';
			$count = 1;
			$query = "select * from `comment` where 1";
			$result = mysqli_query($conn, $query);

		     while($row=mysqli_fetch_array($result)){
			
			  $rar=$row['comment'];
			  $up=$row['up'];
			  $down=$row['down'];

			  ?>
			  
			  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			  <input type = 'text' name = 'upvote1' value = <?php echo $cid = $row['id']; ?> hidden>
			  <input type = 'text' name = 'downvote1' value = <?php echo $cid = $row['id']; ?> hidden>
			  <?php
			  
			  echo $count.'&nbsp&nbspAuthor :  <button class="glyphicon glyphicon-thumbs-up" name="upvote" style="margin-left:600px;"></button>&nbsp&nbsp'.$up.
			  
			 '<button class="glyphicon glyphicon-thumbs-down"  name="downvote" style="margin-left:668px;"></button>&nbsp&nbsp'.$down.
			  "<br>".$rar;  // Author should be replaced with the user name.
			  echo '<br><br><br>';
			  $count++;
			 ?>
			 </form>
			 
			 <?php
				
		}
		?>
		</div>
	</div>


</body>
</html>
