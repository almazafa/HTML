<?php
session_start();
include "inc_db.php";
?>
<!DOCTYPE html >
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
<table width="80%" align="center" border="1">
<tr>
<th style="width: 440px">Done by (user ID)</th>
<th style="width: 440px">Done by (user name)</th>
<th style="width: 440px">count events</th>
</tr>
<?php
$today=$_SESSION['today'];
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
/*"SELECT u_id, u_pname,l_datetime,l_desc,count(u_id) as count_events from user,log where u_id=l_user_id and l_dog_id=$did ".
 "and l_datetime BETWEEN cast(\"$first\" as DATE) AND CAST(\"$today\" AS DATE) group by u_id order by l_datetime";*/
$query="(SELECT user.u_id, u_pname,count(user.u_id)as trip ". 
"FROM user,log,dog,u_d ".
"WHERE user.u_id=log.l_user_id and dog.d_id=log.l_dog_id and u_d.u_id=user.u_id and dog.d_id=u_d.d_id and dog.d_id=$did and month(l_datetime)=\"$month\" ". 
"GROUP by u_pname ORDER by trip DESC) ".
"UNION (SELECT user.u_id, u_pname, count(null) as trip ".
"FROM user,u_d WHERE user.u_id=u_d.u_id and u_d.d_id=$did ".
"and user.u_id NOT IN (SELECT l_user_id from log) GROUP by u_pname ORDER by trip DESC) ";
//echo $query;die();
 	$result = $conn->query($query);
if ($result->num_rows > 0)
{
 	 while($row = $result->fetch_array(MYSQLI_ASSOC))
 { //giving id's to the rows, each row will get the id that matches her event_id//
echo "<tr><td>".$row['u_id']."</td><td>".$row['u_pname']."</td><td>".$row['trip']."</td></tr>\n";
 }
 /*$query="select u_id,u_pname from user,dog where user.u_id=u_d.u_id and d_id=$did u_id not in (select l_user_id from log where l_dog_id=$did)";
 echo $query; die();
  $result = $conn->query($query);
  if ($result->num_rows > 0)
	{
 	 while($row = $result->fetch_array(MYSQLI_ASSOC)){
 	 echo "<tr><td>". 
	"didn't do any activity</td><td></td><td>".$row['u_id']."</td><td>".$row['u_pname']."</td><td>0</td></tr>\n";

 	 
	}
	}*/

}
echo '</table>';
$result->free();
$conn->close();


?>

</table>
</body>

</html>

