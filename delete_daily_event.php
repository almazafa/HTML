<?php
	session_start();
	include "inc_db.php";
	$eid=$_REQUEST['eid'];
	
	$query="DELETE FROM e_event WHERE e_id =$eid";
	$result = $conn->query($query);
	
	$conn->close();
	header('Location: update_daily_event.php');

?>
