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
<?php
	$today=$_SESSION['today'];
	$query="SELECT month(\"$today\") as month, year(\"$today\") as year ";
	//echo $query; die();
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$_SESSION['month']=$row['month'];
	$_SESSION['year']=$row['year'];
?>
<h1>Which report would you like to see?</h1>

<table style="width: 50%" align="center">
	<tr>
		<td class="tdr" onclick=loadinfo("showdata","allNotDonespecial")>Q5.1 
		and Q5.2</td>
	</tr>
		
	<tr>
		<td class="tdr" onclick= loadinfo("showdata","getAllEvents.php") >All the daily events that were done this month</td>
	</tr>
	<tr>
		<td class="dontShow" style="height: 24px"></td>
	</tr>
	<tr>
		<td class="tdr" onclick= loadinfo("showdata","countUser.php")>How much activities every user did</td>
	</tr>
	<tr>
		<td class="dontShow" style="height: 24px"></td>
	</tr>
	<tr>
	<tr>
		<td class="tdr" onclick=loadinfo("showdata","allNotDonespecial22")>Special events that were not done</td>
	</tr>
		<tr>
		<td class="dontShow" style="height: 24px"></td>
	</tr>
	<tr>
	<tr>
		<td class="tdr" onclick=loadinfo("showdata","late_by_user.php")>How late the event was done</td>
	</tr>

</table>

</body>

</html>
