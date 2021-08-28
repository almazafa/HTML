<?php
	session_start();
	include "inc_db.php";
	$sid=$_REQUEST['sid'];
	
	$query="DELETE FROM s_event WHERE s_id =$sid";
	//echo $query;die();
	$result = $conn->query($query);
	
	$conn->close();
	header('Location: update_special_event.php');

?>
