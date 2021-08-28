<?php
	session_start();		
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
$query = "SELECT dog.d_name as Dog_Name, user.u_fname as User_Name, date(log.l_datetime) as Date, time(log.l_datetime) as Time, e_event.e_desc as Description, hour(log.l_datetime)-e_event.e_dtime as Late \n"
    . "FROM dog,user,log,e_event,u_d\n"
    . "WHERE user.u_id=log.l_user_id and log.l_event=e_event.e_id and dog.d_id=1\n"
    . "order by Dog_name, User_name,Date,Time";
	$result = $conn->query($query);

?>
<table width="75%"  align="center" cellpadding="5" cellspacing="5" border="1">
<tr>
<th>Dog_Name</th>
<th>User_Name</th>
<th>Date</th>
<th>Time</th>
<th>Description </th>
<th>Late </th>
</tr>
	
<?php	
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$status="not done yet";
		echo "<tr><td>".$row['Dog_Name']."</td><td>".$row['User_Name']."</td><td>".$row['Date']."</td><td>".$row['Time']."</td><td>".$row['Description']."</td><td>".$row['Late']."</td></tr>\n";
		}			
			echo "</table>";
	
	$result->free();
	$conn->close();
?>

</body>
	<tr><td class="button"></td><td class="button"><input name="Button1" type="button"  value="חזרה" onclick=loadinfo("showdata","reports.php")></td></tr>

</html>
