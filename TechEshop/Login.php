<?php

	include "NavigationBar.php";
	include "Footer.php";

	if(isset($_SESSION['user'])!="")
	{
		header("Location: index.php");
		exit;
	}

	require_once "dbcontroller.php";

	$db_handle = new DBController();
	$connection = $db_handle->connectDB();
	
	if(isset($_POST['btn-login']))
	{
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$upass = mysqli_real_escape_string($connection,$_POST['pass']);
		$res=mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
		$row=mysqli_fetch_array($res);

		if($row['password'] == $upass)
		{
			$_SESSION['user'] = $row['user_id'];
			header("Location: index.php");
		}
		else
		{
			?>
			<script>alert('Wrong Details');</script>
			
			<?php
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
<title>TechEshop</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>
	<div id="login-form">
	<form method="post">
		<div class="container">
        <h1>Login</h1>
		<hr>
		<label for="email"><b>Email</b></label>
		<br>
		<td><input type="email" name="email" placeholder="Your Email" required /></td>
		</tr>
		<br><br>
		<tr>
		<label for="psw"><b>Password</b></label>
		<br>
		<td><input type="password" name="pass" placeholder="Your Password" required /></td>
		</tr>
		<br><br>
		<tr>
		<td><button type="submit" name="btn-login">Sign In</button></td>
		</tr>
		<br><br>
		<tr>
		<td>
		<aa><a href="SignUp.php">Sign Up</a></aa>&nbsp;&nbsp;&nbsp;
		<a href="index.php">  Home</a>
		</td>
		</tr>
		</table>
	</form>
	</div>
</center>
</body>
</html>

