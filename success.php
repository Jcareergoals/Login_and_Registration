<?php session_start();
	$user = $_SESSION['user'];
 ?>
 <!doctype html>
 <html lang='en'>
 <head>
 	<title>WELCOME</title>
 	<meta charset='UTF-8'>
 	<link rel="stylesheet" type="text/css" href="styles.css">
 	<!-- <meta http-equiv="refresh" content="1"> -->
 </head>
 <body class='b2'>
 	<div id="container" >
 		<h1>Welcome <?php echo $user['first_name']; ?> </h1>
 		<p>We think you username ( <span><?php echo $user['username'] ?></span> ) is soo cool! :-)</p>
 		<p>We'll be sending an email to <span><?php echo $user['email'] ?></span> shortly.</p>
 	</div> <!-- End of container -->
 </body>
 </html>