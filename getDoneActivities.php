<?php
	session_start();
	$date=$_SESSION['today'];
	$did=$_SESSION['did'];
	
	include "inc_db.php";
	
	$query="SELECT l_event from log where( l_dog_id=$did and l_event in(select e_id from e_event WHERE e_dog_id=$did) and Date(l_datetime)=\"$date\")";
	//echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
		echo "e".$row['l_event'].";";
	  }
	}
	
	$result->free();
	$conn->close();



?>