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
<h1> All the daily events that were done this month</h1>
<table border="1" width="75%" align="center">
<tr>
<th>Notes by user</th>
<th>Time</th>
<th>Done by(user ID)</th>
<th>Done by(user name)</th>
</tr>
<?php
$today=$_SESSION['today'];
//echo $today;die();
$did=$_SESSION['did'];
if ($_SESSION['month']<10)
{
$month="0".$_SESSION['month'];
}
else
{
$month=$_SESSION['month'];
}
$first=$_SESSION['year']."-$month-01";
$query="SELECT u_id, u_pname,l_datetime,l_desc from user,log where u_id=l_user_id and l_dog_id=$did ".
 "and l_datetime BETWEEN cast(\"$first\" as DATE) AND CAST(\"$today\" AS DATE) order by l_datetime";
 //echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
		echo "<tr><td>".
			$row['l_desc']."</td><td>".$row['l_datetime']."</td><td>".$row['u_id']."</td><td>".$row['u_pname']."</td></tr>\n";
	  }
	}
	echo '</table>';
	$result->free();
	$conn->close();

?>

</body>

</html>
