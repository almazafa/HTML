<?php
	session_start();
	include("inc_db.php");
?>
<!DOCTYPE>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<style>
*{
	text-align:center;
}
#add_event{
	border-radius:3px;
}
.button{
	border:0;
}
</style>

</head>

<body>
	<h1> Daily Events </h1>
		<table border="1" style="width: 75%" align="center">
		<tr><th colspan="3">Activities</th></tr>
		<tr>
			<th>Dog Name</th>
			<th>Description</th>
			<th>Time</th>
		</tr>
<?php
	$query = "SELECT e_event.e_id, dog.d_name ,e_event.e_dtime ,e_event.e_desc FROM dog,e_event".
	" WHERE dog.d_id=e_event.e_dog_id and dog.d_id=".$_SESSION['did']." order by e_dtime";
	//echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
	  $desc=$row['e_desc'];
		echo "<tr id='e".$row['e_id']."' class='tdm' onclick='updateEvent(".$row['e_id'].",".$row['e_dtime'].",\"$desc\")'><td>".
			$row['d_name']."</td><td>".$row['e_desc']."</td><td>".$row['e_dtime']."</td></tr>\n";
	  }
	}
	$result->free();
	$conn->close();
	
	?>
	<tr><td class="button"></td><td class="button"><input name="Button1" type="button" id="add_event" value="הוסף אירוע" onclick="AddNewEvent()" ></td></tr>
</table>
</body>
</html>
