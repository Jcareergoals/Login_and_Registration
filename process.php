<?php session_start();
	  require('new-connection.php');
	  // Set global variables // 
	  $errors = array();
	  $salt = bin2hex(openssl_random_pseudo_bytes(5));

	/* -------- Registration form ----------- */
	if($_POST['submitted_form'] == 'register') {
		// Check for valid fields //
		if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || 
		   empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['username'])){
			$errors[] = "Make sure no fields are empty";
		} else if (is_numeric($_POST['first_name']) || strlen($_POST['first_name']) < 3 ){
			$errors[] = "Enter a valid first name";
		} else if (is_numeric($_POST['last_name']) || strlen($_POST['last_name']) < 3){
			$errors[] = "Enter a valid last name";
		} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$errors[] = "Enter a valid email";
		} else if (strlen($_POST['password']) < 6){
			$errors[] = "Password length must be more than 6 characters";
		} else if ($_POST['confirm_password'] != $_POST['password']){
			$errors[] = "Passwords do not match";
		} else if (strlen($_POST['password']) < 2){
			$errors[] = "username length must be more than 2 characters";
		}
		/* Check errors array for errors  */
		if(count($errors) > 0){
			$_SESSION['errors'] = $errors;
			$errors = array();
			header('location: index.php');
		} else {
			// Set local variables // 
			$first_name = ucwords(escape_this_string($_POST['first_name']));
			$last_name = ucwords(escape_this_string($_POST['last_name']));
			$email = $_POST['email'];
			$encrypted_password = md5(escape_this_string($_POST['password']) . '' . $salt);
			$username = $_POST['username'];
			$query_1 = "INSERT INTO users (first_name, last_name, email, password, salt, username, created_at, updated_at) 
						VALUES ('$first_name', '$last_name', '$email', '$encrypted_password', '$salt', '$username', NOW(), NOW())";
			$query_2 = "SELECT * FROM users WHERE username = '{$_POST['username']}' ";
			// Run SQL queries // 
			run_mysql_query($query_1);
			$_SESSION['user'] = fetch_record($query_2);
			header('location: success.php');
		}
	}	/* ---------- End Registration form ----------- */

/* ====================================================================================================== */

		/* -------------- login form ------------------ */
	if($_POST['submitted_form'] == 'login') {
		if(empty($_POST['username'])||empty($_POST['password'])){
			$errors[] = "Make sure no fields are empty";
		} else if (strlen($_POST['password']) < 6 || strlen($_POST['username']) < 2){
			$errors[] = "Make sure password is more than 6 characters and username is more than 2 characters";
		}
		// Set local variables // 
		$query_2 = "SELECT * FROM users WHERE username = '{$_POST['username']}' ";
		$user = fetch_record($query_2);
		$encrypted_password = md5(escape_this_string($_POST['password']) . '' . $user['salt']);
		// Check database for username & password // 
		if(!fetch_record($query_2)) {
			$errors[] = "Username not found";
		} else if ($user['password'] != $encrypted_password){
			$errors[] = "Password is incorrect";
		}
		// log user in if user exists // 
		if(! empty($errors)) {
			$_SESSION['errors'] = $errors;
			$errors = array();
			header('location: index.php');
		} else {
			$_SESSION['user'] = $user;
			header('location: success.php');
		}
	} /* ------------- End of login form ------------- */
 ?>