<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<center>
	<div>
		<?php include 'Header.php';?>				
	</div>

	<h1>Sign in</h1>

	<form method="post" action="../Controller/LoginController.php" novalidate>
		Email: <input type="email" name="email">
		<?php echo isset($_SESSION['email_msg']) ? $_SESSION['email_msg'] : ""; ?>
		<br><br>
		Password: <input type="password" name="password">
		<?php echo isset($_SESSION['password_msg']) ? $_SESSION['password_msg'] : ""; ?>
		<br><br>
		<input type="submit">
		<br><br>
	</form>
	<?php echo isset($_SESSION['global_msg']) ? $_SESSION['global_msg'] : ""; ?>

</center>
<br><br>
<br><br>

<div align="center">
		<?php include 'Footer.php';?>
	</div>
</body>
</html>