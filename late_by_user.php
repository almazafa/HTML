<?php
session_start();
include "inc_db.php";
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
<style>
*{
	text-align:center;
}
</style>
</head>

<body>
<h1> All the daily events that were late this month</h1>
<table border="1" width="75%" align="center">
<tr>
<th>Activity</th>
<th>Day</th>
<th>User ID</th>
<th>User name</th>
<th>How much late</th>
</tr>
<?php

//echo $today;die();
$did=$_SESSION['did'];
$query="SELECT date(l_datetime) as date1, e_desc, user.u_pname,user.u_id,ABS(hour(log.l_datetime)-e_event.e_dtime) as late FROM e_event,log,user".
" WHERE user.u_id=log.l_user_id and log.l_event=e_event.e_id and log.l_dog_id=$did";
 //echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
		echo "<tr><td>".
			$row['e_desc']."</td><td>".$row['date1']."</td><td>".$row['u_id']."</td><td>".$row['u_pname']."</td><td>".$row['late']."</td></tr>\n";
	  }
	}
	echo '</table>';
	$result->free();
	$conn->close();

?>

</body>

</html>
