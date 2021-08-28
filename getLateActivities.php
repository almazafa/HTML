<?php
	session_start();
	include "inc_db.php";
	$date=$_SESSION['today'];
	$now=$_REQUEST['date'];
	
	$query="SELECT e_id , CONVERT(CONCAT(e_dtime,'00','00'), TIME) as time FROM e_event where e_dog_id=".$_SESSION['did'].
	 " and e_id not in  (select l_event from log where (Date(l_datetime)=\"$date\" and l_dog_id=".$_SESSION['did']."))";
	//echo $query;die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
	  	if($now > $row['time'])
	  	{
		echo "e".$row['e_id'].";";
		}
	  }
	}
	
	$result->free();
	$conn->close();
?>


