<?php session_start(); ?>
<!doctype html>
<html lang='en'>
<head>
	<title>Login and Registration</title>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<!-- <meta http-equiv="refresh" content="1"> -->
</head>
<body class='b1'>
	<div id="container">
		<h1>Welcome to Dojospace</h1>
		<!-- Display error messages if they exists -->
		<?php 
			if(!empty($_SESSION['errors'])) {
				foreach($_SESSION['errors'] as $error) {
					echo "<p class='error'> * ".$error."</p>";
				}
			}
		 ?>
		 <!-- Form for registration -->
		<form class='register' action='process.php' method='post'>
			<input type='hidden' name='submitted_form' value='register'>
			<p>First name: </p><input type='text' name='first_name' placeholder='First name'></br>
			<p>Last name: </p><input type='text' name='last_name' placeholder='Last name'></br>
			<p>Email: </p><input type='text' name='email' placeholder='Email'></br>
			<p>Username: </p><input type='text' name='username' placeholder='Username'></br>
			<p>Password: </p><input type='password' name='password' placeholder='Password'></br>
			<p>Confirm password:</p><input type='password' name='confirm_password' placeholder='Confirm password'></br>
			<input type='submit' value='Register' class='button'>
		</form>
		<!-- Form for login -->
		<form class='login' action='process.php' method='post'>
			<input type='hidden' name='submitted_form' value='login'><br>
			<p>Username: </p><input type='text' name='username' placeholder='Username'><br>
			<p>Password: </p><input type='password' name='password' placeholder='Password'><br>
			<input type='submit' value='Login' class='button'>
		</form>
</body>
</html>