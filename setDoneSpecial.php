<?php
	// set special event as done

	session_start();
	include "inc_db.php";	

	$seid = $_REQUEST['sid'];

	$query = "UPDATE s_event SET s_status=1 WHERE s_id=".$seid;
	
	$result = $conn->query($query);
	$query = "select s_id from s_event where s_dog_id=".$_SESSION['did'].
	" and date(s_datetime) = \"".$_SESSION['today']."\" and s_status=1";
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
		echo "s".$row['s_id'].";";
		}
	  
	}
	$result->free();
	$conn->close();
?>
