<!DOCTYPE html >
<html>
<head>
<style>
* {
	 border-radius:5px;

}
input{
	margin-right:35px;
}
</style>
</head>
<body>
<table align="center" style="width: 70%;">
		<tr>
			<td>
				<form action="save_user.php" method="post">
				  <fieldset>
				    <legend style="background-color:#666666; color:white; height:20px;">&nbsp; Personal information&nbsp; </legend>

				
				<table  align="center">
				    <tr><td>Username:</td><td><input type="text" name="login" placeholder="Username" required="required"></td></tr>
				    <tr><td>Password:</td><td><input type="password" name="password" placeholder="Password" required="required"></td></tr>
				    <tr><td>First name:</td><td><input type="text" name="firstname" placeholder="First Name" required="required"></td></tr>
				    <tr><td>Last name:</td><td><input type="text" name="lastname" placeholder="Last Name" required="required"></td></tr>				    
				    <tr><td>Mail:</td><td><input type="email" name="mail" placeholder="E-mail" required="required"></td></tr>
				    <tr><td>Phone Number:</td><td><input type="tel" name="phone" placeholder="Phone" required="required" ></td></tr>
				    <tr><td></td><td><input type="reset" value="Reset"><input type="submit" value="Submit"></td></tr>
				    
				    </table>
				
					</fieldset>
				</form>
			</td>
		</tr>
	</table>

</body>

</html>
