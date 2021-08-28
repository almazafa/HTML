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
<script>
function to2digits(ds)
{
	if (ds < 10) 
	return '0' + ds;
	else return ds;
}

</script>
</head>

<body>
	<h1> Special Events </h1>
	<table border="1" style="width: 500px" align="center"><tr><th>Description</th><th>Date</th><th>Time</th></tr>

	<?php $query = "select s_id,time(s_datetime) as time, minute(s_datetime) as minute,date(s_datetime) as date,s_desc,s_status from s_event where s_dog_id="
	.$_SESSION['did']." and s_status=0 order by time";
	//echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{	
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
	  	$date=$row['date'];
	  	$time=$row['time'];
	  	$desc=$row['s_desc'];
		echo "<tr id='s".$row['s_id']."' class='tdm' onclick='updateSpecial(".$row['s_id'].",\"$date\",\"$time\",\"$desc\")'><td>".
			$row['s_desc']."</td><td>".$date."</td><td>".$time."</td></tr>\n";
	  }
	}
	echo '</table>';
	$result->free();
	$conn->close();
	
	?>
	<tr><td class="button"></td><td class="button"><input name="Button1" type="button" id="add_event" value="הוסף אירוע" onclick="AddNewEvent_s()" ></td></tr>
</table>
</body>
</html>
