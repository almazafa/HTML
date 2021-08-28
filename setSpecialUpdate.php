<?php
	session_start();
	include "inc_db.php";
	$sid=$_REQUEST['sid'];
	$time=$_REQUEST['new_date'];
	//echo $time; die();
	$desc=$_REQUEST['new_desc'];
	$query = "UPDATE s_event SET s_datetime=\"$time\", s_desc=\"$desc\" WHERE s_id=$sid" ;
	//echo $query; die();
	$result = $conn->query($query);
	$conn->close();
	header('Location: update_special_event.php');
?>
