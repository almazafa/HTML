<?php
	session_start();
	include ("inc_db.php");

if((isset($_REQUEST['username'])) and (isset($_REQUEST['password'])) and (isset($_REQUEST['mail'])))
{
	$username=$_REQUEST['username'];
	$password= $_REQUEST['password'];
	$mail= $_REQUEST['mail'];
	$_SESSION['today']=$_REQUEST['today1']; //to show events on this day
	//get user id
	$query="select u_id,u_login,u_password,u_owner from user ".
		 " where u_login=\"$username\" and u_password = \"$password\" and u_mail = \"$mail\"";
	//echo $query;die();
	$found=false;
	$result = $conn->query($query);
	if ($result->num_rows != 0)//we found a user
	{
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$_SESSION['uid']=$row['u_id'];
		$_SESSION['type']=$row['u_owner'];
		$found=true;
	
		//find user dog id
		$query = "select d_id,d_name from dog where d_id=(select d_id from u_d where u_id=".$_SESSION['uid'].")";		//echo $query;die();
		$result = $conn->query($query);
		if ($result->num_rows == 0)  { 
				echo "No dog found for: ".$_SESSION['uid']; die(); 	// BIG problem beacuse a user dosn't have a dog!!
		}
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$_SESSION['did'] = $row["d_id"]; // save the dog id	
		$_SESSION['dname']=$row["d_name"];
	}	
	$result->free();
	$conn->close();
	if($found)
	{
		header("location:main.php");
	}
	else//we didn't find the user in the DB
	{
		header("location:index.php");
	}
}

else //no input in user name or password
	header("location:index.php");
?>