<?php
	session_start();
	if (!(isset($_SESSION['uid']))) header("location: index.php");//user didnt preform login
	include("inc_db.php");
?>
<!DOCTYPE>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<style>
*{
	text-align:center;
}
#add_event{
	border-radius:3px;
}
.button{
	border:0;
}
</style>

</head>

<body>
	<h1> Users </h1>
		<table border="1" style="width: 75%" align="center">
		<tr>
			<th>User login</th>
			<th>User password</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Phone</th>
			<th>Email</th>

		</tr>
<?php
	$query = "select * from user,u_d where user.u_id=u_d.u_id and d_id=".$_SESSION['did'];
	//echo $query; die();
	$result = $conn->query($query);
	if ($result->num_rows > 0)
	{
  	  while($row = $result->fetch_array(MYSQLI_ASSOC))
	  {
	  $login=$row['u_login'];
	  $password=$row['u_password'];
	  $name=$row['u_pname'];
	  $family=$row['u_fname'];
	  $phone=$row['u_phone'];
	  $mail=$row['u_mail'];
		echo "<tr id='u".$row['u_id']."' class='tdm' ><td>".
		"$login</td><td>$password</td><td>$name</td><td> $family</td><td>$phone</td><td>$mail</td></tr>\n";
		"</tr>\n";

	  }
	}
	$result->free();
	$conn->close();
	
	?>
	<tr><td class="dontShow"></td><td class="button"></td><td class="button"><input name="Button1" type="button" id="add_event" value="Add user" onclick=loadinfo("showdata","add_user.php") ></td></tr>
</table>
</body>
</html>
