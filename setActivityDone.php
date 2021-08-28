<?php
	session_start();
	$date=$_REQUEST['date'];
	$eid=$_REQUEST['eid'];
	$desc=$_REQUEST['desc'];
	
	$did=$_SESSION['did'];
	$uid=$_SESSION['uid'];
	
	include "inc_db.php";
	$query = "INSERT INTO log( l_dog_id, l_user_id, l_event, l_datetime, l_desc) ".
					  "VALUES ($did,     $uid,       $eid,    \"$date\",  \"$desc\")";
	
	$result = $conn->query($query);
	$conn->close();


?>