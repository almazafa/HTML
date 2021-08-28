<?php
	session_start();
	include "inc_db.php";
	$did=$_SESSION['did'];
	$time=$_REQUEST['new_date'];
	$desc=$_REQUEST['new_desc'];
	$query= "insert into s_event(s_dog_id,s_datetime,s_desc,s_status) values ($did,\"$time\",\"$desc\",0)";
	//echo $query;die();
	$result=$conn->query($query);
	$conn->close();
	header('Location: update_special_event.php');

?>