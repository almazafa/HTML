<?php
	session_start();
	include "inc_db.php";
	$did=$_SESSION['did'];
	$desc=$_REQUEST['new_desc'];
	$time=$_REQUEST['new_time'];
	
	$query= "insert into e_event(e_dog_id,e_dtime,e_desc) values ($did,$time,\"$desc\")";
	//echo $query;die();
	$result=$conn->query($query);
	$conn->close();
	header('Location: update_daily_event.php');

?>