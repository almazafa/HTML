<?php
	session_start();
	if (!(isset($_SESSION['uid']))) header("location: index.php");
	// Assuming $_SESSION['did'] also exist 		
	include "inc_db.php";
?>
<!DOCTYPE html>
<html >

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
<h1>Special events that were not done this month</h1>
<?php
$month= $_SESSION['month'];
if ($_SESSION['month']<10)
{
$month="0".$_SESSION['month'];
}
else
{
$month=$_SESSION['month'];
}
$query = "select s_desc,s_datetime,s_status from s_event,dog WHERE s_dog_id=d_id and "
	." dog.d_id=".$_SESSION['did']." and s_status=0 and month(s_datetime)=\"$month\" ORDER by date(s_datetime)";
	$result = $conn->query($query);
//echo $query;die();
	if ($result->num_rows == 0) echo "All the special activities were done. Good Job!";
	else {
?>
<table width="75%"  align="center" cellpadding="5" cellspacing="5" border="1">
<tr>
		<th>Description</th>
		<th >Date and time</th>
		<th>Status</th>
			</tr>
	
<?php
		
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$status="not done yet";
		echo "<tr><td>".$row['s_desc']."</td><td>".$row['s_datetime']."</td>".
		"<td>$status</td></tr>\n";
		}			
			echo "</table>";
	}

	$result->free();
	$conn->close();


	
?>

</body>

</html>
