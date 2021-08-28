<?php
	session_start();
	include("inc_db.php");
	
	$login =  $_REQUEST['login'] ;
	$password	=  $_REQUEST['password'] ;
	$firstname	=  $_REQUEST['firstname'] ;
	$lastname	=  $_REQUEST['lastname'] ;
	$phone	=  $_REQUEST['phone'] ;
	$mail= $_REQUEST['mail'];
	$did = $_SESSION['did'];
	//$encrypted_password = $password;
	//$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
//	$encrypted_password = crypt($password,10);

		$query = "insert into user (u_login,u_pname, u_fname, u_password,u_phone,u_mail,u_owner) value (\"$login\",\"$firstname\",\"$lastname\",\"$password\",\"$phone\",\"$mail\",1)";
		$result = $conn->query($query);
		$query1  = "select u_id from user where u_login=\"$login\"";
		//echo $query;die();
		$result1 = $conn->query($query1);
		if ($result1->num_rows != 0){
	  	 	$row = $result1->fetch_array(MYSQLI_ASSOC);
	  	 	$id=$row['u_id'];
			$query="insert into u_d(d_id,u_id) value($did,$id)";
			//echo $query;die();
			$result = $conn->query($query);
		}
		$result1->free();
		$conn->close();
		header('Location: main.php');
?>
