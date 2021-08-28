<?php
	session_start();
	include "inc_db.php";
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Login</title>
<style>
h1 {
	font-size:48px;
	color:#FFF;
	background-color:#666;
	text-align:center;border-radius:10px;
}
</style>
<script>
function to2digits(ds)
{
	if (ds < 10) 
	return '0' + ds;
	else return ds;
}
</script>

</head>
<body>
<h1 >123456 מספר תעודת זהות</h1>

<form method="post" action="check.php">

<table style="width: 400px; height:300px; background-color:#DDFFFF; border-radius:15px;" align="center" cellpadding="5" cellspacing="5">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
		&nbsp;</td>
	</tr>
	<tr>
		<td style="text-align: right">Login:</td>
		<td>&nbsp;</td>
		<td>
			<input name="username" type="text" required="required" autocomplete="off" value="gk"></td>
	</tr>
	<tr>
		<td style="text-align: right">Password:</td>
		<td>&nbsp;</td>
		<td>
			<input name="password" type="text" required="required" autocomplete="new-password" value="1234"></td>
	</tr>
	<tr>
		<td style="text-align: right">Email:</td>
		<td>&nbsp;</td>
		<td>
			<input name="mail" type="email" required="required" autocomplete="new-email" value="gideonk@afeka.ac.il">
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align: center">
			<input name="Submit1" type="submit" value="submit">
		</td>
	</tr>
</table>

<input id="today1" name="today1" type="hidden">
</form>

<script>
// creating today to check the log
	var today = new Date();		// Collect today (using JavaScript) from local computer
	var date1 = today.getFullYear()+'-'+to2digits(today.getMonth()+1)+'-'+to2digits(today.getDate());
	document.getElementById("today1").value = date1;
</script>

</body>

</html>
