<?php
	session_start();
	include("inc_db.php");
	
	
	echo '<h1> Events for '.$_SESSION['today'].'</h1>
		<table border="1" style="width: 75%" align="center">
		<tr><th colspan="3">Activities</th></tr>
		<tr>
			<th>Dog Name</th>
			<th>Description</th>
			<th>Time</th>
		</tr>';

	$query = "SELECT e_event.e_id, dog.d_name ,e_event.e_dtime ,e_event.e_desc FROM dog,e_event".
	" WHERE dog.d_id=e_event.e_dog_id and dog.d_id=".$_SESSION['did']." order by e_dtime";
	//echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
		echo "<tr id='e".$row['e_id']."' class='tdm1' onclick='setDone(".$row['e_id'].")'><td>".
			$row['d_name']."</td><td>".$row['e_desc']."</td><td>".$row['e_dtime']."</td></tr>\n";
	  }
	}
	echo '</table>';
	$result->free();
	$conn->close();
?>