<?php
	session_start();
	include "inc_db.php";
	$eid=$_REQUEST['eid'];
	$time=$_REQUEST['new_time'];
	$desc=$_REQUEST['new_desc'];
	$did=$_SESSION['did'];

	$query = "UPDATE e_event SET e_dtime=".$time.", e_desc=\"$desc\" WHERE e_id=$eid" ;
	//echo $query; die();
	$result = $conn->query($query);
	$conn->close();
	header('Location: update_daily_event.php');
?>
