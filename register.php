<?php 
	include("includes/classes/Account.php");

	//Create a new instance of Account object into $account
	$account = new Account();

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "utf-8">
	<title>Welcome to VoiseM</title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

	<form  id="loginForm" action="register.php" method="POST">
		
		<h2>Login to your account</h2>

		<p>
			<label for="loginUsername">Username</label>
			<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g John123" required></input>
		</p>
		
		<p>
			<label for="loginPassword">Password</label>
			<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required></input>
		</p>

		<button type="submit" name="loginButton">LOG IN</button>

	</form>

	<form id="registerForm" action="register.php" method="POST">
		
		<h2>Create your free account</h2>
		
		<p>
			<label for="username">Username</label>
			<input id="username" name="username" type="text" placeholder="e.g John123" required></input>
		</p>

		<p>
			<label for="firstName">First Name</label>
			<input id="firstName" name="firstName" type="text" placeholder="e.g John" required></input>
		</p>

		<p>
			<label for="lastName">Last Name</label>
			<input id="lastName" name="lastName" type="text" placeholder="e.g John Cena" required></input>
		</p>

		<p>
			<label for="email">Email</label>
			<input id="email" name="email" type="email" placeholder="e.g John@hotmail.com" required></input>
		</p>

		<p>
			<label for="email2">Email</label>
			<input id="email2" name="email2" type="email" placeholder="e.g John@hotmail.com" required></input>
		</p>
		
		<p>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" placeholder="Your password" required></input>
		</p>

			<p>
			<label for="password2">Confirm password</label>
			<input id="password2" name="password2" type="password" placeholder="Retype your password" required></input>
		</p>

		<button type="submit" name="registerButton">SIGN UP</button>

	</form>

</body>

</html>
